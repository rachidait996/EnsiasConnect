<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
class ChefDeFiliereController extends Controller
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
            if (Auth::user()->role == "chef de filière") {
                return view('chef.dashboard');
            }
            else{
                Abort(403,'NO');
            }    
    }    }

    public function viewMessages()
    {
        // Assuming the chef de filière is authenticated
        $chefFiliere = Auth::user();  // Assuming there's a relationship with the User model
       

        // Retrieve messages for the current chef de filière
        $messages = Message::where('chef_filiere_id', $chefFiliere->id)
                            ->with(['creneau.elementDeModule.module', 'creneau.room', 'professor'])
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('chef.messages', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()

    {
        
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
