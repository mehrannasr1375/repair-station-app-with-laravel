@extends('layouts.app')

@section('content')
    <div id="create-customer">



        <!-- search bar -->
        @include('common.searchbar')



        <!-- Form for create new customer -->
        <form action="/customers" method="POST">

        </form>



    </div>
@endsection