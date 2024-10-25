@extends('layouts.app')

@section('title', 'Professor Timetable')

@section('content')
<div class="pagetitle">
    <h1>Timetable</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item active">Timetable</li>
        </ol>
    </nav>
</div>

<section class="section timetable">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Timetable of : semester  periode  {{$periodeName}} and semestre {{$semestreName}}</h5>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Time</th>
                                    @foreach($days as $day)
                                        <th>{{ ucfirst($day) }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($timeslots as $timeslot)
                                    <tr>
                                        <td>{{ $timeslot['start'] }} - {{ $timeslot['end'] }}</td>
                                        @foreach($days as $day)
                                            @php
                                                $creneau = $creneaux->firstWhere(function($c) use ($day, $timeslot) {
                                                    return $c['day'] === $day &&
                                                           $c['start_time'] === $timeslot['start'] &&
                                                           $c['end_time'] === $timeslot['end'];
                                                });
                                            @endphp
                                            <td class="creneau-cell">
                                                @if($creneau)
                                                    <div class="creneau bg-light p-3 rounded">
                                                        <strong>{{ $creneau->elementDeModule->module->name ?? '' }}</strong><br>
                                                        {{ $creneau->elementDeModule->name ?? '' }}<br>
                                                        {{ $creneau->room->name ?? '' }}<br>
                                                        {{ $creneau->niveau ?? '' }}<br>

                                                        <!-- Send Message Button -->
                                                        <button type="button" class="btn btn-primary mt-1" data-bs-toggle="modal" data-bs-target="#messageModal{{ $creneau->id }}">
                                                            Send Message
                                                        </button>
         <!-- Message Modal -->
<div class="modal fade" id="messageModal{{ $creneau->id }}" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">Message for {{ $creneau->elementDeModule->name ?? '' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('professor.sendMessage', $creneau->id) }}" method="POST">
                    @csrf

                    <!-- Select Recipient Type -->
                    <div class="mb-3">
                        <label for="recipient_type" class="form-label">Recipient</label>
                        <select name="recipient_type" id="recipient_type" class="form-control">
                            <option value="chef_de_filiere">Chef de Filière</option>
                            <option value="student">Students (Group)</option>
                        </select>
                    </div>

                    <!-- Message Type -->
                    <div class="mb-3">
                        <label for="message_type" class="form-label">Message Type</label>
                        <select name="message_type" id="message_type" class="form-control">
                            <option value="cancel">Canceling</option>
                            <option value="reschedule">Rescheduling</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <!-- Message Content -->
                    <div class="mb-3">
                        <label for="message_content" class="form-label">Message</label>
                        <textarea name="message_content" id="message_content" class="form-control" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>
                                                        
 <!-- End Modal -->

                                                    </div>
                                                @else
                                                    <div class="text-center">-</div>
                                                @endif
                                            </td>
                                        @endforeach
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
