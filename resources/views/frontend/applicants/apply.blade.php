@extends('frontend.layout.master')
@section('activeDiplomatheses', 'class="active"')
@section('activeTheses', 'class="active"')

@section('content')
    <main id="main">
        <div class="breadcrumbs" data-aos="fade-in">
            <div class="container">
                <h2>Jelentkezés diplomadolgozatra</h2>
            </div>
        </div>

        <div class="card card-apply card-success card-outline rounded">
            <div class="card-header border-success"><h3>Jelentkező adatai</h3></div>

            <div class="card-body">
                <form action="{{route('frontend.applicants.store')}}" method="POST" role="form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12 required" style="margin-bottom: 15px;">
                            <label>Teljes név</label>
                            <select id="student_user_id" name="student_id"  class="form-control">
                                @foreach($students as $student)
                                    <option value="{{$student->id}} " {{ old('student_id') == $student->id ? 'selected' : '' }}>{{$student->user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 required" style="margin-bottom: 15px;">
                            <label for="notes">Üzenet</label>
                            <textarea class="form-control" name="notes" rows="10" required placeholder="Írd le pár mondatban, miért szeretnél jelentkezni erre a témára."></textarea>
                        </div>
                    </div>
                    <!-- Az aktuális diplomadolgozat id-ját megjelenítő mező -->
                    <div class="form-row">
                        <div class="form-group col-md-12 required" style="margin-bottom: 15px;">
                            <label for="diploma_thesis_id">Diplomadolgozat ID</label>
                            <input type="text" class="form-control" id="diploma_thesis_id" name="diploma_thesis_id" value="{{ $diplomaThesis->id }}" readonly>
                        </div>
                    </div>
                    <!-- Az aktuális diplomadolgozat id-ját megjelenítő mező vége -->
                    <button class="text-center btn btn-success" type="submit">Jelentkezés</button>
                </form>
            </div>
        </div>

    </main>
@endsection
