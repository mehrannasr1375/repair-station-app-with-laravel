@extends('layouts.frame')
@section('page','قطعات در حال تعمیر')
@section('content')



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



    <!-- Repairing Orders --------------------------------------------------------------------------------------------------------->
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
                <th style="width:60px">تغییر وضعیت</th>
                <th style="width:80px;">تاریخ دریافت</th>
            </tr>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->customer->name }}</td>
                    <td>{{ $order->device_type }}</td>
                    <td style="max-width:150px; padding:14px;">{{ $order->problem }}</td>
                    <td style="width:40px;"><a href="/orders/{{ $order->id }}/edit"><i class="fa fa-2x fa-info text-info"></i></a></td>
                    <td style="width:40px;"><a class="btn_add_delivery_note" href="#"><i class="fa fa-2x text-secondary fa-pencil-square-o"></i></a></td>
                    <td style="width:200px;">
                        <a href="#" class="btn_repaired_order"><i class="fa fa-2x text-success fa-check pl-2"></i></a>
                        <a href="#" class="btn_unrepairable_order"><i class="fa fa-2x text-danger fa-close pl-2"></i></a>
                        <a href="#" class="btn_well_order"><i class="fa fa-2x text-info fa-heartbeat pl-2"></i></a>
                        <a href="#" class="btn_putoff_order"><i class="fa fa-2x text-secondary fa-eye-slash"></i></a>
                    </td>
                    <td>{{ Verta::persianNumbers($order->receive_date) }}</td>
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



    <!-- Modals ------------------------------------------------------------------------------------------------------------------->
    <section id="repairing-modals-con">


        <!-- modal well_order -->
        <div id="modal_confirm_well_order" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <span>اخطار</span>
                        <i class="fa fa-question-circle-o"></i>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p class="px-2 mb-0 text-dark" style="display: inline-block">
                            آیا وضعیت دستگاه به <span class="font-weight-bold">سالم</span> تغییر یابد؟
                        </p>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" id="btn_cancel" class="btn btn-sm btn-secondary" data-dismiss="modal">انصراف</button>
                        <button type="button" data-type="well_order" class="btn_confirm btn btn-sm btn-primary">بله</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- modal unrepairable_order -->
        <div id="modal_confirm_unrepairable_order" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <span>اخطار</span>
                        <i class="fa fa-question-circle-o"></i>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p class="px-2 mb-0 text-dark" style="display: inline-block">
                            آیا مایل به تغییر وضعیت تعمیری به <span class="font-weight-bold">غیرقابل تعمیر</span> می باشید؟
                        </p>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" id="btn_cancel" class="btn btn-sm btn-secondary" data-dismiss="modal">انصراف</button>
                        <button type="button" data-type="unrepairable" class="btn_confirm btn btn-sm btn-primary">بله</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- modal putoff_order -->
        <div id="modal_confirm_putoff_order" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <span>اخطار</span>
                        <i class="fa fa-question-circle-o"></i>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p class="px-2 mb-0 text-dark" style="display: inline-block">
                            آیا مایل به تغییر وضعیت تعمیری به <span class="font-weight-bold">انصراف مشتری</span> می باشید؟
                        </p>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" id="btn_cancel" class="btn btn-sm btn-secondary" data-dismiss="modal">انصراف</button>
                        <button type="button" data-type="putoff" class="btn_confirm btn btn-sm btn-primary">بله</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- modal add delivery_note -->
        <div id="modal_add_delivery_note" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <button type="button" data-type="add_delivery_note" class="btn_confirm btn btn-sm btn-primary">ثبت</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- modal show result -->
        <div id="modal_show_result" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <span>اطلاعات</span>
                        <i class="fa fa-info-circle text-danger"></i>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p class="px-2 mb-0 text-dark" style="display: inline-block"></p>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" id="btn_cancel" class="btn btn-sm btn-secondary" data-dismiss="modal">باشه</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- modal repaired_order -->
        <div id="modal_repaired_order" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <span> ثبت هزینه ی تعمیر با شناسه <span id="modal-repaired-order-id"></span></span>
                        <i class="fa fa-check"></i>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">

                        <div id="add_repair_rows_con">
                            <div class="modal-body-row d-flex justify-content-between shadow-sm">
                                <div class="d-flex">
                                    <label for="title">عنوان:</label>
                                    <input type="text" name="cost_title" class="cost_title form-control form-control-sm text-vsm">
                                </div>
                                <div class="d-flex">
                                    <label for="user_price">هزینه مشتری:</label>
                                    <input type="text" name="cost_user" id="user_price" class="cost_user numericOnly form-control form-control-sm text-center text-vsm" placeholder="به تومان" >
                                </div>
                                <div class="d-flex">
                                    <label for="shop_price">هزینه تعمیرگاه:</label>
                                    <input type="text" name="cost_shop" id="shop_price" class="cost_shop numericOnly form-control form-control-sm text-center text-vsm" placeholder="به تومان" >
                                </div>
                            </div>
                        </div>

                        <span class="add_row d-flex justify-content-center my-3"><i id="add_row" class="fa fa-2x fa-plus-circle text-secondary"></i></span>

                        <hr>

                        <div class="d-flex justify-content-end mb-0">
                            <label style="line-height:2.2;padding-left:6px" class="text-vsm" for="price">جمع کل :</label>
                            <input style="width:140px;border:none !important; " type="text" id="price" class="form-control form-control-sm text-center" value="0" disabled >
                            <span style="line-height:3;padding-right:6px" class="text-vvsm">تومان</span>
                        </div>

                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer border-0 mt-3">
                        <button type="button" id="btn_cancel" class="btn btn-sm btn-secondary" data-dismiss="modal">انصراف</button>
                        <button type="button" data-type="repaired" class="btn_confirm btn btn-sm btn-primary">ثبت</button>
                    </div>
                </div>
            </div>
        </div>


    </section>



    <!-- Scripts ---------------------------------------------------------------------------------------------------------------------------->
    <script type="text/javascript">
        $(window).on('load', function() {



            // add click event listeners for show modals && get 'order_id'
            $(".btn_well_order").click(function (event) {
                order_id = $(this).parent().siblings('td:first-child').text();
                $("#modal_confirm_well_order").modal('show');
            });
            $(".btn_unrepairable_order").click(function (event) {
                    order_id = $(this).parent().siblings('td:first-child').text();
                    $("#modal_confirm_unrepairable_order").modal('show');
                });
            $(".btn_putoff_order").click(function (event) {
                    order_id = $(this).parent().siblings('td:first-child').text();
                    $("#modal_confirm_putoff_order").modal('show');
                });
            $(".btn_add_delivery_note").click(function (event) {
                    order_id = $(this).parent().siblings('td:first-child').text();
                    $('#add_note_id_txt').text(order_id);
                    $("#modal_add_delivery_note").modal('show');
                });
            $(".btn_repaired_order").click(function (event) {
                    order_id = $(this).parent().siblings('td:first-child').text();
                    let modal = $("#modal_repaired_order");
                    modal.find('input').val('');
                    $("#modal-repaired-order-id").text(order_id);
                    modal.modal('show');
            });



            // on confirm modal => send ajax request, and retreive response & take convenient action
            $(".btn_confirm").click(function (event) {


                //add delivery_note
                if ( $(this).data('type')=='add_delivery_note' )
                {
                    note = $('#txt_note').val();
                    $.ajax({
                        url:'/repairing/addnote',
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


                //add repaired costs
                else if ( $(this).data('type')=='repaired' )
                {
                    var i = 0;
                    var order_datails_array = [];
                    $('.cost_title').each(function(event) {
                        if ( $(this).val() != '' ) {
                            order_datails_array[i] = [];
                            order_datails_array[i][0] = $(this).val();
                            order_datails_array[i][1] = $(this).parent().siblings('.d-flex').find('.cost_user').val();
                            order_datails_array[i][2] = $(this).parent().siblings('.d-flex').find('.cost_shop').val();
                            i++;
                        } else
                            console.log('empty fields');
                    });
                    console.log(order_datails_array);
                    $.ajax({
                        url :'/repairing/addrepaired',
                        method :'POST',
                        dataType : 'json',
                        data:{
                            '_token' : '<?php echo csrf_token() ?>',
                            'order_id' : order_id,
                            'array' : order_datails_array
                        },
                        success:function (data) {
                            if ( data === true ) {
                                $(event.target).closest('.modal').modal('hide'); //hide modal
                                $(".tbl-1 td").filter(function() { //hide deleted table row from view
                                    return $(this).text() == order_id;
                                }).closest("tr").css('background-color', 'red').hide(1000);
                                console.log('saved!')
                            }
                            else
                                console.log('error : ' + errors_array['errors']);
                        }
                    })
                }


                //well order
                else if ( $(this).data('type')=='well_order' )
                {
                    $.ajax({
                        url:'/repairing/healthy',
                        method:"POST",
                        data:{
                            '_token' : '<?php echo csrf_token() ?>',
                            'order_id' : order_id
                        },
                        success:function (data) {
                            errors_array = $.parseJSON(JSON.stringify(data));
                            modal_confirm = $(event.target).closest('.modal');
                            if ($.isNumeric(data)) {
                                modal_confirm.modal('hide'); //hide confirm modal
                                $(".tbl-1 td").filter(function() { //hide deleted table row from view
                                    return $(this).text() == order_id;
                                }).closest("tr").css('background-color','#0ea1a4').hide(1000);
                            }
                            else {
                                modal_confirm.modal('hide'); //hide confirm modal
                                modal_result = $('#modal_show_result');
                                modal_result.find('p').text(errors_array['errors']);
                                modal_result.modal('show'); //show result modal
                            }
                        }
                    });
                }


                //unrepairable
                else if ( $(this).data('type')=='unrepairable' )
                {
                    $.ajax({
                        url:'/repairing/unrepairable',
                        method:"POST",
                        data:{
                            '_token' : '<?php echo csrf_token() ?>',
                            'order_id' : order_id
                        },
                        success:function (data) {
                            errors_array = $.parseJSON(JSON.stringify(data));
                            modal_confirm = $(event.target).closest('.modal');
                            if ($.isNumeric(data)) {
                                modal_confirm.modal('hide'); //hide confirm modal
                                $(".tbl-1 td").filter(function() { //hide deleted table row from view
                                    return $(this).text() == order_id;
                                }).closest("tr").css('background-color','#0ea1a4').hide(1000);
                            }
                            else {
                                modal_confirm.modal('hide'); //hide confirm modal
                                modal_result = $('#modal_show_result');
                                modal_result.find('p').text(errors_array['errors']);
                                modal_result.modal('show'); //show result modal
                            }
                        }
                    });
                }


                //putoff
                else if ( $(this).data('type')=='putoff' )
                {
                    $.ajax({
                        url:'/repairing/putoff',
                        method:"POST",
                        data:{
                            '_token' : '<?php echo csrf_token() ?>',
                            'order_id' : order_id
                        },
                        success:function (data) {
                            errors_array = $.parseJSON(JSON.stringify(data));
                            modal_confirm = $(event.target).closest('.modal');
                            if ($.isNumeric(data)) {
                                modal_confirm.modal('hide'); //hide confirm modal
                                $(".tbl-1 td").filter(function() { //hide deleted table row from view
                                    return $(this).text() == order_id;
                                }).closest("tr").css('background-color','#0ea1a4').hide(1000);
                            }
                            else {
                                modal_confirm.modal('hide'); //hide confirm modal
                                modal_result = $('#modal_show_result');
                                modal_result.find('p').text(errors_array['errors']);
                                modal_result.modal('show'); //show result modal
                            }
                        }
                    });
                }


            });



            // btn plus 'order_detail' row
            $(".add_row").on('click', function(e) {
                elem = `<div class="modal-body-row shadow-sm d-flex justify-content-between">\n
                           <div class="d-flex">\n
                               <label for="title">عنوان:</label>\n
                               <input type="text" class="cost_title form-control form-control-sm text-vsm">\n
                           </div>\n
                           <div class="d-flex">\n
                               <label for="user_price">هزینه مشتری:</label>\n
                               <input type="text" id="user_price" class="cost_user numericOnly form-control form-control-sm text-center text-vsm" placeholder="به تومان" >\n
                           </div>\n
                           <div class="d-flex">\n
                               <label for="shop_price">هزینه تعمیرگاه:</label>\n
                               <input type="text" id="shop_price" class="cost_shop numericOnly form-control form-control-sm text-center text-vsm" placeholder="به تومان" >\n
                           </div>\n
                        </div>\n`;
                $("#add_repair_rows_con").append(elem);
            });



            // 'keyup' event listener
            $("#add_repair_rows_con").on('keyup', '.cost_user', function() { // Event Delegation
                let sum = 0;
                $('.cost_user').each(function() {
                    sum += Number($(this).val());
                });
                $('#price').val(sum);
            });



            //customize paginator
            $("#customize-paginator").click(function (event) {
                document.location.href = "/repairing/count/" + $(this).parent().siblings().closest('input').val();
            });



        });
    </script>
    <!---------------------------------------------------------------------------------------------------------------------------------------------->



@endsection
