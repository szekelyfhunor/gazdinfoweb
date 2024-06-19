@extends('dashboard.layout.main')

@section('title', 'Tantárgy létehozása')

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
                <div class="card-header">Tantárgy adatai</div>

                <div class="card-body">
                    <form method="post" action="{{route('dashboard.subjects.store')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-12 required">
                                <label>Tantárgy neve</label>
                                <input name="name" type="text" class="form-control" value="{{old('name')}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 required">
                                <label>Tantárgy képe</label>
                                <input name="image" type="file" value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mr-2">
                                <i class="fas fa-save"></i> Mentés
                            </button>
                            <a href="{{ route('dashboard.subjects.index') }}" class="btn btn-warning"> <i class="fas fa-arrow-left"></i> Vissza</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
