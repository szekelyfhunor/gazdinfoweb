@extends('dashboard.layout.main')

@section('title', 'Részvétel típus módosítása')

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
                <div class="card-header">Részvétel típus adatai</div>

                <div class="card-body">
                    <form method="post" action="{{route('dashboard.typeofparticipations.update', $typeofparticipation->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12 required">
                                <label>Név</label>
                                <input name="name" type="text" class="form-control" value="{{$errors->any() ? old('name') : $typeofparticipation->name}}">
                            </div>

                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mr-2">
                                <i class="fas fa-save"></i> Mentés
                            </button>
                            <a href="{{ route('dashboard.typeofparticipations.index') }}" class="btn btn-warning"> <i class="fas fa-arrow-left"></i> Vissza</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
