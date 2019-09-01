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
        <a href="#"><span class="btn btn-sm hover-e-1"><i class="fa fa-info"></i></span></a>
        <a href="#"><span class="btn btn-sm hover-e-1"><i class="fa fa-comment"></i></span></a>
        <a href="#"><span class="btn btn-sm hover-e-1"><i class="fa fa-user"></i></span></a>
        <a href="#"><span class="btn btn-sm hover-e-1"><i class="fa fa-close"></i></span></a>
        <a href="#"><span class="btn btn-sm hover-e-1"><i class="fa fa-arrow-left"></i></span></a>
    </ul>



</nav>
