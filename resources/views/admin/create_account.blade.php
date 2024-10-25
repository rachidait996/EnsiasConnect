@extends('layouts.admin')

@section('title', 'Create Account')

@section('content')
    <h1>Create New Account</h1>
    <form action="{{ route('admin.store_account') }}" method="POST">
        @csrf
        <!-- Input fields for account creation -->
        <button type="submit" class="btn btn-primary">Create Account</button>
    </form>
@endsection
