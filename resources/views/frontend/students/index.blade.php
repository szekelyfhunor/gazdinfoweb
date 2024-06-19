@extends('frontend.layout.master')
@section('activeStudents')
    class="active"
@endsection
@section('activeClass')
    class="active"
@endsection

@section('content')
    <main id="main">
        <div class="breadcrumbs" data-aos="fade-in">
            <div class="container">
                <h2>Hallgatók</h2>
                <p>Záróvizsgával rendelkező hallgatók névsora</p>
            </div>
        </div>
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">
                @foreach($classes as $classe)
                <div class="section-title my-student-section-title">
                    <h2>Hallgatók</h2>
                    <p>Évfolyam: {{$classe->year}} - {{$classe->year + 3}}</p>
                </div>
                <div class="row">
                    <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
                        <ul class="my-student-ul">
                            @foreach($students as $student)
                                @if($classe->year == $student->classes->year)
                                    <li><span><img src="{{asset('/assets/img/sapilogo/sapilogo.png')}}" width="14" height="25"> {{$student->user->name}}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
@endsection
