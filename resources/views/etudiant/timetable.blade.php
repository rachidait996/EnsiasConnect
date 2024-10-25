@extends('layouts.app')

@section('title', 'Student Timetable')

@section('content')
<div class="pagetitle">
    <h1>Timetable</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a >Home</a></li>
            <li class="breadcrumb-item active">Timetable</li>
        </ol>
    </nav>
</div>
<section class="section timetable">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Your Timetable of  periode  {{$periodeName}} and semestre {{$semestreName}}</h5>

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
                                                        {{ $creneau->user->name ?? '' }}<br>
                                                        {{ $creneau->room->name ?? '' }}<br>
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
