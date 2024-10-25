@extends('layouts.app')

@section('content')
<div class="pagetitle">
    <h1>Timetable Management</h1>
</div>
<div class="card-body">
    <form method="GET" action="{{ route('student.select') }}">
        @csrf
        <div class="form-group">
            <label for="year">Select Year:</label>
            <select name="year" id="year" class="form-control" onchange="this.form.submit()">
                <option value="">Select Year</option>
                @foreach($years as $year)
                    <option value="{{ $year->id }}" {{ session('selected.year') == $year->id ? 'selected' : '' }}>
                        {{ $year->year }}
                    </option>
                @endforeach
            </select>
        </div>

        @if(session('selected.year'))
            <div class="form-group">
                <label for="semestre">Select Semester:</label>
                <select name="semestre" id="semestre" class="form-control" onchange="this.form.submit()">
                    <option value="">Select Semester</option>
                    @foreach($semestres as $semestre)
                        <option value="{{ $semestre->id }}" {{ session('selected.semestre') == $semestre->id ? 'selected' : '' }}>
                            {{ $semestre->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

        @if(session('selected.semestre'))
            <div class="form-group">
                <label for="periode">Select Period:</label>
                <select name="periode" id="periode" class="form-control">
                    <option value="">Select Period</option>
                    @foreach($periodes as $periode)
                        <option value="{{ $periode->id }}" {{ session('selected.periode') == $periode->id ? 'selected' : '' }}>
                            {{ $periode->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

        @if(session('selected.semestre'))
        <button   class="btn-group" type="submit">View Timetable</button>
        @endif
    </form>
</div>
</div>
</div>
</div>
@endsection























