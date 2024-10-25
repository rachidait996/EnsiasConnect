
@extends('layouts.app') 

@section('content')
<div class="container">
    <h1>Create Filiere</h1>

    <form action="{{ route('filieres.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Filiere Name:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group mt-3">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>

        <div class="form-group mt-3">
            <label for="chef_de_filiere">Chef de Filiere:</label>
            <select name="chef_de_filiere" id="chef_de_filiere" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="departement_id">Department:</label>
            <select name="departement_id" id="departement_id" class="form-control">
                @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Create Filiere</button>
    </form>
</div>
@endsection
