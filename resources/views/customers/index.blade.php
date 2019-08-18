@extends('layouts.app')

@section('content')
    <div id="repairing">



        <!-- search bar -->
        @include('common.searchbar')



        <!-- Tiny btns -->
        <ul class="nav nav-tabs nav-justified m-4 ml-5">
            <li class="nav-item active hover-bottom-e">
                <a class="nav-link active" href="#partner" data-toggle="tab">همکار</a>
            </li>
            <li class="nav-item hover-bottom-e">
                <a class="nav-link" href="#normal"  data-toggle="tab">مشتری</a>
            </li>
        </ul>



        <!-- Customers && Partners container -->
        <div class="tab-content tbl-main-con">



            <!-- Customers Table -->
            <div class="tab-pane active show" id="partner">
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
                    @foreach ($customers as $customer)
                    <tr>
                        <td>1</td>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td><a href=""><i class="fa fa-2x text-secondary fa-address-book-o pl-2"></i></a></td>
                        <td><a href=""><i class="fa fa-2x text-dark fa-microchip pl-2"></i></a></td>
                        <td>4</td>
                        <td>1</td>
                        <td>5</td>
                        <td>275000</td>
                        <td>120000</td>
                        <td><a href=""><i class="fa fa-2x text-success fa-money pl-2"></i></a></td>
                    </tr>
                    @endforeach
                </table>
                
            </div>



            <!-- Partners Table --->
            <div class="tab-pane" id="normal">
                <table class="tab-pane tbl-1">
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
                    @foreach ($customers as $customer)
                        <tr>
                            <td>1</td>
                            <td>{{ $customer->id }}</td>
                            <td>{{ $customer->name }}</td>
                            <td><a href=""><i class="fa fa-2x text-secondary fa-address-book-o pl-2"></i></a></td>
                            <td><a href=""><i class="fa fa-2x text-dark fa-microchip pl-2"></i></a></td>
                            <td>4</td>
                            <td>1</td>
                            <td>5</td>
                            <td>275000</td>
                            <td>120000</td>
                            <td><a href=""><i class="fa fa-2x text-success fa-money pl-2"></i></a></td>
                        </tr>
                    @endforeach
                </table>
                
            </div>



        </div>



    </div>
@endsection