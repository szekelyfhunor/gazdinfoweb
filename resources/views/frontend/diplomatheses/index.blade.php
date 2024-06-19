@extends('frontend.layout.master')
@section('activeDiplomatheses')
    class="active"
@endsection
@section('activeTheses')
    class="active"
@endsection

@section('content')
    <main id="main">

        <div class="breadcrumbs" data-aos="fade-in">
            <div class="container">
                <h2>Diplomadolgozatok</h2>
                <p>A szakot elvégző hallgatók által készített dolgozatok. </p>
            </div>
        </div>
        <section id="pricing" class="pricing">
            <div class="container my-flex" data-aos="fade-up">
                <div id="my-left-list" class="my-left-list-class">
                    <h4 class="my-diploamthese-heading">Szűrők</h4>
                    <button id="remove-filter"><i class="fas fa-trash" ></i> Szűrők törlése</button>
                    <div id="chb-class-parent">
                        <div id="showHideClasses" class="d-flex justify-content-between align-items-center">
                            <h5 >Évfolyamok  </h5>
                            <i id="showHideClassesArrow" class="fa fa-angle-down"></i>
                        </div>

                        <div id="visibleClasses">
                            @foreach($classes as $classe)
                                <div id="chb-class">
                                    <input class="form-check-input"  onchange="getdata()" type="checkbox" id="{{ $classe->year + 3 }}" name="{{ $classe->year + 3 }}" value="{{ $classe->year + 3}}">
                                    <label for="{{ $classe->year + 3}}"> {{ $classe->year + 3 }}</label><br>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div id="chb-topic-parent">
                        <div id="showHideTopics" class="d-flex justify-content-between align-items-center">
                            <h5>Témák</h5>
                            <i id="showHideTopicsArrow" class="fa fa-angle-down"></i>
                        </div>
                        <div  id="visibleTopics">
                            @foreach($topics as $topic)
                               <div id="chb-topic">
                                    <input  class="form-check-input"  onchange="getdata()" type="checkbox" id="{{ $topic->name }}" name="{{ $topic->name }}" value="{{ $topic->name }}">
                                    <label for="{{ $topic->name }}"> {{ $topic->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div id="currrently-visible-diplomatheses" class="row currrently-visible-diplomatheses-class">
                </div>
            </div>
        </section>
    </main>
    <div class="container">

        <div id="diplomaModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 id="modal-header-title" class="modal-title">Modal Header</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <iframe id="pdfContent" src=""
                                frameborder="0" width="100%" height="400px"></iframe>
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
        function OpenFDiploma(s,path){
            console.log('OpenFDiploma1')
            if(path.includes('dipl_availability')){
                console.log('OpenFDiploma2')
                $("#pdfContent").show();
                $("#forFail").text("");


                $("#modal-header-title").text("Elérhetőség");
                $('#pdfContent').attr("src", path);

                console.log($('#pdfContent').contents());
            }else{
                console.log('OpenFDiploma3')
                $("#forFail").text("Nincs megjeleníthető file");
                $("#modal-header-title").text("Üzenet");
                $("#pdfContent").hide();
            }
        }
        function getdata() {
            var selectedclasses = [];
            var selectedtopics = [];
            $("#chb-topic input[type=checkbox]:checked").each(function () {
                selectedtopics.push(this.value);
            });
            $("#chb-class input[type=checkbox]:checked").each(function () {
                console.log(this.value)
                console.log(this.value - 3)
                selectedclasses.push(this.value - 3);
            });
            var selectedtopicsLength = selectedtopics.length
            var selectedclassesLength = selectedclasses.length
            var wasShowed = false;

            $( "#currrently-visible-diplomatheses" ).empty();

            if(selectedclassesLength > 0 && selectedtopicsLength > 0 ){
                @foreach($classes as $classe)
                    $.each(selectedclasses, function( index, value ) {
                        if({{$classe->year}} == value){
                            var visible = true;
                            @foreach($classe->students as $student)
                                @if($student->diplomathese)
                                    var db = 0;
                                    @foreach($student->diplomathese->topics as $topic)
                                        $.each(selectedtopics, function( index, value ) {
                                            if('{{$topic->name}}' == value){
                                                db++;
                                            }
                                        });
                                    @endforeach
                                    if(selectedtopicsLength == db){
                                        if(visible){
                                            var titleValue = value + 3;
                                            $( "#currrently-visible-diplomatheses" ).append('<h4 class="my-diploamthese-heading">' + titleValue +'</h4>');
                                            visible = false;
                                            wasShowed = true;
                                        }
                                        $( "#currrently-visible-diplomatheses" ).append(
                                            `<div class="my-diploma-class col-md-3 mt-4 d-flex align-items-stretch">
                                                <div class="box featured my-diploamthese-box">
                                                    <h3 class="my-diploamthese-box-student">{{$student->user->name}}</h3>
                                                    <div class="my-diploamthese-box-all my-diploamthese-box-content">
                                                        <div class="my-diploamthese-box-content-title">
                                                            <p>
                                                                <strong>{{$student->diplomathese->title}}</strong>
                                                            </p>
                                                        </div>
                                                        <div class="my-competition-box-content-teacher">
                                                            <p>
                                                                @if(isset($student->diplomathese->teacher[0]) && isset($student->diplomathese->teacher[1]))
                                                                    <h5>Témavezetők</h5>
                                                                @elseif(isset($student->diplomathese->teacher[0]) && !isset($student->diplomathese->teacher[1]))
                                                                    <h5>Témavezető</h5>
                                                                @endif
                                                                @foreach($student->diplomathese->teacher as $teacher)
                                                                    @if($loop->last)
                                                                        {{$teacher->user->name}}
                                                                    @else
                                                                        {{$teacher->user->name}},
                                                                    @endif
                                                                @endforeach
                                                            </p>
                                                        </div>
                                                        <div class="my-diploamthese-box-content-theme">
                                                            @if(count($student->diplomathese->topics) > 1)
                                                                <h5>Témák</h5>
                                                                <p>
                                                                @foreach($student->diplomathese->topics as $topic)
                                                                    @if($loop->last)
                                                                        {{$topic->name}}
                                                                    @else
                                                                        {{$topic->name}},
                                                                    @endif
                                                                @endforeach
                                                                </p>
                                                            @elseif(count($student->diplomathese->topics) == 1)
                                                                <h5>Téma</h5>
                                                                <p>{{$student->diplomathese->topics[0]->name}}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @hasanyrole('SzuperAdminisztrátor|Adminisztrátor|Tanár|Hallgató')
                                                    <div class="btn-wrap my-diploamthese-box-bottom">
                                                        <a href="#" class="btn-buy" data-bs-toggle="modal" data-bs-target="#diplomaModal" onclick='OpenFDiploma("dipl_availability","{{asset($student->diplomathese->getFirstMediaUrl('dipl_availability'))}}#toolbar=0")'>Megtekintés</a>
                                                    </div>
                                                    @endhasanyrole
                                                </div>
                                            </div>`
                                        )
                                    }
                                @endif
                            @endforeach
                        }
                    });
                @endforeach
                if(!wasShowed){
                    $( "#currrently-visible-diplomatheses" ).append('<h4 class="my-diploamthese-heading">Nincs megjeleníthető dolgozat!</h4>');
                }
                correctPercent();
                showCorrectly();

            }else if(selectedclassesLength > 0 && selectedtopicsLength === 0 ){
                console.log('b');
                @foreach($classes as $classe)
                    $.each(selectedclasses, function( index, value ) {
                        if({{$classe->year}} == value){
                            wasShowed = true;
                            var titleValue = value + 3;
                            $( "#currrently-visible-diplomatheses" ).append('<h4 class="my-diploamthese-heading">' + titleValue +'</h4>');
                            $( "#currrently-visible-diplomatheses" ).append(
                                `@foreach($classe->students as $student)
                                    @if($student->diplomathese)
                                        <div class="my-diploma-class col-md-3 mt-4 d-flex align-items-stretch">
                                            <div class="box featured my-diploamthese-box">
                                                <h3 class="my-diploamthese-box-student">{{$student->user->name}}</h3>
                                                <div class="my-diploamthese-box-all my-diploamthese-box-content">
                                                    <div class="my-diploamthese-box-content-title">
                                                        <p>
                                                            <strong>{{$student->diplomathese->title}}</strong>
                                                        </p>
                                                    </div>
                                                    <div class="my-competition-box-content-teacher">
                                                        <p>
                                                            @if(isset($student->diplomathese->teacher[0]) && isset($student->diplomathese->teacher[1]))
                                                                <h5>Témavezetők</h5>
                                                            @elseif(isset($student->diplomathese->teacher[0]) && !isset($student->diplomathese->teacher[1]))
                                                                <h5>Témavezető</h5>
                                                            @endif
                                                            @foreach($student->diplomathese->teacher as $teacher)
                                                                @if($loop->last)
                                                                    {{$teacher->user->name}}
                                                                @else
                                                                    {{$teacher->user->name}},
                                                                @endif
                                                            @endforeach
                                                        </p>
                                                    </div>
                                                    <div class="my-diploamthese-box-content-theme">
                                                        @if(count($student->diplomathese->topics) > 1)
                                                            <h5>Témák</h5>
                                                            <p>
                                                                @foreach($student->diplomathese->topics as $topic)
                                                                    @if($loop->last)
                                                                        {{$topic->name}}
                                                                    @else
                                                                        {{$topic->name}},
                                                                    @endif
                                                                @endforeach
                                                            </p>
                                                        @elseif(count($student->diplomathese->topics) == 1)
                                                            <h5>Téma</h5>
                                                            <p>{{$student->diplomathese->topics[0]->name}}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                @hasanyrole('SzuperAdminisztrátor|Adminisztrátor|Tanár|Hallgató')
                                                <div class="btn-wrap my-diploamthese-box-bottom">
                                                    <a href="#" class="btn-buy" data-bs-toggle="modal" data-bs-target="#diplomaModal" onclick='OpenFDiploma("dipl_availability","{{asset($student->diplomathese->getFirstMediaUrl('dipl_availability'))}}#toolbar=0")'>Megtekintés</a>
                                                </div>
                                                @endhasanyrole
                                            </div>
                                       </div>
                                   @endif
                                @endforeach`
                            )
                        }
                    });
                @endforeach
                if(!wasShowed){
                    $( "#currrently-visible-diplomatheses" ).append('<h4 class="my-diploamthese-heading">Nincs megjeleníthető dolgozat!</h4>');
                }
                correctPercent();
                showCorrectly();

            }else if(selectedclassesLength === 0 && selectedtopicsLength > 0 ){
                console.log('c');
                @foreach($classes as $classe)
                    var visible = true;
                    console.log('{{$classe->year}}');
                        @foreach($classe->students as $student)
                            @if($student->diplomathese)
                                var db = 0;
                                console.log('{{$student->user->name}}');
                                @foreach($student->diplomathese->topics as $topic)

                                    $.each(selectedtopics, function( index, value ) {
                                        if('{{$topic->name}}' == value){
                                            db++;

                                        }
                                    });
                                @endforeach
                                if(selectedtopicsLength == db){
                                    if(visible){
                                        $( "#currrently-visible-diplomatheses" ).append('<h4 class="my-diploamthese-heading">' + {{$classe->year + 3}} +'</h4>');
                                        visible = false;
                                        wasShowed = true;
                                    }
                                    $( "#currrently-visible-diplomatheses" ).append(
                                        `<div class="my-diploma-class col-md-3 mt-4 d-flex align-items-stretch">
                                            <div class="box featured my-diploamthese-box">
                                                <h3 class="my-diploamthese-box-student">{{$student->user->name}}</h3>
                                                <div class="my-diploamthese-box-all my-diploamthese-box-content">
                                                    <div class="my-diploamthese-box-content-title">
                                                        <p>
                                                            <strong>{{$student->diplomathese->title}}</strong>
                                                        </p>
                                                    </div>
                                                    <div class="my-competition-box-content-teacher">
                                                        <p>
                                                            @if(isset($student->diplomathese->teacher[0]) && isset($student->diplomathese->teacher[1]))
                                                                <h5>Témavezetők</h5>
                                                            @elseif(isset($student->diplomathese->teacher[0]) && !isset($student->diplomathese->teacher[1]))
                                                                <h5>Témavezető</h5>
                                                            @endif
                                                            @foreach($student->diplomathese->teacher as $teacher)
                                                                @if($loop->last)
                                                                    {{$teacher->user->name}}
                                                                @else
                                                                    {{$teacher->user->name}},
                                                                @endif
                                                            @endforeach
                                                        </p>
                                                    </div>
                                                    <div class="my-diploamthese-box-content-theme">
                                                        @if(count($student->diplomathese->topics) > 1)
                                                            <h5>Témák</h5>
                                                            <p>
                                                            @foreach($student->diplomathese->topics as $topic)
                                                                @if($loop->last)
                                                                    {{$topic->name}}
                                                                @else
                                                                    {{$topic->name}},
                                                                @endif
                                                            @endforeach
                                                            </p>
                                                        @elseif(count($student->diplomathese->topics) == 1)
                                                            <h5>Téma</h5>
                                                            <p>{{$student->diplomathese->topics[0]->name}}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                @hasanyrole('SzuperAdminisztrátor|Adminisztrátor|Tanár|Hallgató')
                                                <div class="btn-wrap my-diploamthese-box-bottom">
                                                    <a href="#" class="btn-buy" data-bs-toggle="modal" data-bs-target="#diplomaModal" onclick='OpenFDiploma("dipl_availability","{{asset($student->diplomathese->getFirstMediaUrl('dipl_availability'))}}#toolbar=0")'>Megtekintés</a>
                                                </div>
                                                @endhasanyrole
                                            </div>
                                        </div>`
                                    )
                                }
                            @endif
                        @endforeach
                @endforeach
                if(!wasShowed){
                    $( "#currrently-visible-diplomatheses" ).append('<h4 class="my-diploamthese-heading">Nincs megjeleníthető dolgozat!</h4>');
                }
                correctPercent()
                showCorrectly();

            }else{
                console.log('d');
                showAllDiplomathese()
            }
        }

        function showAllDiplomathese(){
            var wasShowedAll = false;
            @foreach($classes as $classe)
                    $( "#currrently-visible-diplomatheses" ).append('<h4 class="my-diploamthese-heading">' + {{$classe->year + 3}} +'</h4>');
                    @foreach($classe->students as $student)
                        @if($student->diplomathese)
                            wasShowedAll = true;
                            $( "#currrently-visible-diplomatheses" ).append(
                                //col-md-6 mt-4 mt-lg-0
                                `<div class="my-diploma-class col-md-3 mt-4 d-flex align-items-stretch">
                                    <div class="box featured my-diploamthese-box">
                                        <h3 class="my-diploamthese-box-student">{{$student->user->name}}</h3>
                                        <div class="my-diploamthese-box-all my-diploamthese-box-content">
                                            <div class="my-diploamthese-box-content-title">
                                                <p>
                                                    <strong>{{$student->diplomathese->title}}</strong>
                                                </p>
                                            </div>
                                            <div class="my-competition-box-content-teacher">
                                                <p>
                                                    @if(isset($student->diplomathese->teacher[0]) && isset($student->diplomathese->teacher[1]))
                                                        <h5>Témavezetők</h5>
                                                    @elseif(isset($student->diplomathese->teacher[0]) && !isset($student->diplomathese->teacher[1]))
                                                        <h5>Témavezető</h5>
                                                    @endif
                                                    @foreach($student->diplomathese->teacher as $teacher)
                                                        @if($loop->last)
                                                            {{$teacher->user->name}}
                                                        @else
                                                            {{$teacher->user->name}},
                                                        @endif
                                                    @endforeach
                                                </p>
                                            </div>
                                            <div class="my-diploamthese-box-content-theme">
                                                @if(count($student->diplomathese->topics) > 1)
                                                    <h5>Témák</h5>
                                                    <p>
                                                        @foreach($student->diplomathese->topics as $topic)
                                                            @if($loop->last)
                                                                {{$topic->name}}
                                                            @else
                                                                {{$topic->name}},
                                                            @endif
                                                        @endforeach
                                                    </p>
                                                @elseif(count($student->diplomathese->topics) == 1)
                                                    <h5>Téma</h5>
                                                    <p>{{$student->diplomathese->topics[0]->name}}</p>
                                                @endif
                                            </div>
                                        </div>
                                        @hasanyrole('SzuperAdminisztrátor|Adminisztrátor|Tanár|Hallgató')
                                        <div class="btn-wrap my-diploamthese-box-bottom">
                                            <a href="#" class="btn-buy" data-bs-toggle="modal" data-bs-target="#diplomaModal" onclick='OpenFDiploma("dipl_availability","{{asset($student->diplomathese->getFirstMediaUrl('dipl_availability'))}}#toolbar=0")'>Megtekintés</a>
                                        </div>
                                        @endhasanyrole
                                    </div>
                                </div>`
                            )
                        @endif
                    @endforeach
                @endforeach
                if(!wasShowedAll){
                    $( "#currrently-visible-diplomatheses" ).append('<h4 class="my-diploamthese-heading">Nincs megjeleníthető dolgozat!</h4>');
                }
            correctPercent();
            showCorrectly();
        }
        $( document ).ready(function() {
            if($(window).width() > 580){
                $("#showHideClassesArrow").hide(300);
                $("#showHideTopicsArrow").hide(300);
            }
            showAllDiplomathese();

        });
        var wasChanged = false;
        function correctPercent(){
            console.log($( ".my-diploamthese-box-bottom" ).length);
            if($( ".my-diploamthese-box-bottom" ).length === 0){
                $('.my-diploamthese-box-all').toggleClass("my-diploamthese-box-content");
                $('.my-diploamthese-box-all').toggleClass("my-diploamthese-box-content-guest");
            }
        }
        $(window).resize(function() {
            showCorrectly();
        });

        function showCorrectly(){
            var md4 = $(window).width() < 1286;
            var md6 = $(window).width() < 990;
            var forfloatlower = $(window).width() < 580;
            var forfloathigher = $(window).width() > 580;

            $(".my-diploma-class")
                .toggleClass("col-md-3", !md4)
                .toggleClass("col-md-4", md4)
                .toggleClass("col-md-6", md6);

            if(forfloatlower && !wasChanged){
                $("#my-left-list").toggleClass("my-left-list-class");
                $("#visibleClasses").hide(300);
                $("#visibleTopics").hide(300);
                $("#showHideClassesArrow").show(300);
                $("#showHideTopicsArrow").show(300);
                $("#showHideClasses").css("cursor","pointer");
                $("#showHideTopics").css("cursor","pointer");
                wasChanged = true;
            }else if(forfloathigher && wasChanged){
                $("#my-left-list").toggleClass("my-left-list-class");
                $("#visibleClasses").show(300);
                $("#visibleTopics").show(300);

                $("#showHideClassesArrow").hide(300);
                $("#showHideTopicsArrow").hide(300);
                $("#showHideClasses").css("cursor","unset");
                $("#showHideTopics").css("cursor","unset");
                wasChanged = false;
            }
        }
        $("#showHideClasses").click(function() {
            if($(window).width() < 580){
                $("#visibleClasses").toggle(300);
                $("#showHideClassesArrow").toggleClass("rotated");

            }
        });
        $("#showHideTopics").click(function() {
            if($(window).width() < 580) {
                $("#visibleTopics").toggle(300);
                $("#showHideTopicsArrow").toggleClass("rotated");
            }
        });

        $( "#remove-filter" ).click(function() {
            $('#chb-topic input[type=checkbox]:checked').prop('checked', false);
            $('#chb-class input[type=checkbox]:checked').prop('checked', false);
            getdata();
        });
    </script>
@endsection
