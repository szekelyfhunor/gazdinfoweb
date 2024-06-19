@extends('frontend.layout.master')
@section('activeDiplomatheses', 'class="active"')
@section('activeTheses', 'class="active"')

@section('content')
    <main id="main">
        <div class="breadcrumbs" data-aos="fade-in">
            <div class="container">
                <h2>Diplomadolgozat témák</h2>
                <p>Jelentkezés diplomadolgozat témákra</p>
            </div>
        </div>

        @if($diplomaTheses->isEmpty())
            <div class="col text-center bs-success vertical-center" style="height: 300px">
                <h2>Nincsenek megjeleníthető témák</h2>
            </div>
        @else
            @livewire('thesis-table', ['diplomaTheses' => $diplomaTheses, 'users' => $users])
        @endif
    </main>
@endsection
