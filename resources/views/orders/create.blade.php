
<!--
     This view will be used for show create orders form
-->


@extends('layouts.app')

@section('content')




    <!-- search bar -->
    @include('common.searchbar')




    <div id="create-customer">
        



        <!-- Form - create order (& customer) -->
        <div id="new-order">
            <form action="/orders/" method="POST" id="newOrder">

                


                <!-- customer details -->
                <div class="con">
                    <div><p class="mb-0"><i class="fa fa-user"></i> مشخصات مشتری :</p></div>
                        <div class="tab-content tbl-main-con">
                       


                            <!-- tiny btns (new or existing customer) -->
                            <div>
                                <ul class="nav nav-tabs nav-justified">
                                    <li class="nav-item active hover-bottom-e">
                                        <a href="#new-customer" class="nav-link active" data-toggle="tab">مشتری جدید</a>
                                    </li>
                                    <li class="nav-item hover-bottom-e">
                                        <a href="#existing-customer" class="nav-link" data-toggle="tab">مشتری ثبت شده</a>
                                    </li>
                                </ul>
                                <div style="visibility:hidden;">
                                    <input type="radio" name="rd_customer_status" value="new" id="customer_status_new" checked>new customer
                                    <input type="radio" name="rd_customer_status" value="old" id="customer_status_old">old customer
                                </div>
                            </div>



                            <div class="tab-content p-3">




                                <!-- NEW CUSTOMER FIELDS -->
                                <div id="new-customer" class="tab-pane active">

                                    <div class="row">

                                        <!-- new customer name -->
                                        <div class="col-12 col-lg-8 form-group input-group">
                                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">نام و نام خانوادگی :</span></div></div>
                                            <input type="text" class="form-control border-fix" name="new_name"  value="{{ old('new_name') }}" />
                                        </div>

                                        <!-- new customer is_partner -->
                                        <div class="col-6 col-lg-2 form-group input-group">
                                            <div class="input-group-prepend"><div class="input-group-text">
                                                <input type="checkbox" name="new_is_partner" {{ old('new_is_partner') ?'checked':'' }}/></div>
                                            </div>
                                            <div class="input-group-append"><div class="input-group-text label bg-white">همکار</div></div>
                                        </div>

                                        <!-- new customer id -->
                                        <div class="col-6 col-lg-2 form-group input-group">
                                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">شناسه:</span></div></div>
                                            <input type="text" class="form-control" name="new_customer_serial"/>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <!-- new customer tell -->
                                        <div class="col-12 col-lg-6 form-group input-group">
                                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">تلفن ثابت 1 :</span></div></div>
                                            <input type="text" class="form-control" name="tell_1" value="{{ old('tell_1') }}" />
                                        </div>
                                        <div class="col-12 col-lg-6 form-group input-group">
                                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">تلفن ثابت 2 :</span></div></div>
                                            <input type="text" class="form-control" name="tell_2" value="{{ old('tell_2') }}" />
                                        </div>
                                        
                                        <!-- new customer mobile -->
                                        <div class="col-12 col-lg-6 form-group input-group">
                                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">تلفن همراه 1 :</span></div></div>
                                            <input type="text" class="form-control" name="mobile_1"  value="{{ old('mobile_1') }}" />
                                        </div>
                                        <div class="col-12 col-lg-6 form-group input-group">
                                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">تلفن همراه 2 :</span></div></div>
                                            <input type="text" class="form-control" name="mobile_2"  value="{{ old('mobile_2') }}" />
                                        </div>
                    
                                        <!-- new customer address -->
                                        <div class="col-12 form-group input-group">
                                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">آدرس :</span></div></div>
                                            <input type="text" class="form-control" name="address"  value="{{ old('address') }}"/>
                                        </div>
                                    </div>

                                </div>




                                <!-- EXISTING CUSTOMER FIELDS -->
                                <div id="existing-customer" class="tab-pane ">
                                    <div class="row">

                                        <!-- existing customer name -->
                                        <div class="col-12 col-lg-4 form-group input-group">
                                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">نام :</span></div></div>
                                            <input type="text" class="form-control border-fix" name="old_name" value="{{ old('old_name') }}" />
                                        </div>

                                        <!-- existing customer id -->
                                        <div class="col-12 col-lg-3 form-group input-group">
                                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">شناسه:</span></div></div>
                                            <input type="text" class="form-control" name="old_customer_id" value="{{ old('old_customer_id') }}"/>
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
                        <div class="col-12 col-lg-6 form-group input-group">
                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">نوع قطعه:</span></div></div>
                            <input type="text" class="form-control" name="device_type" value="{{ old('device_type') }}"/>
                        </div>

                        <!-- device_brand -->
                        <div class="col-12 col-lg-3 form-group input-group">
                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">برند:</span></div></div>
                            <input type="text" class="form-control" name="device_brand" value="{{ old('device_brand') }}"/>
                        </div>

                        <!-- order_id -->
                        <div class="col-12 col-lg-3 form-group input-group">
                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">شناسه فاکتور:</span></div></div>
                            <input type="text" class="form-control" name="order_id" />
                        </div>

                        <!-- device_model -->
                        <div class="col-12 col-lg-3 form-group input-group">
                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">مدل:</span></div></div>
                            <input type="text" class="form-control" name="device_model" value="{{ old('device_model') }}"/>
                        </div>

                        <!-- device_serial -->
                        <div class="col-12 col-lg-3 form-group input-group">
                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">شماره سریال:</span></div></div>
                            <input type="text" class="form-control" name="device_serial" value="{{ old('device_serial') }}"/>
                        </div>

                        <!-- date -->
                        <div class="col-12 col-lg-3 form-group input-group">
                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">تاریخ:</span></div></div>
                            <input type="text" class="form-control" name="date" value="{{ old('date') }}"/>
                        </div>

                        <!-- already_repaired -->
                        <div class="col-12 col-lg-3 form-group input-group">
                            <div class="input-group-prepend"><div class="input-group-text"><input type="checkbox" name="already_repaired" /></div></div>
                            <div class="input-group-append"><div class="input-group-text label bg-white">قبلا تعمیر شده</div></div>
                        </div>

                        <!-- problem -->
                        <div class="col-12 form-group input-group">
                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">مشکل:</span></div></div>
                            <input type="text" class="form-control" name="problem" value="{{ old('problem') }}" style="text-align: right"/>
                        </div>

                        <!-- problem_details -->
                        <div class="col-12 form-group input-group">
                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">توضیحات:</span></div></div>
                            <textarea class="form-control" name="problem_details">{{ old('problem_details') }}</textarea>
                        </div>

                        <!-- participants -->
                        <div class="col-12 form-group input-group">
                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">قطعات همراه:</span></div></div>
                            <textarea class="form-control" name="participants">{{ old('participants') }}</textarea>
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
    </div>
@endsection