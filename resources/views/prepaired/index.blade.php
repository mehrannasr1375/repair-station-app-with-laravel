@extends('layouts.app')
@section('page','قطعات آماده تحویل')
@section('content')



    <!-- search bar -->
    @include('common.searchbar')



    <!-- Prepaired Orders -->
    <div class="tbl-main-con">
        <table class="tbl-1">
            <tr>
                <th style="width:40px">شناسه</th>
                <th>نام و نام خانوادگی</th>
                <th>نوع دستگاه</th>
                <th>عیب</th>
                <th style="width:60px">جزئیات</th>
                <th style="width:60px">یادداشت</th>
                <th style="width:60px">تحویل</th>
                <th style="width:60px">وضعیت</th>
                <th style="width:80px">تاریخ دریافت</th>
                <th>هزینه</th>
            </tr>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->customer->name }}</td>
                    <td>{{ $order->device_type }}</td>
                    <td>{{ $order->problem }}</td>
                    <td><a href="/orders/{{ $order->id }}"><i class="fa fa-2x fa-info text-secondary"></i></a></td>
                    <td><a href=""><i class="fa fa-2x text-secondary fa-pencil-square-o"></i></a></td>
                    <td><a href=""><i class="fa fa-2x text-secondary fa-plane pl-2"></i></a></td>
                    <!--<td><a href=""><i class="fa fa-2x text-success fa-heartbeat pl-2"></i></a></td>-->
                    <td style="width:90px;">{{ $order->status_code }}</td>
                    <td>{{ $order->receive_date }}</td>
                    <td>sum</td>
                </tr>
            @endforeach
        </table>
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                {{ $orders->links() }}
            </div>
        </div>
    </div>



@endsection
