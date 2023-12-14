<div class="header">

    <div class="header-left">
        <a href="{{ route('dashboard') }}" class="logo">
            <img src="{{ URL::to('assets/img/logo_lengkap_sip_aset.png') }}" alt="Logo">
        </a>
        <a href="{{ route('dashboard') }}" class="logo logo-small">
            <img src="{{ URL::to('assets/img/logo_sip_aset.png') }}" alt="Logo" width="50" height=50">
        </a>
    </div>
    <div class="menu-toggle">
        <a href="javascript:void(0);" id="toggle_btn">
            <i class="fas fa-bars"></i>
        </a>
    </div>

    <a class="mobile_btn" id="mobile_btn">
        <i class="fas fa-bars"></i>
    </a>

    <ul class="nav user-menu">
        {{-- <li class="nav-item dropdown noti-dropdown language-drop me-2">
            <a href="#" class="dropdown-toggle nav-link header-nav-list" data-bs-toggle="dropdown">
                <img src="{{ URL::to('assets/img/icons/header-icon-01.svg') }}" alt="">
            </a>
            <div class="dropdown-menu">
                <div class="noti-content">
                    <div>
                        <a class="dropdown-item" href="javascript:;"><i class="flag flag-lr me-2"></i>English</a>
                        <a class="dropdown-item" href="javascript:;"><i class="flag flag-bl me-2"></i>Francais</a>
                        <a class="dropdown-item" href="javascript:;"><i class="flag flag-cn me-2"></i>Turkce</a>
                    </div>
                </div>
            </div>
        </li> --}}

        {{-- <li class="nav-item dropdown noti-dropdown me-2">
            <a href="#" class="dropdown-toggle nav-link header-nav-list" data-bs-toggle="dropdown">
                <img src="{{ URL::to('assets/img/icons/header-icon-05.svg') }}" alt="">
            </a>
            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header">
                    <span class="notification-title">Notifications</span>
                    <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                </div>
                <div class="noti-content">
                    <ul class="notification-list">
                        <li class="notification-message">
                            <a href="#">
                                <div class="media d-flex">
                                    <span class="flex-shrink-0 avatar avatar-sm">
                                        <img class="avatar-img rounded-circle" alt="User Image"
                                            src="{{ URL::to('assets/img/profiles/avatar-02.jpg') }}">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                        <p class="noti-details"><span class="noti-title">Carlson Tech</span> has
                                            approved <span class="noti-title">your estimate</span></p>
                                        <p class="noti-time"><span class="notification-time">4 mins ago</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                            <a href="#">
                                <div class="media d-flex">
                                    <span class="flex-shrink-0 avatar avatar-sm">
                                        <img class="avatar-img rounded-circle" alt="User Image"
                                            src="{{ URL::to('assets/img/profiles/avatar-11.jpg') }}">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                        <p class="noti-details"><span class="noti-title">International Software
                                                Inc</span> has sent you a invoice in the amount of <span
                                                class="noti-title">$218</span></p>
                                        <p class="noti-time"><span class="notification-time">6 mins ago</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="#">View all Notifications</a>
                </div>
            </div>
        </li> --}}

        <li class="nav-item zoom-screen me-2">
            <a href="#" class="nav-link header-nav-list win-maximize">
                <img src="{{ URL::to('assets/img/icons/header-icon-04.svg') }}">
            </a>
        </li>

        <li class="nav-item dropdown has-arrow new-user-menus">
            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <span class="user-img">
                    @if (Auth::user()->foto)
                        <img class="rounded-circle" src="{{ asset('storage/' . Auth::user()->foto) }}" width="31">
                    @else
                        <img class="rounded-circle" src="{{ asset('assets/img/male_avatar.jpg') }}" width="31">
                    @endif
                    <div class="user-text">
                        <h6>{{ Auth::user()->name }}</h6>
                        @if (Auth::user()->hasRole(['Sekretaris Kwarcab', 'Sekretaris Bidang']))
                            <p class="text-muted mb-0">{{ Auth::user()->bidang->nama }}</p>
                        @endif
                    </div>
                </span>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('profile.edit') }}">Profil Saya</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a class="dropdown-item" href="route('logout')"
                        onclick="event.preventDefault();
                    this.closest('form').submit();">Keluar
                    </a>
                </form>


            </div>
        </li>

    </ul>

</div>
