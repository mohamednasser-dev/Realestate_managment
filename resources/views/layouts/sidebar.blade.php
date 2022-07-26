<!-- Top Bar Start -->
<div class="topbar">

    <nav class="navbar-custom">
        <!-- Search input -->
        <div class="search-wrap" id="search-wrap">
            <div class="search-bar">
                <input class="search-input" type="search" placeholder="Search" />
                <a href="#" class="close-search toggle-search" data-target="#search-wrap">
                    <i class="mdi mdi-close-circle"></i>
                </a>
            </div> 
        </div> 
    
        <ul class="list-inline @if(session('lang') == 'en') float-right @else float-left @endif mb-0">
    
            <!-- Fullscreen -->
            <li class="list-inline-item dropdown notification-list hidden-xs-down">
                <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                    <i class="mdi mdi-fullscreen noti-icon"></i>
                </a>
            </li>
    
            <!-- User-->
           <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                aria-haspopup="false" aria-expanded="false">
                    @if (Auth::user()->photo == NULL || empty(Auth::user()->photo))
                    <img src="{{ URL::asset('assets/images/users/avatar-1.jpg') }}" alt="user" class="rounded-circle">
                    @else
                    <img src="{{ URL::asset('public/uploads') }}/{{Auth::user()->photo}}" alt="user" class="rounded-circle">
                    @endif
                    <span>{{Auth::user()->name}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <a class="dropdown-item" href="{{url('admin/show_admin')}}/{{Auth::user()->id}}"> حسابي <i class="dripicons-user text-muted"></i></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        تسجيل الخروج
                        <i class="dripicons-exit text-muted"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>

            <li class="list-inline-item dropdown notification-list hidden-xs-down">
                <a class="nav-link dropdown-toggle arrow-none waves-effect text-muted" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    @if(session('lang')=='en')
                        English <img src="{{ URL::asset('assets/images/flags/us_flag.jpg') }}"
                                     class="ml-2" height="16" alt=""/>
                    @else
                        العربيه <img src="{{ URL::asset('assets/images/flags/ksa.jpg') }}"
                                     class="ml-2" height="16" alt=""/>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right language-switch" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-52px, 70px, 0px);">
                    <a class="dropdown-item" href="{{url('lang/en')}}"><img
                        src="{{ URL::asset('assets/images/flags/us_flag.jpg') }}" class="ml-2"
                        height="16" alt=""/><span> English </span></a>
                    <a class="dropdown-item" href="{{url('lang/ar')}}"><img
                            src="{{ URL::asset('assets/images/flags/ksa.jpg') }}" alt=""
                            height="16"/><span> العربية </span></a>
                </div>
            </li>
    
            
        </ul>
        <!-- Page title -->
        <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
                <button type="button" class="button-menu-mobile open-left waves-effect">
                    <i class="ion-navicon"></i>
                </button>
            </li>
            <li class="hide-phone list-inline-item app-search">
                @yield('breadcrumb') 
            </li>
        </ul>
        <div class="clearfix"></div>
    </nav>
    </div>
    <!-- Top Bar End -->