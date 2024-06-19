<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 my-sidebar">
    <!-- Brand Logo -->
    <a href="{{route('admin') }}" class="brand-link">
        <img src="{{asset('img/sapilogo.png')}}" alt="Sapi Logo" class="brand-image elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Sapientia GI - Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item menu-closed">
                    <a href="{{ route('dashboard.programs.index') }}"
                       class="nav-link {{ (request()->is('dashboard/program*')) ? 'active' : '' }}">
                        <i class="fas fa-university"></i>
                        <p>
                            Szak információk
                        </p>
                    </a>
                </li>

                <li class="nav-item menu-closed">
                    <a href="{{ route('dashboard.classes.index') }}"
                       class="nav-link {{ (request()->is('dashboard/classes*')) ? 'active' : '' }}">
                        <i class="fas fa-chalkboard"></i>
                        <p>
                            Évfolyamok
                        </p>
                    </a>
                </li>

                <li class="nav-item menu-closed">
                    <a href="{{ route('dashboard.itklub.index') }}"
                       class="nav-link {{ (request()->is('dashboard/itklub*')) ? 'active' : '' }}">
                        <i class="fas fa-laptop-house"></i>
                        <p>
                            ItKlub
                        </p>
                    </a>
                </li>

                <li class="nav-item menu-closed">
                    <a href="{{ route('dashboard.news.index') }}"
                       class="nav-link {{ (request()->is('dashboard/news*')) ? 'active' : '' }}">
                        <i class="fas fa-newspaper"></i>

                        <p>
                            Hírek
                        </p>
                    </a>
                </li>

                <li class="nav-item menu-closed">
                    <a href="{{ route('dashboard.reviews.index') }}"
                       class="nav-link {{ (request()->is('dashboard/reviews*')) ? 'active' : '' }}">
                        <i class="fas fa-star"></i>
                        <p>
                            Vélemények
                        </p>
                    </a>
                </li>

                <li class="nav-item menu-closed">
                    <a href="{{ route('dashboard.partners.index') }}"
                       class="nav-link {{ (request()->is('dashboard/partners*')) ? 'active' : '' }}">
                        <i class="fas fa-handshake"></i>
                        <p>
                            Partnerek
                        </p>
                    </a>
                </li>

                <li class="nav-item menu-closed">
                    <a href="{{ route('dashboard.subjects.index') }}"
                       class="nav-link {{ (request()->is('dashboard/subjects*')) ? 'active' : '' }}">
                        <i class="fas fa-school"></i>
                        <p>
                            Tantárgyak
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview {{ (request()->is('dashboard/typeOfParticipations*')) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->is('dashboard/typeOfParticipations*')) ? 'active' : '' }}">
                        <i class="fas fa-plus"></i>
                        <p>
                            Versenyek
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item my-padding-left">
                            <a href="{{ route('dashboard.competitions.index') }}"
                               class="nav-link {{ (request()->is('dashboard/competitions*')) ? 'active' : '' }}">
                                <i class="fas fa-plus-circle"></i>
                                <p>Összes Verseny</p>
                            </a>
                        </li>
                        <li class="nav-item my-padding-left">
                            <a href="{{ route('dashboard.typeofparticipations.index') }}"
                               class="nav-link {{ (request()->is('dashboard/typeOfParticipations*')) ? 'active' : '' }}">
                                <i class="fa fa-pencil-alt"></i>
                                <p>Részvétel típusa</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{ (request()->is('dashboard/diplomatheses*')) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->is('dashboard/diplomatheses*')) ? 'active' : '' }}">
                        <i class="fas fa-scroll"></i>

                        <p>
                            Diplomadolgozatok
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item my-padding-left">
                            <a href="{{ route('dashboard.diplomatheses.index') }}"
                               class="nav-link {{ (request()->is('dashboard/diplomatheses*')) ? 'active' : '' }}">
                                <i class="fa fa-clone"></i>
                                <p>Összes dolgozat</p>
                            </a>
                        </li>
                        <li class="nav-item my-padding-left">
                            <a href="{{ route('dashboard.topics.index') }}"
                               class="nav-link {{ (request()->is('dashboard/typeOfParticipations*')) ? 'active' : '' }}">
                                <i class="fas fa-lightbulb"></i>
                                <p>Témakörök</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item menu-closed">
                    <a href="{{ route('dashboard.users.index') }}"
                       class="nav-link">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            Felhasználók
                        </p>
                    </a>
                </li>

                <li class="nav-item menu-closed">
                    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Kilépés
                        </p>
                    </a>
                    <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
