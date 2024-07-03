@extends('frontend.layout.master')
@section('activeDiplomatheses')
    class="active"
@endsection
@section('activeTheses')
    class="active"
@endsection

@section('content')
    <h1>Diplomamunkák</h1>

    <h2>Elérhető témák</h2>
    @if($topics->isEmpty())
        <p>Nincsenek elérhető témák.</p>
    @else
        <ul>
            @foreach($topics as $topic)
                <li>{{ $topic->name }}</li> <!-- Feltételezve, hogy a téma neve a 'name' tulajdonságban van -->
            @endforeach
        </ul>
    @endif

    <h2>Diplomamunkák</h2>
    @foreach($diplomatheses as $diplomathese)
        <div>
            <h3>{{ $diplomathese->title }}</h3>
            <p>{{ $diplomathese->description }}</p>
        </div>
    @endforeach

    <h2>Osztályok</h2>
    @foreach($classes as $class)
        <div>
            <h3>{{ $class->name }}</h3> <!-- Feltételezve, hogy az osztály neve a 'name' tulajdonságban van -->
            <p>Év: {{ $class->year }}</p>
        </div>
    @endforeach
@endsection
