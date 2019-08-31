
<!--
     This view will be used for Show in repairing orders
-->



@extends('layouts.app')

@section('page','قطعات در حال تعمیر')

@section('content')
    <div id="orders">



        <!-- search bar -->
        @include('common.searchbar')



        <!-- Repairing Orders -->
        <div class="tbl-main-con">
            <table class="tbl-1">
                <tr>
                    <th style="width:40px">شناسه</th>
                    <th>نام و نام خانوادگی</th>
                    <th>نوع دستگاه</th>
                    <th>عیب</th>
                    <th style="width:60px">جزئیات</th>
                    <th style="width:60px">یادداشت</th>
                    <th style="width:60px">تغییر وضعیت</th>
                    <th>تاریخ دریافت</th>
                </tr>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->customer->name }}</td>
                        <td>{{ $order->device_type }}</td>
                        <td>{{ $order->problem }}</td>
                        <td style="width:40px;"><a href="/orders/{{ $order->id }}"><i class="fa fa-2x fa-info text-secondary"></i></a></td>
                        <td style="width:40px;"><a href=""><i class="fa fa-2x text-secondary fa-pencil-square-o"></i></a></td>
                        <td style="width:200px;">
                            <a href=""><i class="fa fa-2x text-success fa-check pl-2"></i></a>
                            <a href=""><i class="fa fa-2x text-danger fa-close pl-2"></i></a>
                            <a href="/repairing/{{ $order->id }}/healthy"><i class="fa fa-2x text-success fa-heartbeat pl-2"></i></a>
                            <a href=""><i class="fa fa-2x text-warning fa-eye-slash"></i></a>
                        </td>
                        <td style="width:100px;">{{ $order->receive_date }}</td>
                    </tr>
                @endforeach
            </table>
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
