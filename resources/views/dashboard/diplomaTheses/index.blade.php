@extends('dashboard.layout.main')

@section('title', 'Diplomadolgozatok')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="d-flex align-items-center">
                        <div>
                            <a href="{{ route('dashboard.diplomatheses.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Új diplomadolgozat</a>
                        </div>
                        <div class="ms-2">
                            <a href="{{ route('dashboard.diplomatheses.applicants') }}" class="btn btn-primary">
                                Jelentkezések
                            </a>                                                        
                        </div>
                    </div>
                    
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover my-table">
                            <thead class="my-table-header">
                            <tr>
                                <th class="text-center align-middle">Hallgató</th>
                                <th class="text-center align-middle">Cím</th>
                                <th class="text-center align-middle">Leírás</th>
                                <th class="text-center align-middle">Témakör</th>
                                <th class="text-center align-middle">Témavezetők</th>
                                <th colspan="2" class="text-center align-middle">Műveletek</th>
                            </tr>
                            </thead>
                            <tbody class="my-table-body">
                            @foreach($diplomatheses as $diplomathese)
                                <tr>
                                    <td class="text-center">{{ $diplomathese->student->user->name ?? ' ' }}</td>
                                    <td class="text-center">{{ $diplomathese->title }}</td>
                                    <td>{{ $diplomathese->abstract }}</td>
                                    <td>
                                        @foreach($topics as $topic)
                                            @if(in_array($topic->id, $diplomathese->topics->pluck('id')->toArray()))
                                                <span class="badge badge-success">{{ $topic->name }}</span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($diplomathese->teacher as $teacher)
                                            <span class="badge badge-success">{{ $teacher->user->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="text-center text-nowrap">
                                        @if ($diplomathese->status === 'accepted')
                                            <a href="{{ route('dashboard.diplomatheses.editAccepted', $diplomathese->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Szerkeszt</a>
                                        @else
                                            <a href="{{ route('dashboard.diplomatheses.edit', $diplomathese->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Szerkeszt</a>
                                        @endif
                                    </td>                                    
                                    <td class="text-center text-nowrap">
                                        <button id="delete-diplomatheses" data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-danger btn-sm" type="submit" onclick="Remove({{ $diplomathese->id }}, this)"><i class="fas fa-trash"></i> Töröl</button>
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
