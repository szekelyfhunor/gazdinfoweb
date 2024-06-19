<!-- ======= Header ======= -->

<header id="header" class="fixed-top my-header">
    <div class="container d-flex align-items-center">

        <h1  class="logo me-auto my-logo-h1"><a href="{{route('frontend.homepage.index')}}"><img src="{{asset('/assets/img/sapilogo/sapilogo.png')}}" alt="" class="my-logo-img"><span class="logo-text">Sapientia<br><span id="my-span-gi">Gazdasági informatika</span></span></a></h1>

        <nav id="navbar"class="navbar order-last order-lg-0">
            <ul class="my-ul">
                <li class="my-hover-underline-animation"><a @yield('activehome') href="{{route('frontend.homepage.index')}}">Főoldal</a></li>
                <li class="my-hover-underline-animation"><a @yield('activeNews') href="{{route('frontend.news.index')}}">Hírek</a></li>
                <li class="my-hover-underline-animation"><a @yield('activeItKlub') href="{{route('frontend.itklub.index')}}">ITKlub</a></li>

                <li class="dropdown my-hover-underline-animation my-dropdown "><a @yield('activeTheses') href="javascript:void(0)" ><span>Dolgozatok</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li class=""><a @yield('activeCompetitions') href="{{route('frontend.competitions.index')}}">Versenyek</a></li>
                        <li class=""><a @yield('activeDiplomatheses') href="{{route('frontend.diplomatheses.index')}}">Diplomadolgozatok</a></li>
                        <li class=""><a @yield('activeDiplomatheses') href="{{route('frontend.applicants.index')}}">Diplomadolgozat témák</a></li>
                    </ul>
                </li>
                <li class="dropdown my-hover-underline-animation my-dropdown "><a @yield('activeClass') href="javascript:void(0)" ><span>Továbbiak</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a @yield('activeClasses') href="{{route('frontend.classes.index')}}">Aktív évfolyamok</a></li>
                        <li><a @yield('activeStudents') href="{{route('frontend.students.index')}}">Hallgatók</a></li>
                    </ul>
                </li>


                @hasanyrole('SzuperAdminisztrátor|Adminisztrátor|Tanár|Hallgató')
                <li class="dropdown my-logged-in"><a @yield('activeszak') href="#"><span>{{ Auth::user()->name }}</span> {{--<i class="bi bi-chevron-down"></i>--}}</a>
                    <ul>
                        @hasanyrole('SzuperAdminisztrátor|Adminisztrátor|Tanár')
                            <li><a href="{{ url('admin') }}">Admin</a></li>
                        @endhasanyrole
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                 Kilépés
                            </a>
                        </li>
                        <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </li>
                @endhasanyrole
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>

        </nav><!-- .navbar -->
        @guest
            <a href="{{ route('google-auth') }}" class="get-started-btn btn btn-lg btn-success btn-block my-login-btn">Bejelentkezés</a>
            <a href="{{ route('google-auth') }}" class="get-started-btn btn btn-lg btn-success btn-block my-mobile-login-btn"><i class="fab fa-google"></i></a>
        @endguest
        <style>
            @media(max-width:420px){
                .my-login-btn{
                    display: none;
                }
                .my-mobile-login-btn{
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
            }

        </style>

    </div>

</header><!-- End Header -->
