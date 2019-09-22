@extends('layouts.app')
@section('body')



    <!-- Navbar -->
    @include('common.navbar')


    <!-- Body -->
    <div class="container-fluid p-0" id="body">



        <!-- Sidebar -->
        @include('common.sidebar')



        <!-- Customizable Content -->
        <div id="content" class="px-3">
            @yield('content')
        </div>



    </div>



@endsection
