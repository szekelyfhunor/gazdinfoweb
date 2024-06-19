@extends('frontend.layout.master')
@section('activehome')
    class="active"
@endsection
@section('content')

<section id="hero" class="d-flex justify-content-center align-items-center">
    <div class="container position-relative" data-aos="zoom-in" data-aos-delay="100">
        <h1>Sapientia EMTE,<br>Gazdasági informatika</h1>
        <h2>Minőségi képzés magyar nyelven, jelentkezz most!</h2>
        <a href="https://csik.sapientia.ro/hu/felveteli/alapkepzes/gazdasagi-informatika-szak" class="btn-get-started">Részletek</a>
    </div>
</section>

<main id="main">
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            @if (!empty($programs))
                <div class="row align-items-center">
                    <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                        <img src="assets/img/sapiepulet/sapi_kozel.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
                        <div class="section-title">
                            @if (isset($programs[0]))
                                <h2>{!! $programs[0]->institution !!}</h2>
                                <p>{!! $programs[0]->name_hu !!}</p>
                            @endif
                        </div>
                        @if (isset($programs[0]))
                            {!! $programs[0]->description !!}
                        @endif
                    </div>
                </div>
            @endif


        </div>
    </section>
    <section id="features" class="features">
        <div class="container" data-aos="fade-up">
            <div class="section-title my-subject-title">
                <h2>Tanulás</h2>
                <p>Mit tanulhatsz?</p>
            </div>
            <div class="row my-subjects" data-aos="zoom-in" data-aos-delay="100">
                @foreach($subjects as $subject)
                    <div class="col-lg-3 col-md-4 mt-4">
                        <div class="icon-box">
                            <img src="{{asset($subject->getFirstMediaUrl('subject_image'))}}"  onerror="this.style.display = 'none'" width="48" height="48"  />
                            <h3><a href="">{{$subject->name}}</a></h3>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="testimonials" class="testimonials">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Vélemények</h2>
                <p>Hallgatóink véleménye</p>
            </div>

            <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper">
                    @foreach($reviews as $review)
                        <div class="swiper-slide">
                            <div class="testimonial-wrap">
                                <div class="testimonial-item">
                                    <img src="{{asset($review->getFirstMediaUrl('review_image'))}}" class="testimonial-img" alt=""  >
                                    <h3>{{$review->reviewer}}</h3>
                                    <h4>{{$review->date}}</h4>
                                    <p>
                                        <i class="bx bxs-quote-alt-left quote-icon-left" style="font-size:20px"></i>
                                        {{$review->opinion}}
                                        <i class="bx bxs-quote-alt-right quote-icon-right" style="font-size:20px"></i>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
    <section id="features" class="features">
        <div class="container" data-aos="fade-up">
            <div class="section-title my-subject-title">
                <h2>Partnerek</h2>
                <p>Partnereink</p>
            </div>
            <div class="slider">
                @foreach($partners as $partner)
                    <div class="row" data-aos="zoom-in" data-aos-delay="100">
                        <div class="slide">
                            <div class="col-lg-3 col-md-4 my-partner px-2">
                                <div class="icon-box">
                                    <img src="{{asset($partner->getFirstMediaUrl('partner_image'))}}" width="48" height="48" class="my-partner-image" />
                                    <h3><a href="">{{$partner->name}}</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
        <div class="modal" id="frontendHomeError">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Üzenet</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body  my-delete-modal-body">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Bezár</button>
                    </div>

                </div>
            </div>
        </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function (){
            @if ($errors->any())
                $('#frontendHomeError').modal('show');
            @endif
        });
        window.onload=function(){
            $('.slider').slick({
                autoplay:true,
                autoplaySpeed:2000,
                dots: false,
                prevArrow: false,
                nextArrow: false,
                slidesToShow:4,
                slidesToScroll:1,
                responsive: [
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3,
                        },
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                        },
                    },
                    {
                        breakpoint: 420,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        },
                    },
                ],
            });
        };
    </script>
</main>
@endsection
