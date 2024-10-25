@extends('layouts.app') 

@section('title', 'Messages from Professors')

@section('content')
<div class="pagetitle">
    <h1>Messages from Professors</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Messages</li>
        </ol>
    </nav>
</div>

<section class="section messages">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Received Messages</h5>

                    <!-- Table displaying messages -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Professor</th>
                                    <th>Module</th>
                                    <th>Element</th>
                                    <th>Room</th>
                                    <th>Message Type</th>
                                    <th>Message Content</th>
                                    <th>Date Sent</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($messages as $message)
                                    <tr>
                                        <td>{{ $message->professor->name }}</td>
                                        <td>{{ $message->creneau->elementDeModule->module->name ?? 'N/A' }}</td>
                                        <td>{{ $message->creneau->elementDeModule->name ?? 'N/A' }}</td>
                                        <td>{{ $message->creneau->room->name ?? 'N/A' }}</td>
                                        <td>{{ ucfirst($message->message_type) }}</td>
                                        <td>{{ $message->message_content }}</td>
                                        <td>{{ $message->created_at->format('Y-m-d H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- End Table Responsive -->

                </div><!-- End Card Body -->
            </div><!-- End Card -->
        </div><!-- End Col -->
    </div><!-- End Row -->
</section>
@endsection
