<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\ChefDeFiliere;
use App\Models\creneaux;
use App\Models\filiere;
use App\Models\groupe;
use App\Models\User;
use App\Models\etudiant;

class ProfesseurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        if (Auth::guest()){
            return redirect('/');
        }
        else{
            if (Auth::user()->role == "professeur") {
                return view('professor.professeur');
            }
            else{
                Abort(403,'NO');
            }    
    }    }
    public function sendMessage(Request $request, $creneau_id)
    {
        $request->validate([
            'message_type' => 'required|string',
            'message_content' => 'nullable|string|max:1000',
        ]);
        $creneau = Creneaux::findOrFail($creneau_id);
        $groupe = groupe::where('id', $creneau->group_id)->first();
        if ($request->recipient_type === 'chef_de_filiere') { 
        if ($groupe) {

            $filiere = filiere::where('id', $groupe->filiere_id)->first(); // Now you can access filiere_id
            $chefFiliere = User::where('id',$filiere->chef_de_filiere)->first();
            // Continue with your logic
        } else {
            // Handle the case where no group was found
            return redirect()->back()->with('error', 'Group not found.');
        }

    
        
    // Send message to the chef de filière
  
    if ($chefFiliere) {
        Message::create([
            'creneau_id' => $creneau->id,
            'chef_filiere_id' => $chefFiliere->id,
            'professeur_id' => Auth::user()->id,
            'message_type' => $request->message_type,
            'message_content' => $request->message_content,
            'recipient_type' => 'chef_filiere',
        ]);
    }
}

if ($request->recipient_type === 'student') {
    Message::create([
        'creneau_id' => $creneau->id,
        'etudiant_id' => $creneau->group_id,
        'professeur_id' => Auth::user()->id,
        'message_type' => $request->message_type,
        'message_content' => $request->message_content,
        'recipient_type' => "student", // Specify recipient type
    ]);
     }


    return redirect()->back()->with('success', 'Message sent successfully.');
}

    
    
    
            
    
     
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
