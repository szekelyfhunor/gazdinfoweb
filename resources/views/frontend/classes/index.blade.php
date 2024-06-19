@extends('frontend.layout.master')

@section('activeClasses')
    class="active"
@endsection
@section('activeClass')
    class="active"
@endsection
@section('content')
<main id="main">
    <div class="breadcrumbs mb-5" data-aos="fade-in">
        <div class="container">
            <h2>Aktív évfolyamok</h2>
            <p>A szak jelenleg aktív évfolyamai</p>
        </div>
    </div>

    <section id="features" class="features">
        <div class="container" data-aos="fade-up">
            @foreach($classes as $classe)
                <div class="section-title mt-5 pb-0">
                    <h2>Aktív évfolyamok</h2>
                    <p>{{$classe->year}} - {{\Carbon\Carbon::now()->year}} - {{$classe->current_grade}} év</p>
                </div>
                <div class="row my-class-row" data-aos="zoom-in" data-aos-delay="100">
                    <div class="col-lg-3 col-md-4 mt-4">
                        <div class="icon-box my-cursor" data-bs-toggle="modal" data-bs-target="#frontendpdfModal" onclick='OpenFrontendFile("curriculum","{{asset($classe->getFirstMediaUrl('curriculum'))}}")'>
                           <img  src="{{asset('/assets/img/classes/curriculum.png')}}" class="my-img-marging" width="48" height="48" />
                            <h3>Tanterv</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mt-4">
                        <div class="icon-box my-cursor" data-bs-toggle="modal" data-bs-target="#frontendpdfModal" onclick='OpenFrontendFile("academic_calendar","{{asset($classe->getFirstMediaUrl('academic_calendar'))}}")'>
                            <img src="{{asset('/assets/img/classes/academic.png')}}" class="my-img-marging" width="48" height="48" />
                            <h3>Tanévszerkezet</h3>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section><
    <div class="container">
        <div id="frontendpdfModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 id="modal-header-title" class="modal-title">Modal Header</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div id="embed-container-parent">
                            <iframe id="pdfContent" src=""
                                    frameborder="0" width="100%" height="400px"></iframe>
                            <div id="forFail"></div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Bezár</button>
                    </div>

                </div>
            </div>

        </div>

    </div>

</main>
<script>
    function OpenFrontendFile(s,path){
        console.log('ide jott');
        if(path.includes('academic_calendar') || path.includes('timetable') || path.includes('curriculum') || path.includes('comp_availability') || path.includes('dipl_availability')){
            $("#pdfContent").show();
            $("#forFail").text("");
            console.log('ide jott2');
            console.log(s);
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
            }
        }else{
            $("#forFail").text("Nincs megjeleníthető file");
            $("#modal-header-title").text("Üzenet");
            $("#pdfContent").hide();
        }
    }


</script>
@endsection
