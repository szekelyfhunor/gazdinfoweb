@extends('dashboard.layout.main')

@section('title', 'Verseny létehozása')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card card-primary card-outline">
                <div class="card-header">Verseny adatai</div>

                <div class="card-body">
                    <form method="post" action="{{route('dashboard.competitions.store')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-8 required">
                                <label>Cím</label>
                                <input name="title" type="text" class="form-control" value="{{old('title')}}">
                            </div>
                            <div class="form-group col-md-4 required">
                                <label>Helszín</label>
                                <input name="location" type="text" class="form-control" value="{{old('location')}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4 required">
                                <label>Részvétel típusa</label>
                                <select name="type_of_participation_id" class="form-control">
                                    @foreach($typeofparticipations as $typeofparticipation)
                                        <option value="{{ $typeofparticipation->id }}" {{ old('type_of_participation_id') == $typeofparticipation->id ? 'selected' : '' }}>{{ $typeofparticipation->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4 required">
                                <label>Helyezés</label>
                                <select name="result" class="form-control">
                                    <option {{old('result')=="I díj"? 'selected':''}} value="I díj">I díj</option>
                                    <option {{old('result')=="II díj"? 'selected':''}} value="II díj">II díj</option>
                                    <option {{old('result')=="III díj"? 'selected':''}} value="III díj">III díj</option>
                                    <option {{old('result')=="Dicséret"? 'selected':''}} value="Dicséret">Dicséret</option>
                                    <option {{old('result')=="Különdíj"? 'selected':''}} value="Különdíj">Különdíj</option>
                                </select>


                            </div>
                            <div class="form-group col-md-4 required">
                                <label>Dátum</label>
                                <input name="date" type="date" class="form-control" value="{{old('date')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="roles">Tanárok</label>
                            <select name="teacher_id[]" id="teacher_user_id" class="form-control form-select select2" multiple="multiple" >
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" {{ (in_array($teacher->id , old('teacher_id', []))) ? 'selected' : '' }}>{{ $teacher->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="roles">Hallgatók</label>
                            <select name="student_id[]" id="student_user_id" class="form-control form-select select2" multiple="multiple" required>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}" {{ (in_array($student->id , old('student_id', []))) ? 'selected' : '' }}>{{ $student->user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12 required">
                                <label>Elérhetőség</label>
                                <input name="availability" type="file" value="" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <button id="comp-submit" type="submit" class="btn btn-primary mr-2">
                                <i class="fas fa-save"></i> Mentés
                            </button>
                            <a href="{{ route('dashboard.competitions.index') }}" class="btn btn-warning"> <i
                                    class="fas fa-arrow-left"></i> Vissza</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#teacher_user_id').select2();
            $('#student_user_id').select2();
        });
    </script>
@endsection

