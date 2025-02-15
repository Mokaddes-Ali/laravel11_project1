 <!-- Begin page -->
 <div id="wrapper">

<!-- Topbar Start -->
<div class="navbar-custom bg-dark">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-end mb-0">

            <li class="d-none d-lg-block">
                <form class="app-search">
                    <div class="app-search-box dropdown">

                        <div class="input-group">
                            <input type="search" class="form-control" placeholder="Search..." id="top-search">
                            <button class="btn input-group-text" type="submit">
                                <i class="uil uil-search"></i>
                            </button>
                        </div>

                        <div class="dropdown-menu dropdown-lg" id="search-dropdown">
                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h5 class="text-overflow mb-2">Found 05 results</h5>
                            </div>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="uil uil-sliders-v-alt me-1"></i>
                                <span>User profile settings</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="uil uil-home-alt me-1"></i>
                                <span>Analytics Report</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="uil uil-life-ring me-1"></i>
                                <span>How can I help you?</span>
                            </a>

                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow mb-2 text-uppercase">Users</h6>
                            </div>

                            <div class="notification-list">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="d-flex text-align-start">
                                        <img class="me-2 rounded-circle" src="assets/images/users/avatar-2.jpg" alt="Generic placeholder image" height="32">
                                        <div class="flex-grow-1">
                                            <h5 class="m-0 fs-14">Shirley Miller</h5>
                                            <span class="fs-12 mb-0">UI Designer</span>
                                        </div>
                                    </div>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="d-flex text-align-start">
                                        <img class="me-2 rounded-circle" src="assets/images/users/avatar-5.jpg" alt="Generic placeholder image" height="32">
                                        <div class="flex-grow-1">
                                            <h5 class="m-0 fs-14">Timothy Moreno</h5>
                                            <span class="fs-12 mb-0">Frontend Developer</span>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>
                </form>
            </li>

            <li class="dropdown d-inline-block d-lg-none">
                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i data-feather="search"></i>
                </a>
                <div class="dropdown-menu dropdown-lg dropdown-menu-end p-0">
                    <form class="p-3">
                        <input type="text" class="form-control" placeholder="Search ..." aria-label="search here">
                    </form>
                </div>
            </li>

            <li class="dropdown d-none d-lg-inline-block">
                <a class="nav-link dropdown-toggle arrow-none" data-toggle="fullscreen" href="#">
                    <i data-feather="maximize"></i>
                </a>
            </li>
            <li class="dropdown d-none d-lg-inline-block topbar-dropdown">
                <a class="nav-link dropdown-toggle arrow-none d-flex align-items-center gap-1" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    @php($languages = ['en' => 'English', 'bn' => 'বাংলা'])
                    <span class="fw-bold">{{ $languages[Session::get('locale', 'en')] }}</span>
                    <i data-feather="globe"></i>
                </a>

                <div class="dropdown-menu dropdown-menu-end">
                    <!-- Language Links -->
                    <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('lang.switch', 'en') }}">
                        <i data-feather="flag"></i> English
                    </a>
                    <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('lang.switch', 'bn') }}">
                        <i data-feather="flag"></i> বাংলা
                    </a>
                </div>
            </li>


            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle position-relative" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i data-feather="bell"></i>
                    <span class="badge bg-danger rounded-circle noti-icon-badge">
                        @if(auth()->check()) <!-- Check if the user is authenticated -->
                            {{ auth()->user()->unreadNotifications->count() }}
                        @else
                            0
                        @endif
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-lg">
                    <div class="dropdown-item noti-title">
                        <h5 class="m-0">
                            <span class="float-end">
                                <a href="{{ route('notifications.markAllAsRead') }}" class="text-dark">
                                    <small>Clear All</small>
                                </a>
                            </span>Notification
                        </h5>
                    </div>
                    <div class="noti-scroll" data-simplebar>
                        @if(auth()->check()) <!-- Check if the user is authenticated -->
                            @foreach(auth()->user()->unreadNotifications as $notification)
                                <a href="javascript:void(0);" class="dropdown-item notify-item border-bottom">
                                    <div class="notify-icon bg-primary"><i class="uil uil-info-circle"></i></div>
                                    <p class="notify-details">{{ $notification->data['message'] }}
                                        <small class="text-muted">{{ $notification->data['time'] }}</small>
                                    </p>
                                </a>
                            @endforeach
                        @else
                            <p>No notifications available.</p>
                        @endif
                    </div>
                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                        View all <i class="fe-arrow-right"></i>
                    </a>
                </div>
            </li>



            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                     <!-- Profile Image Preview -->
                     <img src="{{ asset('storage/' . ($user->profile_image ?? 'default.png')) }}"
                     class="rounded-circle"
                     width="300" height="300"
                     alt="Profile Image">

                    <span class="pro-user-name ms-1 text-white">
                        {{ Auth::check() ? Auth::user()->name : 'Guest' }} <i class="uil uil-angle-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end profile-dropdown ">

                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>

                    <a href="{{ route('profile.edit') }}" class="dropdown-item notify-item">
                        <i data-feather="user" class="icon-dual icon-xs me-1"></i><span>My Account</span>
                    </a>
                    <div class="dropdown-divider"></div>

                     <a href="{{ route('logout') }}" class="dropdown-item notify-item" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                        <i data-feather="log-out" class="icon-dual icon-xs me-1"></i><span>Logout</span>
                    </a>
                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                </div>
            </li>

            <li class="dropdown notification-list">
                <a href="javascript:void(0);" class="nav-link right-bar-toggle">
                    <i data-feather="settings"></i>
                </a>
            </li>

        </ul>

        <!-- LOGO -->
        <div class="logo-box">
            <a href="index.html" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="{{asset('admin')}}/assets/images/logo-sm.png" alt="" height="24">
                    <!-- <span class="logo-lg-text-light">Shreyu</span> -->
                </span>
                <span class="logo-lg">
                    <img src="{{asset('admin')}}/assets/images/logo-dark.png" alt="" height="24">
                    <!-- <span class="logo-lg-text-light">S</span> -->
                </span>
            </a>

            <a href="index.html" class="logo logo-light">
                <span class="logo-sm">
                    <img src="{{asset('admin')}}/assets/images/logo-sm.png" alt="" height="24">
                </span>
                <span class="logo-lg">
                    <img src="{{asset('admin')}}/assets/images/logo-light.png" alt="" height="24">
                </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile">
                    <i data-feather="menu"></i>
                </button>
            </li>

            <li>
                <!-- Mobile menu toggle (Horizontal Layout)-->
                <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>

        </ul>
        <div class="clearfix"></div>
    </div>
</div>
<!-- end Topbar -->
