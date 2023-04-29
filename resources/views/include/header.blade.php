<!-- [ Pre-loader ] start -->
<div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
</div>
<!-- [ Pre-loader ] End -->
<!-- [ Header ] start -->
<header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark">		
    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse" href="javascript:;"><span></span></a>
        <a href="{{route('home')}}" class="b-brand">
            <!-- ========   change your logo hear   ============ -->
            <img src="{{ asset('assets/images/logo.png') }}" alt="" class="logo">
            <img src="{{ asset('assets/images/logo-icon.png') }}" alt="" class="logo-thumb">
        </a>
        <a href="#!" class="mob-toggler">
            <i class="feather icon-more-vertical"></i>
        </a>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a href="#!" class="pop-search"><i class="feather icon-search"></i></a>
                <div class="search-bar">
                    <input type="text" class="form-control border-0 shadow-none" placeholder="Search hear">
                    <button type="button" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </li>            
        </ul>
        <ul class="navbar-nav ml-auto">
            <li>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                        <i class="icon feather icon-bell"></i>
                        <span class="badge badge-pill badge-danger">
                            {{getHeaderNotification()!=false ? count(getHeaderNotification()) : 0}}
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right notification">
                        <div class="noti-head">
                            <h6 class="d-inline-block m-b-0">Notifications</h6>
                        </div>
                        <ul class="noti-body">
                            @if (getHeaderNotification()!=false)
                                @foreach (getHeaderNotification() as $item)
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="{{asset('images/students/'.$item->image)}}" alt="Generic placeholder image" height="40">
                                        <div class="media-body">
                                            <p><strong class="text-capitalize">{{$item->name}}</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>{{$item->installment_date}}</span></p>
                                            <p class="text-danger">Pending installment of Rs. <strong class="text-danger">{{$item->payment}} /.</strong></p>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            @else
                                <li class="n-title">
                                    <p class="m-b-0">Not any notifications!</p>
                                </li>
                            @endif
                            
                        </ul>
                        <div class="noti-footer">
                            <a href="{{route('notification')}}">show all</a>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <div class="dropdown drp-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="feather icon-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-notification">
                        <div class="pro-head">
                            <img src="{{asset('assets/images/user/avatar-2.jpg')}}" class="img-radius" alt="User-Profile-Image">
                            <span>John Doe</span>
                            <a href="javascript:;" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dud-logout" title="Logout">
                                <i class="feather icon-log-out"></i>
                            </a>
                        </div>
                        <ul class="pro-body">
                            <li><a href="{{ route('user_profile') }}" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li>
                            {{-- <li><a href="email_inbox.html" class="dropdown-item"><i class="feather icon-mail"></i> My Messages</a></li> --}}
                            <li><a href="javascript:;
                                " onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item"><i class="feather icon-lock"></i> Lock Screen</a></li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</header>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
<!-- [ Header ] end -->