@extends('layouts.app')

@section('content')
<div class="pagetitle">
    <h1>Timetable Management</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Select Timetable Parameters</h4>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('creneaux.select') }}">
                        @csrf
                        <div class="form-group">
                            <label for="year">Select Year:</label>
                            <select name="year" id="year" class="form-control" onchange="this.form.submit()">
                                <option value="">Select Year</option>
                                @foreach($years as $year)
                                    <option value="{{ $year->id }}" {{ session('selectedyear') == $year->id ? 'selected' : '' }}>
                                        {{ $year->year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        @if(session('selectedyear'))
                            <div class="form-group">
                                <label for="semestre">Select Semester:</label>
                                <select name="semestre" id="semestre" class="form-control" onchange="this.form.submit()">
                                    <option value="">Select Semester</option>
                                    @foreach($semestres as $semestre)
                                        <option value="{{ $semestre->id }}" {{ session('selectedsemestre') == $semestre->id ? 'selected' : '' }}>
                                            {{ $semestre->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        @if(session('selectedsemestre'))
                            <div class="form-group">
                                <label for="niveau">Select Niveau:</label>
                                <select name="niveau" id="niveau" class="form-control">
                                    <option value="">Select Niveau</option>
                                    @foreach($niveaux as $niveau)
                                        <option value="{{ $niveau }}" {{ session('selectedniveau') == $niveau ? 'selected' : '' }}>
                                            {{ $niveau }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="group">Select Group:</label>
                                <select name="group" id="group" class="form-control">
                                    <option value="">Select Group</option>
                                    @foreach($groups as $group)
                                        <option value="{{ $group->id }}" {{ session('selectedgroup') == $group->id ? 'selected' : '' }}>
                                            {{ $group->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="periode">Select Period:</label>
                                <select name="periode" id="periode" class="form-control" onchange="this.form.submit()">
                                    <option value="">Select Period</option>
                                    @foreach($periodes as $periode)
                                        <option value="{{ $periode->id }}" {{ session('selectedperiode') == $periode->id ? 'selected' : '' }}>
                                            {{ $periode->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
