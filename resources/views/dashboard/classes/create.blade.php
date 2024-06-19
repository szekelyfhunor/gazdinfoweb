@extends('dashboard.layout.main')

@section('title', 'Évfolyam létehozása')

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
                <div class="card-header">Évfolyam adatai</div>

                <div class="card-body">
                    <form method="post" action="{{route('dashboard.classes.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6 required">
                                <label>Aktuális évfolyam</label>
                                <select name="current_grade" class="form-control">
                                    <option {{old('current_grade')==1? 'selected':''}} value="1">1</option>
                                    <option {{old('current_grade')==2? 'selected':''}} value="2">2</option>
                                    <option {{old('current_grade')==3? 'selected':''}} value="3">3</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 required">
                                <label>Beiratkozottak száma</label>
                                <input name="enrolled" type="number" min="0" onkeyup="if(this.value < 0) this.value = null;" class="form-control" value="{{old('enrolled')}}">
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4 required">
                                <label>Végzettek száma</label>
                                <input id="graduated_number" name="graduated_number" type="number" min="0" onkeyup="if(this.value < 0) this.value = null;"  class="form-control" value="{{old('graduated_number')}}">
                            </div>
                            <div class="form-group col-md-4 required">
                                <label>Végzett-e?</label>
                                <select id="is_finished" name="is_finished" class="form-control">
                                    <option {{old('is_finished')==1? 'selected':''}} value="1">Igen</option>
                                    <option {{old('is_finished')==0? 'selected':''}} value="0">Nem</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 required">
                                <label>Évszám</label>
                                <input name="year" type="number" class="form-control" value="{{old('year')}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 required">
                                <label>Tanévszerkezet</label>
                                <input name="academic_calendar" type="file" value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 required">
                                <label>Tanterv</label>
                                <input name="curriculum" type="file" value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 required">
                                <label>Órarend</label>
                                <input name="timetable" type="file" value="" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mr-2">
                                <i class="fas fa-save"></i> Mentés
                            </button>
                            <a href="{{ route('dashboard.classes.index')}}" class="btn btn-warning"> <i class="fas fa-arrow-left"></i> Vissza</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#is_finished').click(function() {
            if($('#is_finished').val() == 0){
                $("#graduated_number").prop("readonly", true);
                $("#graduated_number").val("");
            }else{
                $("#graduated_number").prop("readonly", false);
            }
        });
        $( document ).ready(function() {
            if($('#is_finished').val() == 0){
                $("#graduated_number").prop("readonly", true);
            }else{
                $("#graduated_number").prop("readonly", false);
            }
        });
    </script>
@endsection
