@extends('layouts.app')
@section('page','تاریخچه کلی مشتری ')
@section('content')



    <!-- search bar -->
    @include('common.searchbar')


    <div class="alert alert-info">
        <p class="text-center mb-0 text-black-50 font-weight-bold">
            لیست تعمیری های مشتری
            <span class="p-2 text-info">{{ $orders->first()->customer->name ?? ' ' }}</span>
            ( کد
            <span class="p-1">{{ $orders->first()->customer_id ?? ' ' }}</span>
             ) :
        </p>
    </div>


    <!-- Customers && Partners container -->
    <div class="tbl-main-con">



        <!-- Orders --->
        <div id="normal">
            <table class="tbl-1">

                @if ( count($orders) == 0 )
                    <p class="text-center text-sm-center text-secondary p-5">
                        چیزی یافت نشد!
                    </p>
                @else
                    <tr>
                        <th style="width:40px;">شناسه</th>
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
                            <td style="width:30px !important;" class="text-right">{{ $order->id }}</td>
                            <td>{{ $order->customer->name }}</td>
                            <td><a href="/orders/{{ $order->id }}/edit"><i class="fa fa-2x text-secondary fa-info pl-2"></i></a></td>
                            <td>{{ $order->device_type }}</td>
                            <td style="max-width:150px; padding:14px;">{{ $order->problem }}</td>
                            <td>{{ new Verta($order->receive_date) }}</td>
                            <td>{{ $order->status_code }}</td>
                            <td>{{ $order->checkout }}</td>
                        </tr>
                    @endforeach
                @endif
            </table>
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>




    </div>



@endsection
