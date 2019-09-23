<nav class="navbar container-fluid" id="main-navbar">



    <!-- Right -->
    <a href="{{ url('/') }}">
        <i id="navbar-logo" class="fa fa-gg-circle"></i>
        <p id="navbar-title">
            سامانه مدیریت تعمیرگاه
            <span id="lt"></span>
            @yield('page')
        </p>
    </a>



    <!-- Left -->
    <ul class="nav">
        <a href="#" style="padding-top:3px; margin-left:40px">
            @auth
                <span class="text-light text-vsm">
                    {{ Auth::user()->name }} {{ Auth::user()->email }} 
                </span>
                <i class="fa fa-1x fa-user-circle text-light"></i>  
            @endauth
        </a>
        <a href="#"><span class="btn btn-sm hover-e-1"><i class="fa fa-info"></i></span></a>
        <a href="#"><span class="btn btn-sm hover-e-1"><i class="fa fa-comment"></i></span></a>
        <a href="{{ url('/logout') }}"><span class="btn btn-sm hover-e-1"><i class="fa fa-close"></i></span></a>
        <a href="#" onclick="window.location.reload();"><span class="btn btn-sm hover-e-1"><i class="fa fa-refresh"></i></span></a>
        <a href="#" onclick="window.history.go(-1); return false;"><span class="btn btn-sm hover-e-1"><i class="fa fa-arrow-left"></i></span></a>
    </ul>



</nav>
