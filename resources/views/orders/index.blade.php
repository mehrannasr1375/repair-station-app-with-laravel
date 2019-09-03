@extends('layouts.app')
@section('page','تاریخچه کلی')
@section('content')



        <!-- search bar -->
        @include('common.searchbar')



        <!-- Customers && Partners container -->
        <div class="tbl-main-con">



            <!-- Orders --->
            <div id="normal">
                <table class="tbl-1">
                    <tr>
                        <th style="width:40px">شناسه</th>
                        <th>نام و نام خانوادگی</th>
                        <th>جزئیات</th>
                        <th>نوع دستگاه</th>
                        <th>عیب</th>
                        <th>تاریخ دریافت</th>
                        <th style="width:80px">وضعیت تعمیر</th>
                        <th style="width:60px">وضعیت تحویل</th>
                    </tr>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->customer->name }}</td>
                            <td><a href="/orders/{{ $order->id }}/edit"><i class="fa fa-2x text-dark fa-microchip pl-2"></i></a></td>
                            <td>{{ $order->device_type }}</td>
                            <td>{{ $order->problem }}</td>
                            <td>{{ $order->receive_date }}</td>
                            <td>{{ $order->status_code }}</td>
                            <td>{{ $order->checkout }}</td>
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
                    <a href="/orders/create" class="btn btn-sm btn-outline-secondary">سفارش جدید</a>
                </div>
            </div>



        </div>



@endsection