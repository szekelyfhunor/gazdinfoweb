@extends('dashboard.layout.main')

@section('title', 'Évfolyamok')

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
                        <a href="{{ route('dashboard.classes.create') }}" class="btn btn-success btn-sm"><i
                                class="fas fa-plus"></i> Új évfolyam</a>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover my-table">
                            <thead class="my-table-header">
                            <tr>
                                <th class="text-center align-middle">Évszám</th>
                                <th class="text-center align-middle">Tanévszerkezet</th>
                                <th class="text-center align-middle">Órarend</th>
                                <th class="text-center align-middle">Tanterv</th>
                                <th class="text-center align-middle">Aktuális évfolyam</th>
                                <th class="text-center align-middle">Beiratkozottak száma</th>
                                <th class="text-center align-middle">Végzettek száma</th>
                                <th class="text-center align-middle">Végzett-e?</th>
                                <th colspan="2" class="text-center align-middle">Műveletek</th>
                            </tr>
                            </thead>
                            <tbody class="my-table-body">
                            @foreach ($classes as $class)
                                <tr>
                                    <td class="text-center">{{$class->year}}</td>
                                    <td class="text-center"><button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#pdfModal" onclick='OpenFile("academic_calendar","{{asset($class->getFirstMediaUrl('academic_calendar'))}}")'><i class="fas fa-info" ></i></button></td>
                                    <td class="text-center"><button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#pdfModal" onclick='OpenFile("timetable","{{asset($class->getFirstMediaUrl('timetable'))}}")'><i class="fas fa-list-ol"></i></button></td>
                                    <td class="text-center"><button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#pdfModal" onclick='OpenFile("curriculum","{{asset($class->getFirstMediaUrl('curriculum'))}}")'><i class="fas fa-clipboard-list"></i></button></td>
                                    <td class="text-center">{{$class->current_grade}}</td>
                                    <td class="text-center">{{$class->enrolled}}</td>
                                    <td class="text-center">{{$class->graduated_number}}</td>
                                    <td class="text-center">{{$class->is_finished== 1 ? 'Igen': 'Nem'}}</td>
                                    <td class="text-center text-nowrap">
                                        <a href="{{ route('dashboard.classes.edit', $class->id) }}"
                                           class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Szerkeszt</a>

                                    </td>
                                    <td class="text-center text-nowrap">
                                        <button id="delete-class"  data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-danger btn-sm" type="submit" onclick="Remove({{$class->id}}, this)"><i class="fas fa-trash" ></i> Töröl
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


