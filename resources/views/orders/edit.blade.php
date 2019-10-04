@extends('layouts.frame')
@section('page','ویرایش تعمیری')
@section('content')



    <!-- Messages -------------------------------------------------------------------------------------------------------------------------------->
    <span class="row mt-6">
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
    <span class="row mt-3">
        <span class="col">
            @if ( session()->has('success_res') )
                <div class="alert alert-success">
                    {{ session()->get('success_res') }}
                </div>
            @endif
        </span>
    </span>



    <!-- Form ------------------------------------------------------------------------------------------------------------------------------------>
    <div class="form-box">
        <form action="/orders/{{ $order->id }}" method="POST">
        @csrf
        @method('PATCH')



        <!-- Customer details -->
        <div class="con">
            <div><p class="mb-0"><i class="fa fa-user"></i> مشخصات مشتری :</p></div>
            <div class="tab-content tbl-main-con">


                <!-- Tiny btns (new or existing customer) -->
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


                <!-- Customer Details -->
                <div class="tab-content">


                    <!-- NEW CUSTOMER FIELDS -->
                    <div id="new-customer" class="tab-pane">
                        <div class="row">
                            <!-- new customer name -->
                            <div class="col-12 col-lg-6 form-group input-group">
                                <div class="input-group-prepend"><div class="input-group-text"><span class="label">نام و نام خانوادگی :</span></div></div>
                                <input type="text" class="form-control border-fix" name="name"  value="{{ old('name') }}" autocomplete="off" />
                            </div>
                            <!-- new customer is_partner -->
                            <div id="chk_is_partner" class="col-6 col-lg-2 form-group input-group">
                                <div class="input-group-prepend"><div class="input-group-text"><input type="checkbox" name="is_partner" value="1" {{ old('is_partner') ?'checked':'' }}/></div>
                                </div>
                                <div class="input-group-append"><div class="input-group-text label bg-white">همکار</div></div>
                            </div>
                            <!-- new customer id -->
                            <div class="col-6 col-lg-4 form-group input-group">
                                <div class="input-group-prepend"><div class="input-group-text"><span class="label">شناسه مشتری:</span></div></div>
                                <input type="text" class="form-control font-weight-bold text-danger" name="new_customer_serial" disabled />
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
                                <input type="text" class="form-control" name="address" value="{{ old('address') }}" />
                            </div>
                        </div>
                    </div>


                    <!-- EXISTING CUSTOMER FIELDS -->
                    <div id="existing-customer" class="tab-pane active">
                        <div class="row">
                            <!-- existing customer name -->
                            <div class="col-12 col-lg-8 form-group input-group">
                                <div class="input-group-prepend"><div class="input-group-text"><span class="label">نام و نام خانوادگی :</span></div></div>
                                <input type="text" id="txt_old_name" class="form-control border-fix" name="old_name" value="{{ old('old_name') ?? $order->customer->name }}" autocomplete="off" />
                            </div>
                            <!-- existing customer id -->
                            <div class="col-12 col-lg-4 form-group input-group">
                                <div class="input-group-prepend"><div class="input-group-text"><span class="label">شناسه مشتری:</span></div></div>
                                <input type="text" id="txt_old_id" class="form-control text-center font-weight-bold text-danger" name="old_customer_id" value="{{ old('old_customer_id') ?? $order->customer_id }}" autocomplete="off"  />
                            </div>
                            <!-- available customers via ajax -->
                            <div class="col-12" id="link-customer-con">
                                <!-- contents will create here with ajax -->
                            </div>
                        </div>
                    </div>


                </div>


            </div>
        </div>



        <!-- Order details -->
        <div class="con">
            <div><p class="mb-0"><i class="fa fa-microchip"></i> مشخصات قطعه :</p></div>
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
                <!-- receive_date -->
                <div class="col-12 col-lg-4 form-group input-group mr-auto">
                        <div class="input-group-prepend"><div class="input-group-text"><span class="label">تاریخ:</span></div></div>
                        <input type="text" class="form-control text-center" name="receive_date" value="{{ old('receive_date') ?? Verta::persianNumbers($order->receive_date) }}" autocomplete="off" />
                    </div>
                <!-- device_brand -->
                <div class="col-12 col-lg-3 form-group input-group">
                        <div class="input-group-prepend"><div class="input-group-text"><span class="label">برند:</span></div></div>
                        <input type="text" class="form-control" name="device_brand" value="{{ old('device_brand') ?? $order->device_brand }}" autocomplete="off" />
                    </div>
                <!-- device_model -->
                <div class="col-12 col-lg-3 form-group input-group">
                        <div class="input-group-prepend"><div class="input-group-text"><span class="label">مدل:</span></div></div>
                        <input type="text" class="form-control" name="device_model" value="{{ old('device_model') ?? $order->device_model }}" autocomplete="off" />
                    </div>
                <!-- opened_earlier -->
                <div id="chk_is_repaired" class="col-12 col-lg-3 form-group input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <input type="checkbox" name="opened_earlier" {{ $order->opened_earlier==true ? 'checked':'' }} />
                            </div>
                        </div>
                        <div class="input-group-append"><div class="input-group-text label bg-white">قبلا تعمیر شده</div></div>
                    </div>
                <!-- order_id -->
                <div class="col-12 col-lg-3 form-group input-group">
                        <div class="input-group-prepend"><div class="input-group-text"><span class="label">شناسه فاکتور:</span></div></div>
                        <input type="text" class="form-control text-center font-weight-bold text-danger" name="order_id" value="{{ $order->id }}" disabled />
                    </div>
                <!-- problem -->
                <div class="col-12 form-group input-group">
                        <div class="input-group-prepend"><div class="input-group-text"><span class="label">ایراد:</span></div></div>
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
            </div>
        </div>



        <!-- Repair-details -->
        <div id="repair-details-con" class="con">
                <div><p class="mb-0"><i class="fa fa-info"></i> جزئیات تعمیری : </p></div>
                @foreach ($order_details as $order_detail)
                    <div class="row">
                        <div class="col-12 col-lg-4 mb-2">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-vsm"> عنوان : </span>
                                </div>
                                <input type="text" class="form-control form-control-sm" value="{{ $order_detail->key }}" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </div>
                        <div class="col-12 col-lg-4 mb-2">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-vsm"> هزینه مشتری : </span>
                                </div>
                                <input type="text" class="form-control form-control-sm" value="{{ $order_detail->user_amount }}" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </div>
                        <div class="col-12 col-lg-4 mb-2">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-vsm"> هزینه تعمیرگاه : </span>
                                </div>
                                <input type="text" class="form-control form-control-sm" value="{{ $order_detail->shop_amount }}" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </div>
                    </div>
                    <hr class="mt-0 mb-2">

                @endforeach

                <div class="d-flex justify-content-end">
                    <p class="mb-0 p-2 text-vsm">
                        جمع کل :
                        <span class="font-weight-bold">
                                {{ $order->should_pay }}
                            </span>
                        تومان
                    </p>
                </div>

        </div>



        <!-- Payments -->
        <div id="payment-details-con" class="con">
                <div><p class="mb-0"><i class="fa fa-paypal"></i> پرداختی ها : </p></div>
                @foreach ($payments as $payment)
                    <div class="row">
                        <div class="col-12 col-lg-4 mb-2">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-vsm"> مبلغ : </span>
                                </div>
                                <input type="text" class="form-control form-control-sm" value="{{ $payment->amount }}" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </div>
                        <div class="col-12 col-lg-4 mb-2">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-vsm"> نوع پرداخت : </span>
                                </div>
                                <input type="text" class="form-control form-control-sm" value="{{ $payment->payment_type }}" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </div>
                        <div class="col-12 col-lg-4 mb-2">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-vsm"> تاریخ پرداخت : </span>
                                </div>
                                <input type="text" class="form-control form-control-sm text-center text-vsm" value="{{ Verta::persianNumbers($payment->date) }}" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </div>
                    </div>
                    <hr class="mt-0 mb-2">
                @endforeach

                <div class="d-flex justify-content-end">
                    <p class="mb-0 p-2 text-vsm">
                        جمع کل :
                        <span class="font-weight-bold">
                                {{ $order->paid }}
                            </span>
                        تومان
                    </p>
                </div>


        </div>



        <!-- Btn save -->
        <div class="d-flex justify-content-center mb-5">
                <div class="">
                    <button class="btn btn-bordered" type="submit" name="btn-submit-order" > ذخیره <i class="fa fa-check"></i></button>
                </div>
        </div>



        </form>
    </div>



    <!-- Scripts --------------------------------------------------------------------------------------------------------------------------------->
    <script type="text/javascript">
        $(window).on('load', function() {


            // UI
            $("#chk_is_partner").click(function (event) {
                $('input[type=checkbox][name=is_partner]').click();
            });
            $("#chk_is_repaired").click(function (event) {
                $('input[type=checkbox][name=opened_earlier]').click();
            });


            // uses in two bottom blocks :
            let res_container   =   $('#link-customer-con');
            let txt_name        =   $("#txt_old_name");
            let txt_id          =   $("#txt_old_id");


            // get customer by id
            txt_id.on('keyup', function(event){
                txt_name.css('color', 'red').val('');
                $.ajax({
                    url:"/orders/get",
                    method:"POST",
                    data:{
                        '_token' : "<?php echo csrf_token() ?>",
                        'type':'id',
                        'id' : $(this).val(),
                    },
                    success:function (data) {
                        if ( data !== 'false' ) {
                            txt_id.css('color', 'green');
                            let customer_name = JSON.parse(data).name;
                            txt_name.css('color', 'green').val(customer_name);
                        } else {
                            txt_id.css('color', 'red');
                            txt_name.css('color', 'red').val();
                        }
                    },
                    error: function(){
                        txt_id.css('color', 'red');
                        txt_name.css('color', 'red').val('');
                    }
                });
            });


            // get customers by name
            txt_name.on('keyup', function(event){
                txt_id.css('color', 'red').val('');
                $.ajax({
                    url:"/orders/get",
                    method:"POST",
                    data:{
                        '_token' : "<?php echo csrf_token() ?>",
                        'type':'name',
                        'name' : $(this).val(),
                    },
                    success:function (data) {
                        if ( data !== 'false' ) {
                            let res = JSON.parse(data);
                            res_container.html('')
                            for ( let i=0 ; i<res.length ; i++ ) {
                                res_container.append('<span class="link-customer" data-name="' + res[i].name + '" data-id="' + res[i].id + '">' + res[i].name + '</span>\n');
                            }
                            res_container.show();
                            txt_name.css('color', 'green');
                        } else {
                            res_container.html('');
                            txt_name.css('color', 'red');
                        }
                    }
                });
            });


            // set customer_id for clicking result links
            res_container.on('click', '.link-customer', function(event) {
                txt_id.css('color', 'green').val($(event.target).data('id'));
                txt_name.css('color', 'green').val($(event.target).data('name'));
                res_container.hide();
            })


        });
    </script>



@endsection
