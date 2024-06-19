@extends('dashboard.layout.main')

@section('title', 'Szak információ módosítása')

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
                <div class="card-header">Szak információ adatai</div>

                <div class="card-body">
                    <form method="post" action="{{route('dashboard.programs.update', $program->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6 required">
                                <label>Intézmény</label>
                                <input name="institution" type="text" class="form-control"  value="{{$errors->any() ? old('institution') : $program->institution}}">
                            </div>
                            <div class="form-group col-md-6 required">
                                <label>Kar</label>
                                <input name="faculty" type="text" class="form-control" value="{{$errors->any() ? old('faculty') : $program->faculty}}">
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 required">
                                <label>Szaknév(HU)</label>
                                <input name="name_hu" type="text" class="form-control" value="{{$errors->any() ? old('name_hu') : $program->name_hu}}">
                            </div>
                            <div class="form-group col-md-6 required">
                                <label>Szaknév(RO)</label>
                                <input name="name_ro" type="text" class="form-control" value="{{$errors->any() ? old('name_ro') : $program->name_ro}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4 required">
                                <label>Képzési szint</label>
                                <input name="study_level" type="text" class="form-control" value="{{$errors->any() ? old('study_level') : $program->study_level}}">
                            </div>
                            <div class="form-group col-md-4 required">
                                <label>Képzési ág</label>
                                <input name="field_of_study" type="text" class="form-control" value="{{$errors->any() ? old('field_of_study') : $program->field_of_study}}">
                            </div>
                            <div class="form-group col-md-4 required">
                                <label>Akkreditáció</label>
                                <input name="accreditation" type="date" class="form-control" value="{{$errors->any() ? old('accreditation') : $program->accreditation}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 required">
                                <label>Leírás</label>
                                <textarea class="form-control" name="description" rows="5">{{$errors->any() ? old('description') : $program->description}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mr-2">
                                <i class="fas fa-save"></i> Mentés
                            </button>
                            <a href="{{ route('dashboard.programs.index') }}" class="btn btn-warning"> <i class="fas fa-arrow-left"></i> Vissza</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        tinymce.init({
            selector: 'textarea',
            height: 400,
            menubar: false,
            toolbar_mode: 'sliding',
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount table image',
            ],
            toolbar: 'preview code | undo redo | fontselect fontsizeselect formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | table  image   | help',
        });
    </script>
@endsection
