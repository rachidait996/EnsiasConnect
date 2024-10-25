@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Edit User Account</h2>

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="role">Role</label>
                    <select name="role" class="form-control" required>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="professeur" {{ $user->role == 'professeur' ? 'selected' : '' }}>Professeur</option>
                        <option value="chef" {{ $user->role == 'chef' ? 'selected' : '' }}>Chef de Filière</option>
                        <option value="etudiant" {{ $user->role == 'etudiant' ? 'selected' : '' }}>Étudiant</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="password">Password (leave blank if not changing)</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Update Account</button>
            </form>
        </div>
    </div>
</div>

@endsection
