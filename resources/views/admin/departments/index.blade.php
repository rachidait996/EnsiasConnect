
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manage Departments</h1>

    {{-- Display success or error messages --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form to create a new department --}}
    <div class="mb-4">
        <h3>Add New Department</h3>
        <form action="{{ route('departments.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Department Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter department name" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Department</button>
        </form>
    </div>

    {{-- Table to view and delete existing departments --}}
    <h3>Existing Departments</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($departments as $department)
                <tr>
                    <td>{{ $department->name }}</td>
                    <td>
                        {{-- Delete form --}}
                        <form action="{{ route('departments.destroy', $department->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this department?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
