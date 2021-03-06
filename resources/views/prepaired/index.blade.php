@extends('layouts.frame')
@section('page','قطعات آماده تحویل')
@section('content')



    <!-- Customize Paginator ----------------------------------------------------------------------------------------------------------------------------------------->
    <div class="row p-2 mb-4 bg-light shadow-sm">
        <div class="col-12 col-lg-3 offset-lg-9 input-group input-group-sm p-2">
            <div class="input-group-prepend"><div class="input-group-text text-black-50 text-vsm"><span class="label font-weight-bold">تعداد در صفحه : </span></div></div>
            <input type="text" id="txt_paginator" class="form-control form-control-sm text-vsm text-center" placeholder="تعداد در صفحه" value="{{ $count }}"/>
            <div class="input-group-append">
                <button id="customize-paginator" class="btn btn-bordered text-vsm text-black-50" type="button">اعمال</button>
            </div>
        </div>
    </div>



    <!-- Prepaired Orders ----------------------------------------------------------------------------------------------------------------------------------------->
    <div class="tbl-main-con">

        <!-- Table -->
        <table class="tbl-1">
            <tr>
                <th style="width:40px">شناسه</th>
                <th>نام و نام خانوادگی</th>
                <th>نوع دستگاه</th>
                <th>عیب</th>
                <th style="width:60px">جزئیات</th>
                <th style="width:60px">یادداشت</th>
                <th style="width:60px">تحویل</th>
                <th style="width:60px">وضعیت</th>
                <th style="width:80px">تاریخ دریافت</th>
                <th>هزینه</th>
            </tr>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->customer->name }}</td>
                    <td>{{ $order->device_type }}</td>
                    <td style="max-width:180px; padding-top:14px; padding-bottom:14px;">{{ $order->problem }}</td>
                    <td><a href="/orders/{{ $order->id }}/edit"><i class="fa fa-2x fa-info text-info"></i></a></td>
                    <td><a href="#" class="btn_add_note"><i class="fa fa-2x text-secondary fa-pencil-square-o"></i></a></td>
                    <td><a href="#" class="btn_checkout"><i class="fa fa-2x text-danger fa-external-link-square pl-2"></i></a></td>
                    <td style="width:90px;">
                        <?php
                        if      ( $order->status_code == 'تعمیر شده' )         echo "<i class='fa fa-check text-success'></i>";
                        else if ( $order->status_code == 'در حال تعمیر' )      echo "<i class='fa fa-refresh text-info'></i>";
                        else if ( $order->status_code == 'تعمیر نمی شود' )     echo "<i class='fa fa-close text-danger'></i>";
                        else if ( $order->status_code == 'انصراف مشتری' )     echo "<i class='fa fa-eye-slash text-black-50'></i>";
                        else if ( $order->status_code == 'ایراد ندارد' )         echo "<i class='fa fa-heartbeat text-success'></i>";
                        ?>
                    </td>
                    <td>{{ $order->receive_date ? new Verta($order->receive_date) : '-' }}</td>
                    <td class="cost-separate">{{ $order->total_cost }}</td>
                </tr>
            @endforeach
        </table>

        <!-- Pagination -->
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                {{ $orders->onEachSide(2)->links() }}
            </div>
        </div>

    </div>



    <!-- Modals --------------------------------------------------------------------------------------------------------------------------------------------------->
    <section id="prepaired-modals-con">


        <!-- modal checkout_order -->
        <div id="modal_confirm_checkout_order" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <span>تحویل تعمیری</span>
                        <i class="fa fa-credit-card"></i>
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
                        <button type="button" data-type="checkout" class="btn_confirm btn btn-sm btn-primary">بله</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- modal add_note -->
        <div id="modal_add_note" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <span>افزودن یادداشت برای تعمیری</span>
                        <i class="fa fa-pencil"></i>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="form-group input-group">
                            <div class="input-group-prepend"><div class="input-group-text"><span class="label">توضیحات:</span></div></div>
                            <textarea style="height:160px;" class="form-control" id='txt_note' name="note"></textarea>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" id="btn_cancel" class="btn btn-sm btn-secondary" data-dismiss="modal">انصراف</button>
                        <button type="button" data-type="add_note" class="btn_confirm btn btn-sm btn-primary">ثبت</button>
                    </div>
                </div>
            </div>
        </div>


    </section>



    <!-- Modals Scripts ------------------------------------------------------------------------------------------------------------------------------------------->
    <script type="text/javascript">
        $(window).on('load', function() {



            // add click event listeners for show modals && get 'order_id'
            $(".btn_add_note").click(function (event) {
                order_id = $(this).parent().siblings('td:first-child').text();
                $("#modal_add_note").modal('show');
            });
            $(".btn_checkout").click(function (event) {
                order_id = $(this).parent().siblings('td:first-child').text();
                let modal = $("#modal_confirm_checkout_order");
                modal.find('input').val('');
                modal.modal('show');
            });



            // on confirm modal => send ajax request, and retreive response & take convenient action
            $(".btn_confirm").click(function (event) {


                // checkout order
                if ( $(this).data('type') == 'checkout' )
                {
                    var i = 0;
                    var payments_array = [];
                    $('.payment_amount').each(function(event) {
                        payments_array[i] = [];
                        payments_array[i][0] = $(this).val();
                        payments_array[i][1] = $(this).parent().siblings('.d-flex').find('.payment_type').val();
                        i++;
                    });
                    console.log(payments_array);
                    $.ajax({
                        url:'/prepaired/checkout',
                        method:"POST",
                        data:{
                            '_token' : '<?php echo csrf_token() ?>',
                            'order_id' : order_id,
                            'array' : payments_array
                        },
                        success:function (data) {
                            if ($.isNumeric(data)) {
                                $(event.target).closest('.modal').modal('hide'); //hide modal
                                $(".tbl-1 td").filter(function() { //hide deleted table row from view
                                    return $(this).text() == order_id;
                                }).closest("tr").css('background-color', 'red').hide(1000);
                                console.log('saved!')
                            } else
                                console.log('error : ' + data);
                        }
                    });
                }


                // add delivery_note
                else if ( $(this).data('type') == 'add_note' )
                {
                    note = $('#txt_note').val();
                    $.ajax({
                        url:'/prepaired/addnote',
                        method:"POST",
                        data:{
                            '_token' : '<?php echo csrf_token() ?>',
                            'order_id' : order_id,
                            'note' : note
                        },
                        success:function (data) {
                            errors_array = $.parseJSON(JSON.stringify(data));
                            if ( data=='true' )
                                $(event.target).closest('.modal').modal('hide');
                            else
                                console.log('error : ' + errors_array['errors']);
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



            // customize paginator
            $("#customize-paginator").click(function (event) {
                document.location.href = "/prepaired/count/" + $(this).parent().siblings().closest('input').val();
            });



        });
    </script>
    <!------------------------------------------------------------------------------------------------------------------------------------------------------------->



@endsection
