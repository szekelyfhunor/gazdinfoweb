@extends('dashboard.layout.main')

@section('title', 'Hírek')

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
                        <a href="{{ route('dashboard.news.create') }}" class="btn btn-success btn-sm"><i
                                class="fas fa-plus"></i> Új hír</a>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover my-table">
                            <thead class="my-table-header">
                            <tr>
                                <th class="text-center align-middle">Szerkesztő</th>
                                <th class="text-center align-middle">Cím</th>
                                <th class="text-center align-middle">Kép</th>
                                <th class="text-center align-middle">Tartalom</th>
                                <th class="text-center align-middle">Dátum</th>
                                <th colspan="2" class="text-center align-middle">Műveletek</th>
                            </tr>
                            </thead>
                            <tbody class="my-table-body">
                            @foreach($news as $new)
                                <tr>
                                    <td class="text-center">{{$new->user->name}}</td>
                                    <td class="text-center">{{$new->title}}</td>
                                    <td class="text-center"><img src="{{asset($new->getFirstMediaUrl('new_image'))}}"  onerror="this.style.display = 'none'" class="my-wh-little"></td>
                                    <td class="text-center" data-toggle="tooltip" title="{{ html_entity_decode(substr($new->content,0, 1000))}} {{strlen($new->content) > 1000?"...":""}}">{{html_entity_decode(substr($new->content,0,20))}}...</td>
                                    <td class="text-center">{{$new->date}}</td>
                                    <td class="text-center text-nowrap">
                                        <a href="{{ route('dashboard.news.edit', $new->slug) }}"
                                           class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Szerkeszt</a>

                                    </td>
                                    <td class="text-center text-nowrap">
                                        <button id="delete-news"  data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-danger btn-sm" type="submit" onclick="Remove('{{$new->slug}}', this)"><i class="fas fa-trash" ></i> Töröl
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

