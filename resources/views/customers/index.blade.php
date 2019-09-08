@extends('layouts.app')
@section('page','مشتریان')
@section('content')



    <!-- search bar --------------------------------------------------------------------------------------------------------------------------->
    @include('common.searchbar')



    <!-- Tiny btns ----------------------------------------------------------------------------------------------------------------------------->
    <div class="form-box">
        <ul class="nav nav-tabs nav-justified m-4 ml-5">
            <li class="nav-item active">
                <a class="nav-link active" href="#partner" data-toggle="tab">همکار</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#normal" data-toggle="tab">مشتری</a>
            </li>
        </ul>
    </div>



    <!-- Customers && Partners container ------------------------------------------------------------------------------------------------------->
    <div class="tab-content tbl-main-con">



        <!-- Partners Table -->
        <div class="tab-pane active show" id="partner">
            <table class="tbl-1">
                <tr>
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
                @foreach ($partners as $partner)
                    <tr>
                        <td>{{ $partner->id }}</td>
                        <td><a href="/customers/{{ $partner->id }}/edit">{{ $partner->name }}</a></td>
                        <td><a href="/customers/{{ $partner->id }}"><i class="fa fa-2x text-secondary fa-info pl-2"></i></a></td>
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
                    {{ $partners->links() }}
                </div>
            </div>
        </div>



        <!-- Customers Table --->
        <div class="tab-pane" id="normal">
            <table class="tab-pane tbl-1">
                <tr>
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
                        <td>{{ $customer->id }}</td>
                        <td><a href="/customers/{{ $customer->id }}/edit">{{ $customer->name }}</a></td>
                        <td><a href="/customers/{{ $customer->id }}"><i class="fa fa-2x text-secondary fa-info pl-2"></i></a></td>
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
                    {{ $customers->links() }}
                </div>
            </div>
        </div>



        <!-- New Customer Btn --->
        <div class="row">
            <div class="col-12 d-flex justify-content-end">
                <a href="/customers/create" class="btn btn-sm btn-outline-secondary">مشتری جدید</a>
            </div>
        </div>



    </div>



@endsection
