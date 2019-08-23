
<!--
     This view will be used for Show prepaired orders
-->



@extends('layouts.app')

@section('content')
    <div id="orders">



        <!-- search bar -->
        @include('common.searchbar')



        <!-- Prepaired Orders -->
        <div class="tbl-main-con">
            <table class="tbl-1">
                <tr>
                    <th style="width:40px">#</th>
                    <th style="width:40px">شناسه</th>
                    <th>نام و نام خانوادگی</th>
                    <th>نوع دستگاه</th>
                    <th>عیب</th>
                    <th style="width:60px">یادداشت</th>
                    <th style="width:60px">جزئیات</th>
                    <th style="width:60px">تحویل</th>
                    <th style="width:60px">وضعیت</th> 
                    <th style="width:80px">تاریخ دریافت</th>
                    <th>هزینه</th>
                </tr>
                <?php $i=1; ?>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->customer->name }}</td>
                        <td>{{ $order->device_type }}</td>
                        <td>{{ $order->problem }}</td>
                        <td><a href=""><i class="fa fa-2x text-secondary fa-pencil-square-o"></i></a></td>
                        <td><a href=""><i class="fa fa-2x fa-info-circle text-secondary"></i></a></td>
                        <td><a href=""><i class="fa fa-2x text-secondary fa-plane pl-2"></i></a></td>
                        <!--<td><a href=""><i class="fa fa-2x text-success fa-heartbeat pl-2"></i></a></td>-->
                        <td style="width:90px;">{{ $order->status_code }}</td>                        
                        <td>{{ $order->receive_date }}</td>
                        <td>sum</td>   
                    </tr>
                    <?php $i++; ?>
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