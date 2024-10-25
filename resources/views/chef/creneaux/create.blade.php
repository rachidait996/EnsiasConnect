<!DOCTYPE html>
<html>
<head>
    <title>Create Schedule</title>
</head>
<body>

    <form method="GET" action="{{ route('creneaux.index') }}">
        @csrf
        <label for="semestre">Sélectionnez un semestre :</label>
        <select name="semestre" id="semestre" onchange="this.form.submit()">
            <option value="">Sélectionnez un semestre</option>
            @foreach($semestres as $semestre)
                <option value="{{ $semestre->id }}" {{ request('semestre') == $semestre->id ? 'selected' : '' }}>
                    {{ $semestre->name }}
                </option>
            @endforeach
        </select>
    <br>
        @if(request('semestre'))
            <label for="module">Sélectionnez une module :</label>
            <select name="module" id="module" >
                <option value="">Sélectionnez un module</option>
                @foreach($modules as $module)
                    <option value="{{ $module->id }}" {{ request('module') == $module->id ? 'selected' : '' }}>
                        {{ $module->name }}
                    </option>
                @endforeach
            </select>
            <br>
            <label for="periode">Sélectionnez une période :</label>
            <select name="periode" id="periode" onchange="this.form.submit()">
                <option value="">Sélectionnez une période</option>
                @foreach($periodes as $periode)
                    <option value="{{ $periode->id }}" {{ request('periode') == $periode->id ? 'selected' : '' }}>
                        {{ $periode->name }}
                    </option>
                @endforeach
            </select>
        @endif

      <br>
      
       @if(request('periode'))
        <label for="element_de_module">Sélectionnez un element_de_module :</label>
        <select name="element_de_module" id="element_de_module" onchange="this.form.submit()">
            <option value="">Sélectionnez un element_de_module</option>
            @foreach($elements as $element)
                <option value="{{ $element->id }}" {{ request('element_de_module') == $element->id ? 'selected' : '' }}>
                    {{ $element->name }}
                </option>
            @endforeach
        </select>
        @endif
        
    <br>
        
        @if(request('element_de_module'))
        <label for="professeur">Sélectionnez un professeur :</label>
        <select name="professeur" id="professeur" onchange="this.form.submit()">
            <option value="">Sélectionnez un professeur</option>
            @foreach($profs as $prof)
                <option value="{{ $prof->id }}" {{ request('professeur') == $prof->id ? 'selected' : '' }}>
                    {{ $prof->name }}
                </option>
            @endforeach
        </select>
        @endif
        <br>
        @if(request('element_de_module'))
        <label for="category">Sélectionnez une catégorie :</label>
        <select name="category" id="category" onchange="this.form.submit()">
            <option value="">Sélectionnez une catégorie</option>
            @foreach($categories as $category)
                <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                    {{ ucfirst($category) }}
                </option>
            @endforeach
        </select>
    @endif
    <br>

    @if(request('category'))
        <label for="room">Sélectionnez une salle :</label>
        <select name="room" id="room" onchange="this.form.submit()" >
            <option value="">Sélectionnez une salle</option>
            @foreach($rooms as $room)
                <option value="{{ $room->id }}" {{ request('room') == $room->id ? 'selected' : '' }}>
                    {{ $room->name }}
                </option>
            @endforeach
        </select>
    @endif
    <br>

</form>

<form method="POST" action="{{ route('creneaux.store') }}">
    @csrf
    <!-- Hidden inputs for each selected option -->
    <input type="hidden" name="semestre" value="{{ request('semestre') }}">
    <input type="hidden" name="module" value="{{ request('module') }}">
    <input type="hidden" name="periode" value="{{ request('periode') }}">
    <input type="hidden" name="element_de_module" value="{{ request('element_de_module') }}">
    <input type="hidden" name="professeur" value="{{ request('professeur') }}">
    <input type="hidden" name="room" value="{{ request('room') }}">

    
    <br>
   
    <br>
    <button type="submit">Enregistrer le créneau</button>
</form>

    
    
    
    
</body>
</html>
