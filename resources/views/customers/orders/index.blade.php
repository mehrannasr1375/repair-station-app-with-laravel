@extends('layouts.frame')
@section('page','تاریخچه کلی مشتری ')
@section('content')




    <!-- Customer details ----------------------------------------------------------------------------------------------------------------->
    <div class="alert alert-info mt-6">
        <p class="text-right mb-3 text-black font-weight-bold">لیست تعمیری های مشتری :</p>
        <div class="d-flex flex-wrap justify-content-between">
            <div>
                <span>نام : </span>
                <span class="font-weight-bold"> {{ $customer->name }} </span>
            </div>
            <div>
                <span>کد : </span>
                <span class="font-weight-bold"> {{ $customer->id }} </span>
            </div>
            <div>
                <span>کل تعمیری ها : </span>
                <span class="font-weight-bold"> {{ count($orders) }} </span>
            </div>
            <div>
                <span>شماره های تماس : </span>
                <span class="font-weight-bold"> {{ $customer->mobile_1 }} و {{ $customer->tell_1 }} </span>
            </div>
        </div>
    </div>



    <!-- Orders ------------------------------------------------------------------------------------------------------------------------------------------------------>
    <div class="tbl-main-con">
        <div id="normal">

            <table class="tbl-1">
                @if ( count($orders) == 0 )
                    <p class="text-center text-sm-center text-secondary pt-5">
                        <i class="fa fa-2x fa-close mb-4"></i>
                        <br>
                        اینجا خبری نیست!
                    </p>
                @else
                    <tr>
                        <th style="width:40px;">شناسه</th>
                        <th>نام و نام خانوادگی</th>
                        <th>جزئیات</th>
                        <th>نوع دستگاه</th>
                        <th>عیب</th>
                        <th style="width:90px;">تاریخ دریافت</th>
                        <th style="width:80px">وضعیت</th>
                        <th style="width:60px">تحویل</th>
                    </tr>
                    @foreach ($orders as $order)
                        <tr>
                            <td style="width:30px !important;" class="text-right">{{ $order->id }}</td>
                            <td>{{ $order->customer->name }}</td>
                            <td><a href="/orders/{{ $order->id }}/edit"><i class="fa fa-2x text-secondary fa-info pl-2"></i></a></td>
                            <td>{{ $order->device_type }}</td>
                            <td style="max-width:150px; padding:14px;">{{ $order->problem }}</td>
                            <td>{{ Verta::persianNumbers($order->receive_date) }}</td>
                            <td>
                                <?php
                                    if      ( $order->status_code == 'تعمیر شده' )         echo "<i class='fa fa-check text-success'></i>";
                                    else if ( $order->status_code == 'در حال تعمیر' )      echo "<i class='fa fa-refresh text-info'></i>";
                                    else if ( $order->status_code == 'تعمیر نمی شود' )     echo "<i class='fa fa-close text-danger'></i>";
                                    else if ( $order->status_code == 'انصراف مشتری' )     echo "<i class='fa fa-eye-slash text-black-50'></i>";
                                    else if ( $order->status_code == 'ایراد ندارد' )         echo "<i class='fa fa-heartbeat text-success'></i>";
                                ?>
                            </td>
                            <td>
                                <?php
                                    if ( $order->checkout )   echo "<i class='fa fa-plane text-success'></i>";
                                    else                      echo " - ";
                                ?>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </table>

            <!-- Pagination -->
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    {{ $orders->links() }}
                </div>
            </div>

        </div>
    </div>



@endsection
