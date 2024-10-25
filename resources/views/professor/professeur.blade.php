@extends('layouts.app')

@section('title', 'Prof Dashboard')

@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a >Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">
        <!-- Your content for professors here -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Welcome, Mr. {{ Auth::user()->name }}</h5>
                    <p>Here you can view your schedule, manage your profile.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
