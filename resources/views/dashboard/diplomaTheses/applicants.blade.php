@extends('dashboard.layout.main')

@section('title', 'Jelentkezések')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <a href="{{ route('dashboard.diplomatheses.index') }}" class="btn btn-warning mb-4">
                        <i class="fas fa-arrow-left"></i> Vissza
                    </a>
                    @if ($applicants->isNotEmpty())
                        <table class="table table-bordered table-hover my-table">
                            <thead class="my-table-header">
                                <tr>
                                    <th class="text-center align-middle">Dolgozat címe</th>
                                    <th class="text-center align-middle">Hallgató</th>
                                    <th class="text-center align-middle">Státusz</th>
                                    <th class="text-center align-middle">Jelentkezés időpontja</th>
                                    <th colspan="2" class="text-center align-middle">Műveletek</th>
                                </tr>
                            </thead>
                            <tbody class="my-table-body">
                                @foreach ($applicants as $applicant)
                                    <tr>
                                        <td class="text-center">
                                            @if($applicant->diplomaTheses->isNotEmpty())
                                                {{ $applicant->diplomaTheses->first()->title }}
                                            @else
                                                Nincs diplomadolgozat
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @foreach ($applicant->student as $student)
                                                {{ $student->user->name }}@if (!$loop->last), @endif
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            <span class="badge 
                                                @if($applicant->status === 'pending') badge-warning 
                                                @elseif($applicant->status === 'accepted') badge-success 
                                                @elseif($applicant->status === 'rejected') badge-danger 
                                                @endif">
                                                @if($applicant->status === 'pending') Folyamatban
                                                @elseif($applicant->status === 'accepted') Elfogadva
                                                @elseif($applicant->status === 'rejected') Elutasítva
                                                @endif
                                            </span>
                                        </td>                                                                                
                                        <td class="text-center">{{ $applicant->created_at }}</td>
                                        <td class="text-center text-nowrap">
                                            <form action="{{ route('accept', $applicant->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Elfogad</button>
                                            </form>
                                        </td>
                                        <td class="text-center text-nowrap">
                                            <form action="{{ route('reject', $applicant->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">Elutasít</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Nincsenek jelentkezések.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
