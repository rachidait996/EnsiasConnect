@extends('layouts.app')

@section('title', 'Profile')

@section('content')

<div class="pagetitle">
    <h1>Profile</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a >Home</a></li>
            <li class="breadcrumb-item active">Profile</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">
    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <img src="{{ asset('assets/niceadmin/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
                    <h2>{{ $user->name }}</h2>
                    <h3>{{ ucfirst($user->role) }}</h3>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="card">
                <div class="card-body pt-3">
                    <!-- Profile Edit Form -->
                    <form action="{{ route(strtolower(Auth::user()->role) . '.profile.update') }}"   method="POST" >
                        @csrf
                     
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-lg-3 col-form-label">Name</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

            

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password_confirmation" class="col-md-4 col-lg-3 col-form-label">Confirm Password</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="password_confirmation" type="password" class="form-control" id="password_confirmation">
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form><!-- End Profile Edit Form -->

                </div>
            </div>
        </div>
    </div>
</section>

@endsection
