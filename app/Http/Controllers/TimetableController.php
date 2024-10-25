<?php

namespace App\Http\Controllers;

use App\Models\annee;
use App\Models\creneaux;
use Illuminate\Http\Request;


use App\Models\semestre;
use App\Models\periode;
use App\Models\module;
use App\Models\element_de_module;
use App\Models\pivot_element_prof;
use App\Models\Filiere;
use App\Models\professor;
use App\Models\User;
use App\Models\room;
use App\Models\groupe;
use App\Models\etudiant;
use App\Models\ChefDeFiliere;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class TimetableController extends Controller
{
    public function index(Request $request)
    {
        // Define the days of the week and time slots
        $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
        $timeslots = [
            ['start' => '08:00:00', 'end' => '10:00:00'],
            ['start' => '10:00:00', 'end' => '12:00:00'],
            ['start' => '14:00:00', 'end' => '16:00:00'],
            ['start' => '16:00:00', 'end' => '18:00:00'], 
        ];
    
        // Retrieve the selected year, semester, and period from the session
        $yearId = $request->session()->get('selectedyear');
        $semestreId = $request->session()->get('selectedsemestre');
        $periodeId = $request->session()->get('selectedperiode');
        $groupId = $request->session()->get('selectedgroup');
        $levelName = $request->session()->get('selectedniveau');
    
        $startTime = $request->input('start_time', '');
        $endTime = $request->input('end_time', '');
        $jour = $request->input('jour','');
    
        $a = groupe::find($groupId);
        $groupe = $a->name;
    
        $a = semestre::find($semestreId);
        $semestre = $a->name;
    
        $a = periode::find($periodeId);
        $periode = $a->name;
       
        $modules = $semestreId ? module::where('semester_id', $semestreId)->get() : collect();
        $elements = collect();
        $profs = collect();
        $categories = ['Amphi', 'Salle', 'Salle de TP'];
        $rooms = collect();
        
        // Retrieve creneaux for the selected period
        $creneaux = creneaux::with(['elementDeModule.module', 'user', 'room'])
        ->where('period_id', $periodeId)->where('group_id', $groupId)->get();
    
        // Map creneaux with additional data (module, element de module, prof, salle)
        $creneaux = $creneaux->map(function($creneau) {
            $element = element_de_module::find($creneau->module_element_id);
            $module = $element->module; // Assuming element_de_module has a relation to module
            $professor = User::find($creneau->professor_id);
            $room = room::find($creneau->room_id);
    
            return [
                'creneau' => $creneau,
                'module' => $module,
                'element' => $element,
                'professor' => $professor,
                'room' => $room,
            ];
        });
    
        if ($request->has('module')) {
            $elements = element_de_module::where('module_id', $request->module)->get();
        }
    
        if ($request->has('element_de_module')) {
            $a = pivot_element_prof::where('element_de_module_id', $request->element_de_module)->get();
            $professorIds = $a->pluck('professor_id');
            $b = Professor::whereIn('id', $professorIds)->get();
            $userIds = $b->pluck('user_id');
            $profs = User::whereIn('id', $userIds)->get();
        }
    
        if ($request->has('category')) {
            $rooms = room::where('category', $request->category)->get();
        }
    
        // Manage modal state
        if ($request->has('keep_modal_open') && $request->input('keep_modal_open') === 'true') {
            $request->session()->put('keep_modal_open', true);
        } else {
            $request->session()->forget('keep_modal_open');
        }
    
        // Return the view with updated data
        return view('chef.creneaux.index', compact('days', 'timeslots', 'semestre', 'modules', 'periode', 'elements', 'profs', 'categories', 'rooms', 'startTime', 'endTime','jour','yearId','semestreId','periodeId','groupe','levelName','groupId','creneaux'));
    }
    

    
    public function store(Request $request)
    {
        $existingCreneau = creneaux::where('start_time', $request->start_time)
            ->where('end_time', $request->end_time)
            ->where('day', $request->jour)
            ->where('period_id', $request->periode)
            ->where('niveau',  $request->niveau)
            ->where('group_id', $request->groupe)
            ->first();
    
        if ($existingCreneau) {
            $existingCreneau->update([
                'professor_id' => $request->professeur,
                'module_element_id' => $request->element_de_module,
                'room_id' => $request->room,
            ]);
    
            return redirect()->route('creneaux.index')->with('success', 'Creneau updated successfully.');
        } else {
            // Create a new creneau
            creneaux::create([
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'group_id' => $request->groupe,
                'niveau' => $request->niveau,
                'day' => $request->jour,
                'period_id' => $request->periode,
                'module_element_id' => $request->element_de_module,
                'professor_id' => $request->professeur,
                'room_id' => $request->room,
            ]);
    
            return redirect()->route('creneaux.index')->with('success', 'Creneau created successfully.');
        }
    }
    
        public function select(Request $request)
        {
            $user = Auth::user();

            $filiere = filiere::where('chef_de_filiere', $user->id)->get();

            if ($request->has('year')) {
                $request->session()->put('selectedyear', $request->year);
            }
        
            if ($request->has('semestre')) {
                $request->session()->put('selectedsemestre', $request->semestre);
            }
        
            if ($request->has('periode')) {
                $request->session()->put('selectedperiode', $request->periode);
            }
            if ($request->has('niveau')) {
                $request->session()->put('selectedniveau', $request->niveau);
            }
            if ($request->has('group')) {
                $request->session()->put('selectedgroup', $request->group);
            }

        
            // If the period is selected, redirect to the index route to show the timetable
            if ($request->has('periode')) {
                return redirect()->route('creneaux.index');
            }
            return view('chef.creneaux.select', [
                'years' => annee::all(),
                'semestres' => $request->session()->has('selectedyear') ? semestre::where('academic_year_id', session('selectedyear'))->get() : [],
                'periodes' => $request->session()->has('selectedsemestre') ? periode::where('semester_id', session('selectedsemestre'))->get() : [],
                'niveaux' => ['1A','2A','3A'],
                'groups' =>  groupe::where('filiere_id', $filiere->pluck('id'))->get(),
            ]);
        }
        public function selectStudent(Request $request)
        {
            // Get the authenticated student
           
            if ($request->has('year')) {
                $request->session()->put('selected.year', $request->year);
            }
            if ($request->has('semestre')) {
                $request->session()->put('selected.semestre', $request->semestre);
            } 
            if ($request->has('periode')) {
                $request->session()->put('selected.periode', $request->periode);
            }    
            
            if ($request->has('periode')) {
                return redirect()->route('student.timetable');
            }
            return view('etudiant.select', [
                'years' => annee::all(),
             
                'semestres' => $request->session()->has('selected.year') ? semestre::where('academic_year_id', session('selected.year'))->get() : [],
                'periodes' => $request->session()->has('selected.semestre') ? periode::where('semester_id', session('selected.semestre'))->get() : [],
            ]);
        }
        public function Student(Request $request)
        {
            // Get the authenticated student
            $student = Auth::user();
            $filiere = filiere::where('id',$student->etudiant->filiere_id)->get();

            $groupe = groupe::where('name',$filiere->pluck('name'))->get();
         

            $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
            $timeslots = [
                ['start' => '08:00:00', 'end' => '10:00:00'],
                ['start' => '10:00:00', 'end' => '12:00:00'],
                ['start' => '12:00:00', 'end' => '14:00:00'],
                ['start' => '14:00:00', 'end' => '16:00:00'],
                ['start' => '16:00:00', 'end' => '18:00:00']
            ];

           
            $periodeId = $request->session()->get('selected.periode');

            $periode = periode::with(['semestre'])->where('id',$periodeId)->get();
            
            $semestre = semestre::where("id",$periode->pluck("semester_id"))->get();
            $periodeName = $periode->pluck("name");
            $semestreName = $semestre->pluck("name");
          
            
    
            $creneaux = Creneaux::with(['elementDeModule.module', 'user', 'room'])
                ->where('niveau', $student->etudiant->niveau)
                ->where('group_id', $student->etudiant->groupe_id)
                ->where('period_id',$periodeId)->get();

            // Pass the data to the view
            return view('etudiant.timetable',compact('timeslots','days','creneaux','periodeName','semestreName'));
         
        }
        public function selectProf(Request $request)
        {
            // Get the authenticated student
           
            if ($request->has('year')) {
                $request->session()->put('selected_year', $request->year);
            }
            if ($request->has('semestre')) {
                $request->session()->put('selected_semestre', $request->semestre);
            } 
            if ($request->has('periode')) {
                $request->session()->put('selected_periode', $request->periode);
            }    
            
            if ($request->has('periode')) {
                return redirect()->route('prof.timetable');
            }
          
            return view('professor.select', [
                'years' => annee::all(),
             
                'semestres' => $request->session()->has('selected_year') ? semestre::where('academic_year_id', session('selected_year'))->get() : [],
                'periodes' => $request->session()->has('selected_semestre') ? periode::where('semester_id', session('selected_semestre'))->get() : [],
            ]);
        }
        public function prof(Request $request)
        {
            // Get the authenticated student
            $prof = Auth::user();

         

            $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
            $timeslots = [
                ['start' => '08:00:00', 'end' => '10:00:00'],
                ['start' => '10:00:00', 'end' => '12:00:00'],
                ['start' => '12:00:00', 'end' => '14:00:00'],
                ['start' => '14:00:00', 'end' => '16:00:00'],
                ['start' => '16:00:00', 'end' => '18:00:00']
            ];

           
            $periodeId = $request->session()->get('selected_periode');
            $periode = periode::with(['semestre'])->where('id',$periodeId)->get();
            
            $semestre = semestre::where("id",$periode->pluck("semester_id"))->get();
            $periodeName = $periode->pluck("name");
            $semestreName = $semestre->pluck("name");


    
            $creneaux = Creneaux::with(['elementDeModule.module', 'room'])
                ->where('period_id',$periodeId)
                ->where('professor_id',$prof->id)->get();


            // Pass the data to the view
            return view('professor.timetable',compact('timeslots','days','creneaux','periode','periodeName',"semestreName"));
         
        }
        
       
      
}
