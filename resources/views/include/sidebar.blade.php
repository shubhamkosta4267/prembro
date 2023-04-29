<!-- [ navigation menu ] start -->
<nav class="pcoded-navbar  ">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div " >
            
            <div class="">
                <div class="main-menu-header">
                    <img class="img-radius" src="{{asset('images/students/avtar.png')}}" alt="User-Profile-Image">
                    <div class="user-details">
                        <span>John Doe</span>
                        <div id="more-details">UX Designer<i class="fa fa-chevron-down m-l-5"></i></div>
                    </div>
                </div>
                <div class="collapse" id="nav-user-link">
                    <ul class="list-unstyled">
                        <li class="list-group-item"><a href="{{ route('user_profile') }}"><i class="feather icon-user m-r-5"></i>View Profile</a></li>
                        <li class="list-group-item"><a href="javascript:;" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="feather icon-log-out m-r-5"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
            
            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item pcoded-menu-caption">
                    <label>Navigation</label>
                </li>
                <li class="nav-item">
                    <a href="{{route('home')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Pages</label>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">Students</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{route('students_list')}}">students list</a></li>
                        <li><a href="{{route('add_students')}}">add students</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-book"></i></span><span class="pcoded-mtext">Courses</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{route('courses_list')}}">courses list</a></li>
                        <li><a href="{{route('add_course')}}">add courses</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a href="{{ route('notification') }}" class="nav-link "><span class="pcoded-micon"><i class="icon feather icon-bell"></i></span><span class="pcoded-mtext">Notification</span></a></li>

            </ul>            
        </div>
    </div>
</nav>
<!-- [ navigation menu ] end -->