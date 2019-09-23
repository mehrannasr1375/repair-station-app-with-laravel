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
        <a href="#" data-toggle="tooltip" data-placement="bottom" title="کاربر جاری"  style="padding-top:3px; margin-left:40px">
            @auth
                <span class="text-light text-vsm">
                    {{ Auth::user()->name }}
                </span>
                <i class="fa fa-1x fa-user-circle text-light"></i>  
            @endauth
        </a>
        <a href="#" data-placement="bottom" data-toggle="tooltip" title="اطلاعات کاربر جاری" ><span class="btn btn-sm hover-e-1"><i class="fa fa-info"></i></span></a>
        <a href="#" data-placement="bottom" data-toggle="tooltip" title="پیام ها" ><span class="btn btn-sm hover-e-1"><i class="fa fa-comment"></i></span></a>
        <a href="{{ url('/logout') }}"  data-placement="bottom" data-toggle="tooltip" title="خروج"><span class="btn btn-sm hover-e-1"><i class="fa fa-close"></i></span></a>
        <a href="#" data-placement="bottom" data-toggle="tooltip" title="بارگزاری مجدد صفحه" onclick="window.location.reload();"><span class="btn btn-sm hover-e-1"><i class="fa fa-refresh"></i></span></a>
        <a href="#" data-placement="bottom" data-toggle="tooltip" title="صفحه قبلی" onclick="window.history.go(-1); return false;"><span class="btn btn-sm hover-e-1"><i class="fa fa-arrow-left"></i></span></a>
    </ul>



</nav>



<!-- Enable Bootstrap Tooltip -->
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>