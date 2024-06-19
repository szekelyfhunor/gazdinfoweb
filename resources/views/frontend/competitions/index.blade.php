@extends('frontend.layout.master')
@section('activeCompetitions')
    class="active"
@endsection
@section('activeTheses')
    class="active"
@endsection

@section('content')
    <main id="main">
        <div class="breadcrumbs" data-aos="fade-in">
            <div class="container">
                <h2>Versenyek</h2>
                <p>Versenyeken résztvett gazdasági informatikus hallgatók.</p>
            </div>
        </div>
        <section id="pricing" class="pricing">
            <div class="container" data-aos="fade-up">
                <div class="row mb-5">
                    @foreach($typeofparticipations as $typeofparticipation)
                    <div class="col-lg-3 col-md-6 mt-4 mt-md-0 my-box-container">
                        <div id="{{$typeofparticipation->name}}"  class="box featured my-competition-box" onclick="showElements(this)">
                            {{$typeofparticipation->name}}
                        </div>
                    </div>
                    @endforeach
                </div>
                <div id="currrently-visible" class="row">
                </div>
            </div>
        </section>
    </main>
    <div class="container">
        <div id="competitionModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 id="modal-header-title" class="modal-title">Modal Header</h4>
                        {{--                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>--}}
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <embed id="pdfContent" src=""
                               frameborder="0" width="100%" height="400px">
                        <div id="forFail"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Bezár</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        showElementWasCalled = false;
        var previous;
        function showElements(e){
            $('.my-competition-box').height('10px');
            showElementWasCalled = true;
            var id = e.id;
            let itsthat;
            let wastrue = false;
            $('#'+ id).addClass("my-competition-title-selected");
            if (previous !== null && previous !== id){
                $('#'+ previous).removeClass("my-competition-title-selected");
            }
            previous = id;
            $( "#currrently-visible" ).empty();

            @foreach($competitions as $competition)
            console.log(typeof({{$competition->typeofparticipations->name}}));
                itsthat = ($({{$competition->typeofparticipations->name}}).attr("id") == id)
                if(itsthat === true){
                    console.log('{{$competition->title}}');
                    wastrue = true;
                }
                (itsthat === true) ? $( "#currrently-visible" ).append(
                    `<div class="my-competition-class col-md-3  d-flex align-items-stretch">
                        <div class="box featured my-competition-box-cards">
                            <h3 class="my-competition-box-student ">
                                @foreach($competition->students as $student)
                                    @if($loop->last)
                                        {{$student->user->name}}
                                    @else
                                        {{$student->user->name}},
                                    @endif
                                @endforeach
                            </h3>
                            <div class="my-competition-box-all my-competition-box-content">
                                <div class="my-competition-box-content-title ">
                                    <p>
                                        <strong>{{$competition->title}}</strong>
                                    </p>
                                </div>
                                <div class="my-competition-box-content-teacher">
                                    <p>
                                        @if(isset($competition->teachers[0]) && isset($competition->teachers[1]))
                                            Felkészítő tanárok:
                                        @elseif(isset($competition->teachers[0]) && !isset($competition->teachers[1]))
                                            Felkészítő tanár:
                                        @endif
                                        @foreach($competition->teachers as $teacher)
                                            @if($loop->last)
                                                {{$teacher->user->name}}
                                            @else
                                                {{$teacher->user->name}},
                                            @endif
                                        @endforeach
                                    </p>
                                </div>
                                <div class="my-competition-box-content-theme">
                                <div>
                                    <p>{{$competition->date}}|{{$competition->location}}</p>
                                    <p>Eredmény: {{$competition->result}}</p>
                                    </div>
                                </div>
                            </div>

                            @hasanyrole('SzuperAdminisztrátor|Adminisztrátor|Tanár|Hallgató')
                            <div class="btn-wrap my-competition-box-bottom">
                                <a href="#" class="btn-buy"  data-bs-toggle="modal" data-bs-target="#competitionModal" onclick='OpenFCompetitions("comp_availability","{{asset($competition->getFirstMediaUrl('comp_availability'))}}#toolbar=0")'>Megtekintés</a>
                            </div>
                            @endhasanyrole
                        </div>
                    </div>
                `): '';
                @if($loop->last)
                    if(!wastrue){
                        $( "#currrently-visible" ).append('<p class="my-competition-notfound">Jelenleg nincs megjeleníthető '+ id + '</p>');
                    }
                @endif
            @endforeach
            correctPercent();
            showCorrectly();
        }
        function OpenFCompetitions(s,path){
            if(path.includes('comp_availability')){
                $("#pdfContent").show();
                $("#forFail").text("");

                $("#modal-header-title").text("Elérhetőség");
                $('#pdfContent').attr("src", path);

            }else{
                $("#forFail").text("Nincs megjeleníthető file");
                $("#modal-header-title").text("Üzenet");
                $("#pdfContent").hide();
            }
        }
        var wasChanged = false;
        function showCorrectly() {
            var md4 = $(window).width() < 1286;
            var md6 = $(window).width() < 990;

            if($(window).width() < 768 && !wasChanged){
                $('.my-competition-box').height('10px');
                wasChanged = true;
            }else if($(window).width() > 768 && wasChanged && !showElementWasCalled){
                $('.my-competition-box').height('400px');
                 wasChanged = false;
            }
            $(".my-competition-class")
                .toggleClass("col-md-3", !md4)
                .toggleClass("col-md-4", md4)
                .toggleClass("col-md-6", md6);
        }
        function correctPercent(){
            console.log($( ".my-competition-box-bottom" ).length);
            if($( ".my-competition-box-bottom" ).length === 0){
                $('.my-competition-box-all').toggleClass("my-competition-box-content");
                $('.my-competition-box-all').toggleClass("my-competition-box-content-guest");
                $('.my-competition-box-student').toggleClass("my-competition-h3");

            }
        }
        $(window).resize(function() {
            showCorrectly();
        });
        $(document).ready(function (){
            showCorrectly();
        });

    </script>
@endsection
