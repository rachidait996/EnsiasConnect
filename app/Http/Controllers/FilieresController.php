<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\departement;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\filiere;

class FilieresController extends Controller
{
    public function create()
    {
        $users = User::where('role', 'chef de filière')->get(); // Get users with the role of "chef"
        $departments = Departement::all(); // Get all departments
    
        return view('admin.filieres.create', compact('users', 'departments'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'chef_de_filiere' => 'required|exists:users,id',
            'departement_id' => 'required|exists:departments,id',
        ]);
    
        Filiere::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'chef_de_filiere' => $request->input('chef_de_filiere'),
            'departement_id' => $request->input('departement_id'),
        ]);
    
        return redirect()->route('filieres.index')->with('success', 'Filiere created successfully.');
    }
     
}