@extends('frontend.layout.master')

@section('content')
    <main id="main">
        <div class="breadcrumbs" data-aos="fade-in">
            <div class="container">
                <h2>{{$new->title}}</h2>
            </div>
        </div>

        <section id="pricing" class="pricing">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    {!! $new->content !!}
                </div>
            </div>
        </section>
    </main>
    <script>
        $(document).ready(function (){
            $('#preloader').remove();
        });
    </script>
@endsection
