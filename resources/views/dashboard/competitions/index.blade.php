@extends('dashboard.layout.main')

@section('title', 'Versenyek')

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
                        <a href="{{ route('dashboard.competitions.create') }}" class="btn btn-success btn-sm"><i
                                class="fas fa-plus"></i> Új verseny</a>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover my-table">
                            <thead class="my-table-header">
                            <tr>
                                <th class="text-center align-middle">Cím</th>
                                <th class="text-center align-middle">Elérhetőség</th>
                                <th class="text-center align-middle">Helyszín</th>
                                <th class="text-center align-middle">Részvétel típusa</th>
                                <th class="text-center align-middle">Helyezés</th>
                                <th class="text-center align-middle">Tanárok</th>
                                <th class="text-center align-middle">Hallgatók</th>
                                <th class="text-center align-middle">Dátum</th>
                                <th colspan="2" class="text-center align-middle">Műveletek</th>
                            </tr>
                            </thead>
                            <tbody class="my-table-body">
                            @foreach($competitions as $competition)
                                <tr>
                                    <td class="text-center">{{$competition->title}}</td>
                                    <td class="text-center"><button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#pdfModal" onclick='OpenFile("comp_availability","{{asset($competition->getFirstMediaUrl('comp_availability'))}}")'><i class="fas fa-eye"></i></button></td>
                                    <td class="text-center">{{$competition->location}}</td>
                                    <td class="text-center">{{$competition->typeofparticipations->name}}</td>
                                    <td class="text-center">{{$competition->result}}</td>
                                    <td>
                                        @foreach($users as $user)
                                            @if( in_array($user->id, $competition->teachers->pluck('user_id')->toArray()))
                                                <span class="badge badge-success">{{ $user->name }}</span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($users as $user)
                                            @if( in_array($user->id, $competition->students->pluck('user_id')->toArray()))
                                                <span class="badge badge-success">{{ $user->name }}</span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="text-center">{{$competition->date}}</td>
                                    <td class="text-center text-nowrap">
                                        <a href="{{ route('dashboard.competitions.edit', $competition->id) }}"
                                           class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Szerkeszt</a>
                                    </td>
                                    <td class="text-center text-nowrap">
                                        <button id="delete-competitions"  data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-danger btn-sm" type="submit" onclick="Remove({{$competition->id}}, this)"><i class="fas fa-trash" ></i> Töröl
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

