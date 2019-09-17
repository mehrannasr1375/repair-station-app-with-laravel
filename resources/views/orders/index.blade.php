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
                        <th style="width:40px;">شناسه</th>
                        <th>نام و نام خانوادگی</th>
                        <th>جزئیات</th>
                        <th>نوع دستگاه</th>
                        <th>عیب</th>
                        <th>تاریخ دریافت</th>
                        <th style="width:80px">وضعیت تعمیر</th>
                        <th style="width:60px">وضعیت تحویل</th>
                        <th style="width:80px">وضعیت بدهی</th>
                        <th style="width:50px">حذف</th>
                    </tr>
                    @foreach ($orders as $order)
                        <tr>
                            <td style="width:30px !important;" class="text-right">{{ $order->id }}</td>
                            <td>{{ $order->customer->name }}</td>
                            <td><a href="/orders/{{ $order->id }}/edit"><i class="fa fa-2x text-secondary fa-info pl-2"></i></a></td>
                            <td>{{ $order->device_type }}</td>
                            <td style="max-width:150px; padding:14px;">{{ $order->problem }}</td>
                            <td style="width:80px;">{{ new Verta($order->receive_date) }}</td>
                            <td style="width:110px;">{{ $order->status_code }}</td>
                            <td>
                                <?php
                                if ( $order->checkout )         echo "<i class='fa fa-check text-success'></i>";
                                else                            echo " - ";
                                ?>
                            </td>
                            <td>
                                <?php
                                if ( $order->debt_status > 0 )          echo $order->debt_status . ' بد ';
                                elseif ( $order->debt_status < 0 )      echo $order->debt_status . ' بس ';
                                else                                    echo '-';
                                ?>
                            </td>
                            <td>
                                <form action="/orders/{{ $order->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value=""/><i class="fa fa-remove text-danger font-weight-bold"></i>
                                </form>
                            </td>
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
