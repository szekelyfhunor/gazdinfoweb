@extends('dashboard.layout.main')

@section('title', 'ItKlub módosítása')

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
                <div class="card-header">ItKlub adatai</div>

                <div class="card-body">
                    <form method="post" action="{{route('dashboard.itklub.update', $itklub->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12 required">
                                <label>Cím</label>
                                <input name="title" type="text" class="form-control" value="{{$errors->any()?old('title'):$itklub->title}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 required">
                                <label>Leírás</label>
                                <textarea class="form-control" name="description" rows="5">{{$errors->any()?old('description'):$itklub->description}}</textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 required">
                                <label>Kép</label>
                                <input name="image" type="file" value="" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mr-2">
                                <i class="fas fa-save"></i> Mentés
                            </button>
                            <a href="{{ route('dashboard.itklub.index') }}" class="btn btn-warning"> <i class="fas fa-arrow-left"></i> Vissza</a>
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
