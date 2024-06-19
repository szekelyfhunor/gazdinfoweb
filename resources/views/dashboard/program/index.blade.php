@extends('dashboard.layout.main')

@section('title', 'Szak információk')

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
                        <a href="{{ route('dashboard.programs.create') }}" class="btn btn-success btn-sm"><i
                                class="fas fa-plus"></i> Új szak információ</a>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover my-table">
                            <thead class="my-table-header">
                            <tr>
                                <th class="text-center align-middle">Intézmény</th>
                                <th class="text-center align-middle">Kar</th>
                                <th class="text-center align-middle">Szaknév(HU)</th>
                                <th class="text-center align-middle">Szaknév(RO)</th>
                                <th class="text-center align-middle">Képzési szint</th>
                                <th class="text-center align-middle">Képzési ág</th>
                                <th class="text-center align-middle">Leírás</th>
                                <th class="text-center align-middle">Akkreditáció</th>
                                <th colspan="2" class="text-center align-middle">Műveletek</th>
                            </tr>
                            </thead>
                            <tbody class="my-table-body">
                            @foreach($programs as $program)
                                <tr>
                                    <td class="text-center">{{$program->institution}}</td>
                                    <td class="text-center">{{$program->faculty}}</td>
                                    <td class="text-center">{{$program->name_hu}}</td>
                                    <td class="text-center">{{$program->name_ro}}</td>
                                    <td class="text-center">{{$program->study_level}}</td>
                                    <td class="text-center">{{$program->field_of_study}}</td>
                                    <td class="text-center" data-toggle="tooltip" title="{!!  substr($program->description,0, 1000) !!}{{strlen($program->description) > 1000?"...":""}}">{{ html_entity_decode( substr($program->description,0,20))}}...</td>
                                    <td class="text-center">{{$program->accreditation}}</td>
                                    <td class="text-center text-nowrap">
                                        <a href="{{ route('dashboard.programs.edit', $program->id) }}"
                                           class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Szerkeszt</a>
                                    </td>
                                    <td class="text-center text-nowrap">
                                        <button id="delete-programs"  data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-danger btn-sm" type="submit" onclick="Remove({{$program->id}}, this)"><i class="fas fa-trash" ></i> Töröl
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
    <script>
        // jQuery code for initializing a tooltip
        $(document).ready(function ()
        {
            // jQuery Attribute value selector to
            // select the specified element and
            // call the tooltip method on it
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection

