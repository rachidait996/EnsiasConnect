@extends('layouts.app')

@section('title', 'Chef de Filière Dashboard')

@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">
        <!-- Your content for chef de filière here -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Welcome, Chef de Filière</h5>
                    <p>Here you can manage classes, schedules, and program details.</p>
                </div>
            </div>
        </div>
        
        <a href='/chefdefiliere/select' > create </a>

    </div>
</section>
@endsection
