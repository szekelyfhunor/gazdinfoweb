@extends('dashboard.layout.main')

@section('title', 'Adminisztrátor főoldal')

@section('content')
<p>Válasszon a menüből!</p>
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif

@endsection



