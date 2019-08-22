
<!--
     This view will be used for Show history of orders
-->



@extends('layouts.app')

@section('content')
    <div id="orders">



        <!-- search bar -->
        @include('common.searchbar')




        <!-- Customers && Partners container -->
        <div class="tbl-main-con">



            <!-- Orders --->
            <div id="normal">
                <table class="tbl-1">
                    <tr>
                        <th style="width:40px">#</th>
                        <th>شناسه</th>
                        <th>نام و نام خانوادگی</th>
                        <th>جزئیات</th>
                        <th>لیست قطعات</th>
                        <th>قطعات موجود</th>
                        <th>قطعات آماده</th>
                        <th>کل قطعات</th>
                        <th>بدهکار</th>
                        <th>بستانکار</th>
                        <th>صورت حساب</th>
                    </tr>
                    @foreach ($orders as $order)
                        <tr>
                            <td>1</td>
                            <td>{{ $order->id }}</td>
                            <td><a href="/customers/{{ $order->id }}/edit">{{ $order->id }}</a></td>
                            <td><a href=""><i class="fa fa-2x text-secondary fa-address-book-o pl-2"></i></a></td>
                            <td><a href=""><i class="fa fa-2x text-dark fa-microchip pl-2"></i></a></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><a href=""><i class="fa fa-2x text-success fa-money pl-2"></i></a></td>
                        </tr>
                    @endforeach
                </table>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>



            <!-- New Order Btn --->
            <div class="row">
                <div class="col-12 d-flex justify-content-end">
                    <a href="" class="btn btn-sm btn-outline-secondary">سفارش جدید</a>
                </div>
            </div>



        </div>



    </div>
@endsection