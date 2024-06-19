@extends('dashboard.layout.main')

@section('title', 'Részvétel típusa')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div>
                        <a href="{{ route('dashboard.typeofparticipations.create') }}" class="btn btn-success btn-sm"><i
                                class="fas fa-plus"></i> Új részvétel típus</a>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover my-table">
                            <thead class="my-table-header">
                            <tr>
                                <th class="text-center align-middle">Név</th>
                                <th colspan="2" class="text-center align-middle">Műveletek</th>
                            </tr>
                            </thead>
                            <tbody class="my-table-body">
                            @foreach($typeofparticipations as $typeofparticipation)
                                <tr>
                                    <td class="text-center">{{$typeofparticipation->name}}</td>
                                    <td class="text-center text-nowrap">
                                        <a href="{{ route('dashboard.typeofparticipations.edit', $typeofparticipation->id) }}"
                                           class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Szerkeszt</a>

                                    </td>
                                    <td class="text-center text-nowrap">
                                        <button id="delete-typeofparticipation"  data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-danger btn-sm" type="submit" onclick="Remove({{$typeofparticipation->id}}, this)"><i class="fas fa-trash" ></i> Töröl
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
@endsection

