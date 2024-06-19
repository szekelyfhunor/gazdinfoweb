@extends('frontend.layout.master')
@section('activeItKlub')
    class="active"
@endsection
@section('content')
<main id="main">
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
            <h2>ITKlub</h2>
            <p>A gazdasági informatikusok közössége</p>
        </div>
    </div>
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="row align-items-center">

                @if (!empty($itklubs) && count($itklubs) > 0)
                    <img src="{{ asset($itklubs[0]->getFirstMediaUrl('itklub_image')) }}" class="img-fluid" alt="">
                    <p>{!! $itklubs[0]->title !!}</p>
                    {!! $itklubs[0]->description !!}
                @else
                    <p>No data available</p>
                @endif

        </div>
    </section>
</main>
@endsection
