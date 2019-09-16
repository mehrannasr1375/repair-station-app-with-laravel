@extends('layouts.app')
@section('page','ثبت تعمیری جدید')
@section('content')



    <!-- search bar -->
    @include('common.searchbar')



    <!-- Form - create order (& customer) -->
    <div class="form-box">
        <form action="/orders" method="POST">
        @csrf



            <!-- Messages -->
            <span class="row mb-4">
                <span class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </span>
            </span>
            <span class="row mb-4">
                <span class="col">
                    @if ( session()->has('success_res') )
                        <div class="alert alert-success">
                            {{ session()->get('success_res') }}
                        </div>
                    @endif
                </span>
            </span>



            <!-- Customer details -->
            <div class="con">
                <div><p class="mb-0"><i class="fa fa-user"></i> مشخصات مشتری :</p></div>
                <div class="tab-content tbl-main-con">
                    <!-- tiny btns (new or existing customer) -->
                    <div>
                        <ul class="nav nav-tabs nav-justified">
                            <li class="nav-item active">
                                <a href="#new-customer" id="new_customer" class="nav-link active" data-toggle="tab">مشتری جدید</a>
                            </li>
                            <li class="nav-item">
                                <a href="#existing-customer" id="old_customer" class="nav-link" data-toggle="tab">مشتری ثبت شده</a>
                            </li>
                        </ul>
                        <div style="visibility:hidden;">
                            <input type="radio" name="rd_customer_status" value="new" id="customer_status_new" checked="checked">new customer
                            <input type="radio" name="rd_customer_status" value="old" id="customer_status_old">old customer
                        </div>
                    </div>
                    <div class="tab-content">


                        <!-- NEW CUSTOMER FIELDS -->
                        <div id="new-customer" class="tab-pane active">
                            <div class="row">
                                <!-- new customer name -->
                                <div class="col-12 col-lg-6 form-group input-group">
                                    <div class="input-group-prepend"><div class="input-group-text"><span class="label">نام و نام خانوادگی :</span></div></div>
                                    <input type="text" class="form-control border-fix" name="name"  value="{{ old('name') }}" autocomplete="off" />
                                </div>
                                <!-- new customer is_partner -->
                                <div id="chk_is_partner" class="col-6 col-lg-2 form-group input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" name="is_partner" {{ old('is_partner') ? 'checked':'' }}/>
                                        </div>
                                    </div>
                                    <div class="input-group-append"><div class="input-group-text label bg-white">همکار</div></div>
                                </div>
                                <!-- new customer id -->
                                <div class="col-6 col-lg-3 form-group input-group mr-auto">
                                    <div class="input-group-prepend"><div class="input-group-text"><span class="label">شناسه:</span></div></div>
                                    <input type="text" class="form-control font-weight-bold text-danger" name="new_customer_serial"  disabled />
                                </div>
                            </div>
                            <div class="row">
                                <!-- new customer phones -->
                                <div class="col-12 col-lg-6 form-group input-group">
                                    <div class="input-group-prepend"><div class="input-group-text"><span class="label">تلفن همراه :</span></div></div>
                                    <input type="text" class="form-control text-center" name="mobile_1" value="{{ old('mobile_1') }}"  autocomplete="off"/>
                                </div>
                                <div class="col-12 col-lg-6 form-group input-group">
                                    <div class="input-group-prepend"><div class="input-group-text"><span class="label">تلفن ثابت :</span></div></div>
                                    <input type="text" class="form-control text-center" name="tell_1" value="{{ old('tell_1') }}"  autocomplete="off"/>
                                </div>
                                <!-- new customer address -->
                                <div class="col-12 form-group input-group">
                                    <div class="input-group-prepend"><div class="input-group-text"><span class="label">آدرس :</span></div></div>
                                    <input type="text" class="form-control" name="address" value="{{ old('address') }}"  autocomplete="off" />
                                </div>
                            </div>
                        </div>


                        <!-- EXISTING CUSTOMER FIELDS -->
                        <div id="existing-customer" class="tab-pane">
                            <div class="row">
                                <!-- existing customer name -->
                                <div class="col-12 col-lg-6 form-group input-group">
                                    <div class="input-group-prepend"><div class="input-group-text"><span class="label">نام و نام خانوادگی :</span></div></div>
                                    <input type="text" class="form-control border-fix" name="old_name" value="{{ old('old_name') }}" autocomplete="off" />
                                </div>
                                <!-- existing customer id -->
                                <div class="col-12 col-lg-3 form-group input-group mr-auto">
                                    <div class="input-group-prepend"><div class="input-group-text"><span class="label">شناسه:</span></div></div>
                                    <input type="text" class="form-control text-center font-weight-bold text-danger" name="old_customer_id" value="{{ old('old_customer_id') }}" autocomplete="off" />
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>



            <!-- order details -->
            <div class="con">
                    <div><p class="mb-0"><i class="fa fa-microchip"></i> مشخصات قطعه :</p></div>
                    <div class="row">

                        <!-- device_type -->
                        <div class="col-12 col-lg-6 input-group form-group ">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><span class="label">نوع قطعه : </span></div>
                            </div>
                            <select style="direction:ltr;" class="form-control custom-select text-vsm" name="device_type" >
                                <option value="لپ تاپ">لپ تاپ</option>
                                <option value="کیس">کیس</option>
                                <option value="مادربرد">مادربرد</option>
                                <option value="پاور">پاور</option>
                                <option value="کیبورد">کیبورد</option>
                                <option value="مانیتور">مانیتور</option>
                                <option value="اسپیکر">اسپیکر</option>
                                <option value="DVD Rom">DVD Rom</option>
                                <option value="HDD">HDD</option>
                                <option value="کارت گرافیک">کارت گرافیک</option>
                                <option value="مودم">مودم</option>
                                <option value="پرینتر">پرینتر</option>
                                <option value="اسکنر">اسکنر</option>
                                <option value="کارتریج">کارتریج</option>
                                <option value="تبلت">تبلت</option>
                                <option value="ماوس">ماوس</option>
                                <option value="تلویزیون">تلویزیون</option>
                                <option value="هدست">هدست</option>
                                <option value="دیگر">دیگر</option>
                            </select>
                        </div>
                        <!-- date -->
                        <div class="col-12 col-lg-4 form-group input-group mr-auto">
                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">تاریخ:</span></div></div>
                            <input type="text" class="form-control text-center" name="date" value="{{ Verta::now() }}" autocomplete="off" disabled />
                        </div>
                        <!-- device_brand -->
                        <div class="col-12 col-lg-3 form-group input-group">
                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">برند:</span></div></div>
                            <input type="text" class="form-control text-vsm" name="device_brand" value="{{ old('device_brand') }}" autocomplete="off" />
                        </div>
                        <!-- device_model -->
                        <div class="col-12 col-lg-3 form-group input-group">
                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">مدل:</span></div></div>
                            <input type="text" class="form-control" name="device_model" value="{{ old('device_model') }}" autocomplete="off" />
                        </div>
                        <!-- opened_earlier -->
                        <div id="chk_is_repaired" class="col-12 col-lg-3 form-group input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" name="opened_earlier" {{ old('opened_earlier') ? 'checked':'' }}/>
                                </div>
                            </div>
                            <div class="input-group-append"><div class="input-group-text label bg-white">قبلا تعمیر شده</div></div>
                        </div>
                        <!-- order_id -->
                        <div class="col-12 col-lg-3 form-group input-group">
                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">شناسه فاکتور:</span></div></div>
                            <input type="text" class="form-control text-center font-weight-bold text-danger" name="order_id" disabled />
                        </div>
                        <!-- problem -->
                        <div class="col-12 form-group input-group">
                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">ایراد:</span></div></div>
                            <textarea style="min-height:60px;" class="form-control text-vsm" name="problem">{{ old('problem') }}</textarea>
                        </div>
                        <!-- problem_details -->
                        <div class="col-12 form-group input-group">
                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">توضیحات:</span></div></div>
                            <textarea style="min-height:60px;" class="form-control text-vsm" name="problem_details">{{ old('problem_details') }}</textarea>
                        </div>
                        <!-- participants -->
                        <div class="col-12 form-group input-group">
                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">قطعات همراه:</span></div></div>
                            <textarea class="form-control" name="participants_csv">{{ old('participants_csv') }}</textarea>
                        </div>
                        <!-- btns -->
                        <div class="container my-3">
                            <button class="btn btn-outline-secondary btn-sm" type="submit" name="btn-submit-order" > ثبت <i class="fa fa-check"></i></button>
                            <button class="btn btn-outline-secondary btn-sm" type="button" name="btn-print-order" > چاپ <i class="fa fa-navicon"></i></button>
                        </div>
                    </div>
                </div>



        </form>
    </div>



    <script type="text/javascript">
        $(window).on('load', function() {
            $("#chk_is_partner").click(function (event) {
                $('input[type=checkbox][name=is_partner]').click();
            });
            $("#chk_is_repaired").click(function (event) {
                $('input[type=checkbox][name=opened_earlier]').click();
            });
        });
    </script>



@endsection
