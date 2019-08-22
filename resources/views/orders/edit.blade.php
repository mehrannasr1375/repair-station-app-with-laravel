
<!--
     - This view used for Show details of a order, with an update btn for that order 
            for show && edit
     - This view used for 'show' && 'edit' methods on OrdersController
-->



@extends('layouts.app')

@section('content')



    <!-- search bar -->
    @include('common.searchbar')



    <div id="create-order">
        


        <!-- Form for show && edit order -->
        <form action="/orders/{{ $order->id }}" method="POST">

            @method('PATCH')

            <div class="con">
                
                <div>
                    <p class="mb-0 p-1"><i class="fa fa-user"></i> مشخصات تعمیری : </p>
                </div>     
                

                    

                <!-- btn submit -->
                <button class="btn btn-outline-secondary btn-sm my-2" type="submit" >  ویرایش  <i class="fa fa-check"></i></button>

            </div>

            @csrf
        </form>
    </div>
@endsection