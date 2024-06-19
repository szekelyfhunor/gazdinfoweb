@extends('dashboard.layout.main')

@section('title', 'Felhasználók')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach (array_unique($errors->all()) as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @livewire("user-search")
        </div>
    </div>
    <!-- Creates the bootstrap modal where the image will appear -->
    <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="imageTitle">Image preview</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body">
                    <img  src="" alt="Nincs megjeleníthető kép" class="my-wh"  id="imagepreview"  style="width: 100%; height: 100%;">
                </div>
            </div>
        </div>
    </div>
    <script>
        function showImg(name,path){
            console.log('showImg');
            console.log(path);

            $('#imagepreview').attr("src", path);
            $('#imageTitle').text(name);
        }
        $( "#imagepreview" )
            .error(function() {
                $("#imagepreview").hide();
            });
    </script>
@endsection

