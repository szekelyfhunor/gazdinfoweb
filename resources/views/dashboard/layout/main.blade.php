<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sapientia GI | Admin</title>
    <link rel="icon" href="{{asset('img/titleicon.ico')}}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/myStyle.css') }}" rel="stylesheet">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('lib/adminlte2/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


    <!-- jQuery -->


    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>


    {{--SELECT2 CSS--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- AdminLTE App -->
    <script src="{{asset('lib/adminlte2/dist/js/adminlte.min.js')}}"></script>

    {{--Tinymce--}}
    <!-- Place the first <script> tag in your HTML's <head> -->
    <!--<script src="https://cdn.tiny.cloud/1/h0hy7swad87u7zwos9iu0ez9wfvev3i3gsa2ss0bmgjpxoya/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>-->


    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>


</head>


<body class="hold-transition sidebar-mini">
<div class="wrapper">
@include('dashboard.layout.navbar')
@include('dashboard.layout.sidebar')


<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header  ">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 my-title">
                        <h1 class="m-0 text-dark "> @yield('title')</h1>
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @yield('content')
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


</div>
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Megerősítés</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body  my-delete-modal-body">
                Modal body..
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <form id="conf-delete"
                      method="post">
                    @csrf
                    @method('DELETE')
                    <button id="conf-delete" class="btn btn-danger btn-sm"
                            type="submit"><i class="fas fa-trash"></i> Töröl
                    </button>
                </form>
                <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Mégse</button>
            </div>

        </div>
    </div>
</div>
<div class="container">
    <!-- Modal -->
    <div id="pdfModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="modal-header-title" class="modal-title">Modal Header</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <embed id="pdfContent" src=""
                           frameborder="0" width="100%" height="400px">
                    <div id="forFail"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Bezár</button>
                </div>

            </div>
        </div>
    </div>
</div>


<script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" data-auto-replace-svg="nest"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
@livewireStyles

<script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
        $('#my-navbar-id').css("width", window.innerWidth - parseInt( $('#my-navbar-id').css("marginLeft").replace('px', '')));


    });
    $('#pushmenuId').click(function (){
        setTimeout(function(){
            $('#my-navbar-id').css("width", window.innerWidth - parseInt( $('#my-navbar-id').css("marginLeft").replace('px', '')));
        }, 300)
    });
    $(window).on("resize",function(){
        $('#my-navbar-id').css("width", window.innerWidth - parseInt( $('#my-navbar-id').css("marginLeft").replace('px', '')));
    });

    function Remove(e, t) {
        console.log(((t.id).split("-"))[1]);
        switch (((t.id).split("-"))[1]) {
            case 'news':
                $(".my-delete-modal-body").text("Valóban törölni szeretné?");
                var url = '{{ route("dashboard.news.delete", ":slug") }}';
                url = url.replace(':slug', e);
                $("#conf-delete").attr('action', url);
                break;
            case 'programs':
                $(".my-delete-modal-body").text("Valóban törölni szeretné?");
                var url = '{{ route("dashboard.programs.delete", ":id") }}';
                url = url.replace(':id', e);
                $("#conf-delete").attr('action', url);
                break;
            case 'class':
                $(".my-delete-modal-body").text("Valóban törölni szeretné?");
                var url = '{{ route("dashboard.class.delete", ":id") }}';
                url = url.replace(':id', e);
                $("#conf-delete").attr('action', url);
                break;
            case 'itklub':
                $(".my-delete-modal-body").text("Valóban törölni szeretné?");
                var url = '{{ route("dashboard.itklub.delete", ":id") }}';
                url = url.replace(':id', e);
                $("#conf-delete").attr('action', url);
                break;
            case 'competitions':
                $(".my-delete-modal-body").text("Valóban törölni szeretné?");
                var url = '{{ route("dashboard.competitions.delete", ":id") }}';
                url = url.replace(':id', e);
                $("#conf-delete").attr('action', url);
                break;
            case 'diplomatheses':
                $(".my-delete-modal-body").text("Valóban törölni szeretné?");
                var url = '{{ route("dashboard.diplomatheses.delete", ":id") }}';
                url = url.replace(':id', e);
                $("#conf-delete").attr('action', url);
                break;
            case 'users':
                $(".my-delete-modal-body").text("Valóban törölni szeretné?");
                var url = '{{ route("dashboard.users.delete", ":id") }}';
                url = url.replace(':id', e);
                $("#conf-delete").attr('action', url);
                break;
            case 'typeofparticipation':
                $(".my-delete-modal-body").text("Valóban törölni szeretné?");
                var url = '{{ route("dashboard.typeofparticipations.delete", ":id") }}';
                url = url.replace(':id', e);
                $("#conf-delete").attr('action', url);
                break;
            case 'topics':
                $(".my-delete-modal-body").text("Valóban törölni szeretné?");
                var url = '{{ route("dashboard.topics.delete", ":id") }}';
                url = url.replace(':id', e);
                $("#conf-delete").attr('action', url);
                break;
            case 'reviews':
                $(".my-delete-modal-body").text("Valóban törölni szeretné?");
                var url = '{{ route("dashboard.reviews.delete", ":id") }}';
                url = url.replace(':id', e);
                $("#conf-delete").attr('action', url);
                break;
            case 'partners':
                $(".my-delete-modal-body").text("Valóban törölni szeretné?");
                var url = '{{ route("dashboard.partners.delete", ":id") }}';
                url = url.replace(':id', e);
                $("#conf-delete").attr('action', url);
                break;
            case 'subjects':
                $(".my-delete-modal-body").text("Valóban törölni szeretné?");
                var url = '{{ route("dashboard.subjects.delete", ":id") }}';
                url = url.replace(':id', e);
                $("#conf-delete").attr('action', url);
                break;
            default:
                $(".modal-header").text("Hiba");
                $(".my-delete-modal-body").text("Az elem törlése sikertelen");
                break;
        }
    }
    function OpenFile(s,path){
        if(path.includes('academic_calendar') || path.includes('timetable') || path.includes('curriculum') || path.includes('comp_availability') || path.includes('dipl_availability')){
            $("#pdfContent").show();
            $("#forFail").text("");

            switch (s){
                case 'academic_calendar':
                    $("#modal-header-title").text("Tanévszerkezet");
                    $('#pdfContent').attr("src", path);
                    break;
                case 'timetable':
                    $("#modal-header-title").text("Órarend");
                    $('#pdfContent').attr("src", path);
                    break;
                case 'curriculum':
                    $("#modal-header-title").text("Tanterv");
                    $('#pdfContent').attr("src", path);
                    break;
                case 'comp_availability':
                    $("#modal-header-title").text("Elérhetőség");
                    $('#pdfContent').attr("src", path);
                    break;
                case 'dipl_availability':
                    $("#modal-header-title").text("Elérhetőség");
                    $('#pdfContent').attr("src", path);
                    break;
            }
        }else{
            $("#forFail").text("Nincs megjeleníthető file");
            $("#modal-header-title").text("Üzenet");
            $("#pdfContent").hide();
        }
    }



/*----------------------------------------------------------------------------------------------------------------------------------------------*/
 </script>
<script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" data-auto-replace-svg="nest"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>
