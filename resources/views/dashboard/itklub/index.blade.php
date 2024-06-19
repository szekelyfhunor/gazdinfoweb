@extends('dashboard.layout.main')

@section('title', 'ItKlub')

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
                        <a href="{{ route('dashboard.itklub.create') }}" class="btn btn-success btn-sm"><i
                                class="fas fa-plus"></i> Új ItKlub</a>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover my-table">
                            <thead class="my-table-header">
                            <tr>
                                <th class="text-center align-middle">Cím</th>
                                <th class="text-center align-middle">Leírás</th>
                                <th class="text-center align-middle">Kép</th>
                                <th colspan="2" class="text-center align-middle">Műveletek</th>
                            </tr>
                            </thead>
                            <tbody class="my-table-body">
                            @foreach($itklubs as $itklub)
                                <tr>
                                    <td class="text-center">{{$itklub->title}}</td>
                                    <td class="text-center" data-toggle="tooltip" title="{{ html_entity_decode(substr($itklub->description,0, 1000)) }}{{strlen($itklub->description) > 1000?"...":""}}">{{html_entity_decode(substr($itklub->description,0,20))}}...</td>
                                    <td class="text-center" ><img src="{{asset($itklub->getFirstMediaUrl('itklub_image'))}}" onerror="this.style.display = 'none'" class="my-wh-little"></td>
                                    <td class="text-center text-nowrap">
                                        <a href="{{ route('dashboard.itklub.edit',  $itklub->id)}}"
                                           class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Szerkeszt</a>

                                    </td>
                                    <td class="text-center text-nowrap">
                                        <button id="delete-itklub"  data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-danger btn-sm" type="submit" onclick="Remove({{$itklub->id}}, this)"><i class="fas fa-trash" ></i> Töröl
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
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection

