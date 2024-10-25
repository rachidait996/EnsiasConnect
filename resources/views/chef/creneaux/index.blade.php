@extends('layouts.app')

@section('title', 'Timetable')

@section('content')
<div class="container">
    <div class="card">

    <h6 class="card-title"><strong>Timetable of : group:</strong> {{$groupe}},<strong>  semester:</strong> {{$semestre}},<strong> period:</strong>{{$periode}},<strong>  level:</strong>{{$levelName}} </h6>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th class="bg-dark text-white">Days / Time</th>
                            @foreach($timeslots as $timeslot)
                                <th class="bg-dark text-white">{{ $timeslot['start'] }} - {{ $timeslot['end'] }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($days as $day)
                            <tr>
                                <th class="align-middle bg-secondary text-white">{{ ucfirst($day) }}</th>
                                @foreach($timeslots as $timeslot)
                                    @php
                                        $creneau = $creneaux->firstWhere(function($c) use ($day, $timeslot) {
                                            return $c['creneau']->day === $day &&
                                                   $c['creneau']->start_time === $timeslot['start'] && 
                                                   $c['creneau']->end_time === $timeslot['end'];
                                        });
                                    @endphp
                                    <td>
                                        <div class="creneau bg-light p-4 mb-2 rounded" 
                                             data-bs-toggle="modal" 
                                             data-bs-target="#creneauFormModal" 
                                             data-day="{{ $day }}" 
                                             data-start="{{ $timeslot['start'] }}" 
                                             data-end="{{ $timeslot['end'] }}">
                                            @if($creneau)
                                                <div>
                                                    <strong>{{ $creneau['module']->name ?? '' }}</strong><br>
                                                    {{ $creneau['element']->name ?? '' }}<br>
                                                    {{ $creneau['professor']->name ?? '' }}<br>
                                                    {{ $creneau['room']->name ?? '' }}<br>
                                                </div>
                                            @else
                                                {{ $timeslot['start'] }} - {{ $timeslot['end'] }}
                                            @endif
                                        </div>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal pour le formulaire de créneau -->
<div class="modal fade" id="creneauFormModal" tabindex="-1" role="dialog" aria-labelledby="creneauFormModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="creneauFormModalLabel">Créer/Modifier un créneau</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="GET" action="{{ route('creneaux.index') }}">
                    @csrf
                    <input type="hidden" name="keep_modal_open" value="true">
                    <div class="mb-3">
                        <label for="start_time" class="form-label">Heure de début:</label>
                        <input type="text" class="form-control" id="start_time" name="start_time" value="{{ old('start_time', $startTime) }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="end_time" class="form-label">Heure de fin:</label>
                        <input type="text" class="form-control" id="end_time" name="end_time" value="{{ old('end_time', $endTime) }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="jour" class="form-label">Jour:</label>
                        <input type="text" class="form-control" id="jour" name="jour" value="{{ old('jour', $jour) }}" readonly>
                    </div>
                    <!-- Add more fields as per your existing form -->
                    <div class="mb-3">
                        <label for="module" class="form-label">Sélectionnez un module:</label>
                        <select name="module" id="module" class="form-select" onchange="this.form.submit()">
                            <option value="">Sélectionnez un module</option>
                            @foreach($modules as $module)
                                <option value="{{ $module->id }}" {{ request('module') == $module->id ? 'selected' : '' }}>
                                    {{ $module->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @if(request('module'))
                    <div class="mb-3">
                        <label for="element_de_module">Element de Module:</label>
                        <select name="element_de_module" id="element_de_module" class="form-control" onchange="this.form.submit()">
                            <option value="">Select Element</option>
                            @foreach($elements as $element)
                                <option value="{{ $element->id }}" {{ request('element_de_module') == $element->id ? 'selected' : '' }}>
                                    {{ $element->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    @if(request('element_de_module'))
                    <div class="mb-3">
                        <label for="professeur">Professor:</label>
                        <select name="professeur" id="professeur" class="form-control">
                            <option value="">Select Professor</option>
                            @foreach($profs as $prof)
                                <option value="{{ $prof->id }}" {{ request('professeur') == $prof->id ? 'selected' : '' }}>
                                    {{ $prof->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    

                    <div class="mb-3">
                        <label for="category">Room Category:</label>
                        <select name="category" id="category" class="form-control" onchange="this.form.submit()">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    @if(request('category'))
                    <div class="mb-3">
                        <label for="room">Room:</label>
                        <select name="room" id="room" class="form-control" onchange="this.form.submit()">
                            <option value="">Select Room</option>
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}" {{ request('room') == $room->id ? 'selected' : '' }}>
                                    {{ $room->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                </form>
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{ route('creneaux.store') }}">
                    @csrf
                    <input type="hidden" name="start_time" value="{{ old('start_time', $startTime) }}">
                    <input type="hidden" name="end_time" value="{{ old('end_time', $endTime) }}">
                    <input type="hidden" id="jour" name="jour" value="{{ old('jour', $jour) }}">  
                    <input type="hidden" name="periode" value="{{ $periodeId }}">
                    <input type="hidden" name="groupe" value="{{ $groupId }}">                  
                    <input type="hidden" name="niveau" value="{{ $levelName }}">
                    <input type="hidden" name="element_de_module" value="{{ request('element_de_module') }}">
                    <input type="hidden" name="professeur" value="{{ request('professeur') }}">
                    <input type="hidden" name="room" value="{{ request('room') }}">

                    <button type="submit" class="btn btn-primary">Enregistrer le créneau</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Open modal based on session
    @if(session('keep_modal_open'))
        var myModal = new bootstrap.Modal(document.getElementById('creneauFormModal'), {
            keyboard: false
        });
        myModal.show();
    @endif

    // Set modal data on creneau click
    document.querySelectorAll('.creneau').forEach(function(creneau) {
        creneau.addEventListener('click', function() {
            document.getElementById('start_time').value = creneau.dataset.start;
            document.getElementById('end_time').value = creneau.dataset.end;
            document.getElementById('jour').value = creneau.dataset.day;
        });
    });
</script>
@endpush
