<?php

namespace App\Http\Controllers;
use App\Models\Departement;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    // Show the list of departments and the create form
    public function index()
    {
        $departments = Departement::all();
        return view('admin.departments.index', compact('departments'));
    }

    // Store a new department
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255|unique:departments,name',
        ]);

        // Create new department
        Departement::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('departments.index')->with('success', 'Department created successfully.');
    }

    // Delete a department
    public function destroy($id)
    {
        $department = Departement::findOrFail($id);
        $department->delete();

        return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
    }
}
