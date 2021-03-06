<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'سامانه مدیریت تعمیرگاه') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/public.js') }}"></script>

    <!-- Styles -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/rtl.css') }}" rel="stylesheet">
    <link href="{{ asset('css/public.css') }}" rel="stylesheet">
</head>
<body>


<!--  Spinner  --------------------------------------------------------------------------------------------------------------------------------------------------->

<?php
if (Config::get('app.developing_mode') == false)  echo '
    <div class="d-flex justify-content-center" style="margin-top: 300px;">
        <span class="ouro">
            <span class="left"><span class="anim"></span></span>
            <span class="right"><span class="anim"></span></span>
        </span>
    </div>
';
?>



<!--  ALL VIEW  --------------------------------------------------------------------------------------------------------------------------------------------------->
<div id="app">
    @yield('body')
</div>


</body>
</html>
