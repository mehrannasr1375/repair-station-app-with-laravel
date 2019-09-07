@extends('layouts.app')
@section('page','ویرایش تعمیری')
@section('content')



    <!-- search bar -->
    @include('common.searchbar')



    <!-- Form for show && edit order -->
    <div class="form-box">
        <form action="/orders/{{ $order->id }}" method="POST">



                @csrf
                @method('PATCH')



                <!-- Error Messages -->
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
                <!-- Success Message -->
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
                    <div>
                        <p class="mb-0"><i class="fa fa-user"></i> مشخصات مشتری :</p>
                    </div>
                    <div class="tab-content tbl-main-con">


                        <!-- tiny btns (new or existing customer) -->
                        <div>
                            <ul class="nav nav-tabs nav-justified">
                                <li class="nav-item active">
                                    <a href="#new-customer" id="new_customer" class="nav-link" data-toggle="tab">مشتری جدید</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#existing-customer" id="old_customer" class="nav-link active" data-toggle="tab">مشتری ثبت شده</a>
                                </li>
                            </ul>
                            <div style="visibility:hidden;">
                                <input type="radio" name="rd_customer_status" value="new" id="customer_status_new">new customer
                                <input type="radio" name="rd_customer_status" value="old" id="customer_status_old" checked="checked">old customer
                            </div>
                        </div>


                        <div class="tab-content p-3">

                            <!-- NEW CUSTOMER FIELDS -->
                            <div id="new-customer" class="tab-pane">
                                <div class="row">
                                    <!-- new customer name -->
                                    <div class="col-12 col-lg-8 form-group input-group">
                                        <div class="input-group-prepend"><div class="input-group-text"><span class="label">نام و نام خانوادگی :</span></div></div>
                                        <input type="text" class="form-control border-fix" name="name"  value="{{ old('name') }}" autocomplete="off" />
                                    </div>
                                    <!-- new customer is_partner -->
                                    <div class="col-6 col-lg-2 form-group input-group">
                                        <div class="input-group-prepend"><div class="input-group-text"><input type="checkbox" name="is_partner" value="1" {{ old('is_partner') ?'checked':'' }}/></div>
                                        </div>
                                        <div class="input-group-append"><div class="input-group-text label bg-white">همکار</div></div>
                                    </div>
                                    <!-- new customer id -->
                                    <div class="col-6 col-lg-2 form-group input-group">
                                        <div class="input-group-prepend"><div class="input-group-text"><span class="label">شناسه:</span></div></div>
                                        <input type="text" class="form-control" name="new_customer_serial" disabled />
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- new customer tell -->
                                    <div class="col-12 col-lg-6 form-group input-group">
                                        <div class="input-group-prepend"><div class="input-group-text"><span class="label">تلفن ثابت 1 :</span></div></div>
                                        <input type="text" class="form-control" name="tell_1" value="{{ old('tell_1') }}" autocomplete="off" />
                                    </div>
                                    <div class="col-12 col-lg-6 form-group input-group">
                                        <div class="input-group-prepend"><div class="input-group-text"><span class="label">تلفن ثابت 2 :</span></div></div>
                                        <input type="text" class="form-control" name="tell_2" value="{{ old('tell_2') }}" autocomplete="off" />
                                    </div>
                                    <!-- new customer mobile -->
                                    <div class="col-12 col-lg-6 form-group input-group">
                                        <div class="input-group-prepend"><div class="input-group-text"><span class="label">تلفن همراه 1 :</span></div></div>
                                        <input type="text" class="form-control" name="mobile_1" value="{{ old('mobile_1') }}" autocomplete="off" />
                                    </div>
                                    <div class="col-12 col-lg-6 form-group input-group">
                                        <div class="input-group-prepend"><div class="input-group-text"><span class="label">تلفن همراه 2 :</span></div></div>
                                        <input type="text" class="form-control" name="mobile_2" value="{{ old('mobile_2') }}" autocomplete="off" />
                                    </div>
                                    <!-- new customer address -->
                                    <div class="col-12 form-group input-group">
                                        <div class="input-group-prepend"><div class="input-group-text"><span class="label">آدرس :</span></div></div>
                                        <input type="text" class="form-control" name="address" value="{{ old('address') }}" />
                                    </div>
                                </div>
                            </div>

                            <!-- EXISTING CUSTOMER FIELDS -->
                            <div id="existing-customer" class="tab-pane active">
                                <div class="row">
                                    <!-- existing customer name -->
                                    <div class="col-12 col-lg-9 form-group input-group">
                                        <div class="input-group-prepend"><div class="input-group-text"><span class="label">نام و نام خانوادگی :</span></div></div>
                                        <input type="text" class="form-control border-fix" name="name" value="{{ old('old_name') ?? $order->customer->name }}" autocomplete="off" />
                                    </div>
                                    <!-- existing customer id -->
                                    <div class="col-12 col-lg-3 form-group input-group">
                                        <div class="input-group-prepend"><div class="input-group-text"><span class="label">شناسه:</span></div></div>
                                        <input type="text" class="form-control" name="old_customer_id" value="{{ old('old_customer_id') ?? $order->customer_id }}" autocomplete="off" disabled />
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>



                <!-- order details -->
                <div class="con">
                    <div>
                        <p class="mb-0"><i class="fa fa-microchip"></i> مشخصات قطعه :</p>
                    </div>
                    <div class="row">
                        <!-- device_type -->
                        <div class="col-12 col-lg-6 form-group input-group">
                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">نوع قطعه:</span></div></div>
                            
                        
                            <select style="direction:ltr;" class="form-control custom-select text-vsm" name="device_type" >
                                <option {{ $order->device_type=='لپ تاپ'   ? 'selected':'' }} value="لپ تاپ">لپ تاپ</option>
                                <option {{ $order->device_type=='کیس'     ? 'selected':'' }} value="کیس">کیس</option>
                                <option {{ $order->device_type=='مادربرد'   ? 'selected':'' }} value="مادربرد">مادربرد</option>
                                <option {{ $order->device_type=='پاور'     ? 'selected':'' }} value="پاور">پاور</option>
                                <option {{ $order->device_type=='کیبورد'    ? 'selected':'' }} value="کیبورد">کیبورد</option>
                                <option {{ $order->device_type=='مانیتور'    ? 'selected':'' }} value="مانیتور">مانیتور</option>
                                <option {{ $order->device_type=='اسپیکر'    ? 'selected':'' }} value="اسپیکر">اسپیکر</option>
                                <option {{ $order->device_type=='DVD Rom' ? 'selected':'' }} value="DVD Rom">DVD Rom</option>
                                <option {{ $order->device_type=='HDD'     ? 'selected':'' }} value="HDD">HDD</option>
                                <option {{ $order->device_type=='کارت گرافیک' ? 'selected':'' }} value="کارت گرافیک">کارت گرافیک</option>
                                <option {{ $order->device_type=='مودم'     ? 'selected':'' }} value="مودم">مودم</option>
                                <option {{ $order->device_type=='پرینتر'    ? 'selected':'' }} value="پرینتر">پرینتر</option>
                                <option {{ $order->device_type=='اسکنر'    ? 'selected':'' }} value="اسکنر">اسکنر</option>
                                <option {{ $order->device_type=='کارتریج'   ? 'selected':'' }} value="کارتریج">کارتریج</option>
                                <option {{ $order->device_type=='تبلت'     ? 'selected':'' }} value="تبلت">تبلت</option>
                                <option {{ $order->device_type=='ماوس'    ? 'selected':'' }} value="ماوس">ماوس</option>
                                <option {{ $order->device_type=='تلویزیون'  ? 'selected':'' }} value="تلویزیون">تلویزیون</option>
                                <option {{ $order->device_type=='هدست'   ? 'selected':'' }} value="هدست">هدست</option>
                                <option {{ $order->device_type=='دیگر'    ? 'selected':'' }} value="دیگر">دیگر</option>
                            </select>
                        
                        
                        </div>
                        <!-- device_brand -->
                        <div class="col-12 col-lg-3 form-group input-group">
                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">برند:</span></div></div>
                            <input type="text" class="form-control" name="device_brand" value="{{ old('device_brand') ?? $order->device_brand }}" autocomplete="off" />
                        </div>
                        <!-- order_id -->
                        <div class="col-12 col-lg-3 form-group input-group">
                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">شناسه فاکتور:</span></div></div>
                            <input type="text" class="form-control" name="order_id" value="{{ $order->id }}" disabled />
                        </div>
                        <!-- device_model -->
                        <div class="col-12 col-lg-3 form-group input-group">
                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">مدل:</span></div></div>
                            <input type="text" class="form-control" name="device_model" value="{{ old('device_model') ?? $order->device_model }}" autocomplete="off" />
                        </div>
                        <!-- device_serial -->
                        <div class="col-12 col-lg-3 form-group input-group">
                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">شماره سریال:</span></div></div>
                            <input type="text" class="form-control text-vsm" name="device_serial" value="{{ old('device_serial') ?? $order->device_serial }}" autocomplete="off" />
                        </div>
                        <!-- date -->
                        <div class="col-12 col-lg-3 form-group input-group">
                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">تاریخ:</span></div></div>
                            <input type="text" class="form-control" name="date" value="{{ old('date') ?? $order->date }}" autocomplete="off" />
                        </div>
                        <!-- opened_earlier -->
                        <div class="col-12 col-lg-3 form-group input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" name="opened_earlier" {{ $order->opened_earlier==true ? 'checked':'' }} />
                                </div>
                            </div>
                            <div class="input-group-append"><div class="input-group-text label bg-white">قبلا تعمیر شده</div></div>
                        </div>
                        <!-- problem -->
                        <div class="col-12 form-group input-group">
                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">مشکل:</span></div></div>
                            <textarea style="min-height:60px;" class="form-control text-vsm" name="problem">{{ old('problem') ?? $order->problem }}</textarea>
                        </div>
                        <!-- problem_details -->
                        <div class="col-12 form-group input-group">
                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">توضیحات:</span></div></div>
                            <textarea style="min-height:60px;" class="form-control text-vsm" name="problem_details">{{ old('problem_details') ?? $order->problem_details }}</textarea>
                        </div>
                        <!-- participants -->
                        <div class="col-12 form-group input-group">
                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">قطعات همراه:</span></div></div>
                            <textarea class="form-control text-vsm" name="participants_csv">{{ old('participants_csv') ?? $order->participants_csv }}</textarea>
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



@endsection
