<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row d-flex justify-content-between">

                <div class="col-lg-3 col-md-6 footer-contact d-flex">
                    <div class="col-lg-2 col-md-6 footer-links " style="margin-right: 20px">
                        <h1 class="logo me-auto my-logo-h1"><a href="{{route('frontend.homepage.index')}}"><img src="{{asset('/assets/img/sapilogo/sapilogo.png')}}" alt="" class="my-logo-img"></a></h1>
                    </div>
                    <div class="footer-uni-info">
                    <h3> Sapientia - EMTE</h3>
                    <p>
                        Csíkszereda, Hargita megye, Szabadság tér, 1. szám, 530104<br>
                        Románia<br><br>
                        <strong>Telefon:</strong> +40-266-314-657<br>
                        <strong>Email:</strong> csikszereda@uni.sapientia.ro <br>
                    </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 footer-newsletter footer-more">
                    <div class="p-abs">
                    <h4>Tudj meg többet</h4>
                    <p>Tanulj gazdasági informatikát a Csíkszeredai Sapientián</p>
                    <a href="https://csik.sapientia.ro/hu/felveteli/alapkepzes/gazdasagi-informatika-szak" class="get-started-btn btn btn-lg btn-success btn-block p-rel" >Részletek</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container d-md-flex py-4">

        <div class="me-md-auto text-center text-md-start">
            <div class="copyright">
                &copy; Copyright <strong><span>Sapientia</span></strong>. Minden jog fentartva
            </div>
            <div class="credits">
               A szakot elvégző hallgató által készítve
            </div>
        </div>
    </div>
    <div class="facebook-fixed"><a href="https://www.facebook.com/gazdasagiinformatika"><i class="bx bxl-facebook"></i></a></div>
    <style>
        @media(max-width:1200px){
            .footer-uni-info{
                margin-left: 20px ;
            }

        }
        @media(max-width:992px){
            .col-md-6{
                flex: 0 auto !important;
            }
            .footer-links{
                width: fit-content !important;
            }
            .footer-uni-info{
                margin-left: 0 ;
            }

        }
        @media(max-width:768px){
            .footer-more{
                margin-bottom: 50px !important;
                margin-top: 25px !important;
            }
        }
    </style>
</footer><!-- End Footer -->
@include('cookieConsent::index')
