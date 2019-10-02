@extends('layouts.frame')
@section('page','مشتریان')
@section('content')



    <!-- search bar --------------------------------------------------------------------------------------------------------------------------->
    @include('common.searchbar')



    <!-- Tiny btns ----------------------------------------------------------------------------------------------------------------------------->
    <div class="form-box pl-0 pr-2 mb-4">
        <ul class="nav nav-tabs nav-justified mt-4">
            <li class="nav-item {{ strpos(url()->current(), '/customers/return/all') ? "active":"" }} ">
                <a href="/customers/return/all" class="nav-link {{ strpos(url()->current(), '/customers/return/all') ? "active":"" }} ">همه</a>
            </li>
            <li class="nav-item {{ strpos(url()->current(), '/customers/return/partners') ? "active":"" }} ">
                <a href="/customers/return/partners" class="nav-link {{ strpos(url()->current(), '/customers/return/partners') ? "active":"" }} ">همکار</a>
            </li>
            <li class="nav-item {{ strpos(url()->current(), '/customers/return/customers') ? "active":"" }} ">
                <a href="/customers/return/customers" class="nav-link {{ strpos(url()->current(), '/customers/return/customers') ? "active":"" }} ">مشتری</a>
            </li>
        </ul>
    </div>



    <!-- Customers container ------------------------------------------------------------------------------------------------------->
    <div class="tbl-main-con">



        <!-- Table --->
        <div id="normal">
            <table class="tbl-1">
                <tr>
                    <th style="width:60px;">شناسه مشتری</th>
                    <th>نام و نام خانوادگی</th>
                    <th>اطلاعات مشتری</th>
                    <th>لیست تمامی قطعات</th>
                    <th>قطعات موجود</th>
                    <th>قطعات آماده</th>
                    <th>صورت حساب</th>
                </tr>
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td><a href="/customers/{{ $customer->id }}/edit">{{ $customer->name }}</a></td>
                        <td><a href="/customers/{{ $customer->id }}"><i class="fa fa-2x text-secondary fa-info pl-2"></i></a></td>
                        <td><a href="/customers/{{ $customer->id }}/orders"><i class="fa fa-2x text-dark fa-microchip pl-2"></i></a></td>
                        <td>{{ $customer->available_orders_count == 0 ? "-":$customer->available_orders_count }}</td>
                        <td>{{ $customer->prepaired_orders_count == 0 ? "-":$customer->prepaired_orders_count }}</td>
                        <td><a href="/customers/{{ $customer->id }}/bills"><i class="fa fa-2x text-success fa-money pl-2"></i></a></td>
                    </tr>
                @endforeach
            </table>
            <!-- Pagination -->
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    {{ $customers->onEachSide(2)->links() }}
                </div>
            </div>
        </div>



    </div>



    <!-- New Customer Btn ---------------------------------------------------------------------------------------------------------------------->
    <div class="row my-5">
        <div class="col-12 d-flex justify-content-end">
            <a href="/customers/create" class="btn btn-bordered">مشتری جدید</a>
        </div>
    </div>



@endsection
