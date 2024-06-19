@extends('frontend.layout.master')
@section('activeNews')
    class="active"
@endsection
@section('content')
    <main id="main">
        <div class="breadcrumbs" data-aos="fade-in">
            <div class="container">
                <h2>Hírek</h2>
                <p>Minden ami a szakkal kapcsolatosan történt!</p>
            </div>
        </div>
        <section id="events" class="events">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    @for ($i = 0; $i < count($news); $i++)
                    <div class="my-news-class col-md-4 d-flex align-items-stretch">
                        <div class="card my-news" onclick="window.location='{{route('frontend.news.show', $news[$i]->slug)}}';">
                            <div class="card-img">
                                <img src="{{asset($news[$i]->getFirstMediaUrl('new_image'))}}"  onError="this.onerror=null;this.src='{{asset("assets/img/defsapi.jpg")}}';" alt="..." width="550" height="280">
                            </div>
                            <div class="card-body my-card-body">
                                <h5 class="card-title"><a href="" class="news-spetial-a">{{$news[$i]->title}}</a></h5>
                                <p class="my-card-date fst-italic text-center">{{$news[$i]->date}}</p>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </section>

    </main>
    <style>
        @media(max-width:992px){
            .my-card-date{
                display: none;

            }
            .my-card-body{
                padding: 20px !important;
            }
        }
    </style>
    <script>
        $(document).ready(function (){
            showCorrectly();
        })
        $(window).resize(function() {
            showCorrectly();
        });
        var wasChanged = false;
        function showCorrectly(){
            if($(window).width() < 1200 && !wasChanged){
                $(".my-news-class").toggleClass("col-md-4");
                $(".my-news-class").toggleClass("col-md-6");
                wasChanged = true;
            }else if($(window).width() > 1200 && wasChanged){
                $(".my-news-class").toggleClass("col-md-4");
                $(".my-news-class").toggleClass("col-md-6");
                wasChanged = false;
            }
        }
    </script>
@endsection
