@extends('layouts.frame')
@section('page','تاریخچه کلی')
@section('content')



    <!-- search bar -------------------------------------------------------------------------------------------------------------------------------------------------->
    @include('common.searchbar')



    <!-- Customize Paginator ----------------------------------------------------------------------------------------------------------------------------------------->
    <div class="row">
        <div class="col-12 col-md-3 offset-9 input-group input-group-sm mb-4 mt-2">
            <div class="input-group-prepend"><div class="input-group-text text-black-50 text-vsm"><span class="label">تعداد در صفحه : </span></div></div>
            <input type="text" id="txt_paginator" class="form-control form-control-sm text-vsm text-center" placeholder="تعداد در صفحه" value="{{ $count }}"/>
            <div class="input-group-append">
                <button id="customize-paginator" class="btn btn-bordered text-vsm text-black-50" type="button">اعمال</button>
            </div>
        </div>
    </div>



    <!-- Messages ---------------------------------------------------------------------------------------------------------------------------------------------------->
    @if ( session()->has('msg') )
        <div class="alert alert-success mb-0 mt-4">
            {{ session()->get('msg') }}
        </div>
    @endif



    <!-- List -------------------------------------------------------------------------------------------------------------------------------------------------------->
    <table class="tbl-1">
        <tr>
            <th style="width:40px;">شناسه</th>
            <th>نام و نام خانوادگی</th>
            <th>نوع دستگاه</th>
            <th>عیب</th>
            <th style="width:60px; margin-right:20px;">جزئیات</th>
            <th>تاریخ دریافت</th>
            <th style="width:60px">وضعیت</th>
            <th>افزودن پرداختی</th>
            <th style="width:80px">وضعیت بدهی</th>
            <th style="width:50px">حذف</th>
        </tr>
        @foreach ($orders as $order)
            <tr>
                <td style="width:30px !important;" class="text-right">{{ $order->id }}</td>
                <td>{{ $order->customer->name }}</td>
                <td>{{ $order->device_type }}</td>
                <td style="max-width:150px; padding:14px;">{{ $order->problem }}</td>
                <td><a href="/orders/{{ $order->id }}/edit"><i class="fa fa-2x text-secondary fa-info pl-2"></i></a></td>
                <td style="width:80px;">{{ $order->receive_date }}</td>
                <td>
                    <?php
                        if      ( $order->status_code == 'تعمیر شده' )         echo "<i class='fa fa-check text-success'></i>";
                        else if ( $order->status_code == 'در حال تعمیر' )      echo "<i class='fa fa-refresh text-info'></i>";
                        else if ( $order->status_code == 'تعمیر نمی شود' )     echo "<i class='fa fa-close text-danger'></i>";
                        else if ( $order->status_code == 'انصراف مشتری' )     echo "<i class='fa fa-eye-slash text-black-50'></i>";
                        else if ( $order->status_code == 'ایراد ندارد' )         echo "<i class='fa fa-heartbeat text-success'></i>";
                    ?>
                </td>
                <td><a href="#" class="btn_add_payment"><i class="fa fa-2x text-black-50 fa-credit-card pl-2"></i></a></td>
                <td>
                    <?php
                        if     ( $order->debt_status > 0 )   echo $order->debt_status . ' بد ';
                        elseif ( $order->debt_status < 0 )   echo str_replace('-', ' ', $order->debt_status) . ' بس ';
                        else                                 echo '-';
                    ?>
                </td>
                <td>
                    <button type="submit" class="btn-delete-order btn-border-less" ></button>
                </td>
            </tr>
        @endforeach
    </table>



    <!-- Pagination -------------------------------------------------------------------------------------------------------------------------------------------------->
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $orders->onEachSide(2)->links() }}
        </div>
    </div>



    <!-- Btn New Order ----------------------------------------------------------------------------------------------------------------------------------------------->
    <div class="row mb-5">
        <div class="col-12 d-flex justify-content-end">
            <a href="/orders/create" class="btn btn-bordered">سفارش جدید</a>
        </div>
    </div>



    <!-- Modals ----------------------------------------------------------------------------------------------------------------------------------------------------->
    <section>


        <!-- modal confirm delete row -->
        <div id="modal_confirm_delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <span>اخطار</span>
                        <i class="fa fa-warning text-danger"></i>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p>
                            رکورد به همراه تمامی وابستگی های آن به طور دائمی از دیتابیس حذف خواهد شد. آیا مطمئن هستید؟
                        </p>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" id="btn_cancel" class="btn btn-sm btn-secondary" data-dismiss="modal">انصراف</button>
                        <button type="button" data-type="delete-order" class="btn_confirm btn btn-sm btn-danger">بله، حذف کن</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- modal add_order_payment -->
        <div id="modal_add_order_payment" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <span>افزودن پرداختی</span>
                        <i class="fa fa-gears"></i>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">

                        <div id="add_repair_rows_con">
                            <div class="modal-body-row d-flex justify-content-between shadow-sm">
                                <div class="d-flex">
                                    <label for="payment_amount" style="width:110px;">مبلغ پرداختی:</label>
                                    <input type="text" id="payment_amount" name="payment_amount" class="payment_amount numericOnly form-control form-control-sm text-vsm">
                                </div>
                                <div class="d-flex">
                                    <label for="payment_type" style="width:70px;margin-right:20px;">نوع پرداخت:</label>
                                    <select id="payment_type"style="width:100px;" name="payment_type" class="payment_type custom-control form-control form-control-sm text-vvsm">
                                        <option value="با کارتخوان">با کارتخوان</option>
                                        <option value="نقد">نقد</option>
                                        <option value="چک">چک</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <span class="add_row d-flex justify-content-center my-3"><i id="add_row" class="fa fa-2x fa-plus-circle text-secondary"></i></span>

                        <hr>

                        <div class="d-flex justify-content-end mb-0">
                            <label style="line-height:2.2;padding-left:6px" class="text-vsm" for="price">جمع کل :</label>
                            <input style="width:140px;border:none !important; " type="text" id="price" class="form-control form-control-sm text-center" disabled >
                            <span style="line-height:3;padding-right:6px" class="text-vvsm">تومان</span>
                        </div>

                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" id="btn_cancel" class="btn btn-sm btn-secondary" data-dismiss="modal">انصراف</button>
                        <button type="button" data-type="add_payment" class="btn_confirm btn btn-sm btn-primary">ثبت</button>
                    </div>
                </div>
            </div>
        </div>


    </section>



    <!-- Modals Scripts --------------------------------------------------------------------------------------------------------------------------------------------->
    <script type="text/javascript">
        $(window).on('load', function() {



            //add click event listeners for show modals && get 'order_id'
            $(".btn-delete-order").click(function (event) {
                order_id = $(this).parent().siblings('td:first-child').text();
                $("#modal_confirm_delete").modal('show');
            });
            $(".btn_add_payment").click(function (event) {
                order_id = $(this).parent().siblings('td:first-child').text();
                //customer_name = $(this).parent().siblings('td:nth-child(2)').text();
                let modal = $("#modal_add_order_payment");
                modal.find('input').val('');
                //$("#span_customer_name").text(customer_name);
                modal.modal('show');
            });



            //on confirm modal
            $(".btn_confirm").click(function (event) {



                //delete order
                if ( $(this).data('type') == 'delete-order' )
                {
                    $.ajax({
                        url:'/orders/delete/' + order_id,
                        method:"POST",
                        data:{
                            '_token' : '<?php echo csrf_token() ?>',
                            'order_id' : order_id,
                        },
                        success:function (data) {
                            if ( data === 'true' ) {
                                $(event.target).closest('.modal').modal('hide'); //hide modal
                                $(".tbl-1 td").filter(function() { //hide deleted table row from view
                                    return $(this).text() == order_id;
                                }).closest("tr").css('background-color', '#d11761').hide(1000);
                                console.log('deleted!')
                            } else
                                console.log('error on delete order : ' + data);
                        }
                    });
                }



                //add payment
                else if ( $(this).data('type') == 'add_payment' )
                {
                    console.log('fired!');
                    var i = 0;
                    var payments_array = [];
                    $('.payment_amount').each(function(event) {
                        if ( $(this).val() != '' ) {
                            payments_array[i] = [];
                            payments_array[i][0] = $(this).val();
                            payments_array[i][1] = $(this).parent().siblings('.d-flex').find('.payment_type').val();
                            i++;
                        } else
                            console.log('empty fields');
                    });
                    console.log(payments_array);
                    $.ajax({
                        url:'/orders/addpayment',
                        method:"POST",
                        data:{
                            '_token' : '<?php echo csrf_token() ?>',
                            'order_id' : order_id,
                            'array' : payments_array
                        },
                        success:function (data) {
                            if (data == 'true' ) {
                                $(event.target).closest('.modal').modal('hide'); //hide modal
                                $(".tbl-1 td").filter(function() { //notice  updated table row from view
                                    return $(this).text() == order_id;
                                }).closest("tr").html('<td class="text-black-50 text-center" colspan=10>تغییرات ذخیره گردید. برای نمایش تغییرات اعمال شده در این رکورد صفحه را رفرش نمایید!</td>');
                                console.log('saved to DB!')
                            } else
                                console.log('error : ' + data);
                        }
                    });
                }



            });



            // btn plus 'order_detail' row
            $(".add_row").click(function () {
                elem =  `<div>\n
                            <div class="modal-body-row d-flex justify-content-between shadow-sm">\n
                                <div class="d-flex">\n
                                    <label for="payment_amount" style="width:110px;">مبلغ پرداختی:</label>\n
                                    <input type="text" id="payment_amount" name="payment_amount" class="payment_amount numericOnly form-control form-control-sm text-vsm">\n
                                </div>\n
                                <div class="d-flex">\n
                                    <label for="payment_type" style="width:70px;margin-right:20px;">نوع پرداخت:</label>\n
                                    <select id="payment_type"style="width:100px;" name="payment_type" class="payment_type custom-control form-control form-control-sm text-vvsm">\n
                                        <option value="با کارتخوان">با کارتخوان</option>\n
                                        <option value="نقد">نقد</option>\n
                                        <option value="چک">چک</option>\n
                                    </select>\n
                                </div>\n
                            </div>\n
                        </div>\n`;
                $("#add_repair_rows_con").append(elem);
            });



            // 'keyup' event listener
            $("#add_repair_rows_con").on('keyup', '.payment_amount', function() { // Event Delegation
                let sum = 0;
                $('.payment_amount').each(function() {
                    sum += Number($(this).val());
                });
                $('#price').val(sum);
            });



            //customize paginator
            $("#customize-paginator").click(function (event) {
                document.location.href = "/orders/count/" + $(this).parent().siblings().closest('input').val();
            });


        });
    </script>
    <!--------------------------------------------------------------------------------------------------------------------------------------------------------------->



@endsection
