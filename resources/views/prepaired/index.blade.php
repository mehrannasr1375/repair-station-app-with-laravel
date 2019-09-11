@extends('layouts.app')
@section('page','قطعات آماده تحویل')
@section('content')



    <!-- search bar ----------------------------------------------------------------------------------------------------------------------------------------------->
    @include('common.searchbar')




    <!-- Prepaired Orders ----------------------------------------------------------------------------------------------------------------------------------------->
    <div class="tbl-main-con">
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
                    <td><a href="/orders/{{ $order->id }}"><i class="fa fa-2x fa-info text-secondary"></i></a></td>
                    <td><a href="#" class="btn_add_note"><i class="fa fa-2x text-success fa-pencil-square-o"></i></a></td>
                    <td><a href="#" class="btn_checkout"><i class="fa fa-2x text-danger fa-plane pl-2"></i></a></td>
                    <td style="width:90px;">{{ $order->status_code }}</td>
                    <td>{{ $order->receive_date }}</td>
                    <td>sum</td>
                </tr>
            @endforeach
        </table>
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                {{ $orders->links() }}
            </div>
        </div>
    </div>




    <!-- Modals --------------------------------------------------------------------------------------------------------------------------------------------------->
    <section id="prepaired-modals-con">


        <!-- modal checkout_order -->
        <div id="modal_confirm_checkout_order" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <span>تحویل تعمیری</span>
                        <i class="fa fa-gears"></i>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">

                        <div id="add_repair_rows_con">
                            <div class="modal-body-row d-flex justify-content-between shadow-sm">
                                <div class="d-flex">
                                    <label for="payment_amount" style="width:100px;">مبلغ پرداختی:</label>
                                    <input type="text" id="payment_amount" name="payment_amount" class="cost_title form-control form-control-sm text-vsm">
                                </div>
                                <div class="d-flex">
                                    <label for="payment_type" style="width:120px;">نوع پرداخت:</label>
                                    <select id="payment_type" name="payment_type" class="custom-control form-control form-control-sm text-vvsm">
                                        <option value="">با کارتخوان</option>
                                        <option value="">نقد</option>
                                        <option value="">چک</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <span class="add_row d-flex justify-content-center my-3"><i id="add_row" class="fa fa-2x fa-plus-circle text-secondary"></i></span>

                        <hr>

                        <div class="d-flex justify-content-end mb-0">
                            <label style="line-height:2.2;padding-left:6px" class="text-vsm" for="price">جمع کل :</label>
                            <input style="width:140px;border:none !important; " type="text" id="price" class="form-control form-control-sm text-center" disabled >
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
        <div id="modal_add_repairing_note" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <button type="button" data-type="add_repairing_note" class="btn_confirm btn btn-sm btn-primary">ثبت</button>
                    </div>
                </div>
            </div>
        </div>


    </section>




    <!-- Modals Scripts ------------------------------------------------------------------------------------------------------------------------------------------->
    <script type="text/javascript">
        $(window).on('load', function() {



            //add click event listeners for show modals && get 'order_id'
            $(".btn_add_note").click(function (event) {
                order_id = $(this).parent().siblings('td:first-child').text();
                $("#modal_add_repairing_note").modal('show');
            });
            $(".btn_checkout").click(function (event) {
                order_id = $(this).parent().siblings('td:first-child').text();
                $("#modal_confirm_checkout_order").modal('show');
            });



            //on confirm modal => send ajax request, and retreive response & take convenient action)
            $(".btn_confirm").click(function (event)
            {


                $.ajax({
                    url:'/prepaired/checkout',
                    method:"POST",
                    data:{ 
                        '_token' : '<?php echo csrf_token() ?>',
                         'order_id' : order_id,
                         'array' : []
                    },
                    succ    ess:function (data) {
                        if ($.isNumeric(data)) {
                            $(event.target).closest('.modal').modal('hide'); //hide modal
                            $(".tbl-1 td").filter(function() { //hide deleted table row from view
                                return $(this).text() == order_id;
                            }).closest("tr").hide(1000);
                            console.log('saved!')
                        }
                        else
                            console.log('error : ' + data);
                    }
                });

            });



            //btn plus 'order_detail' row
            $(".add_row").click(function () {
                elem =  '<div id="add_repair_rows_con">\n' +
                        '    <div class="modal-body-row d-flex justify-content-between shadow-sm">\n' +
                        '        <div class="d-flex">\n' +
                        '            <label for="payment_amount" style="width:100px;">مبلغ پرداختی:</label>\n' +
                        '            <input type="text" id="payment_amount" name="payment_amount" class="cost_title form-control form-control-sm text-vsm">\n' +
                        '        </div>\n' +
                        '        <div class="d-flex">\n' +
                        '            <label for="payment_type" style="width:120px;">نوع پرداخت:</label>\n' +
                        '            <select id="payment_type" name="payment_type" class="custom-control form-control form-control-sm text-vvsm">\n' +
                        '                <option value="">با کارتخوان</option>\n' +
                        '                <option value="">نقد</option>\n' +
                        '                <option value="">چک</option>\n' +
                        '            </select>\n' +
                        '        </div>\n' +
                        '    </div>\n' +
                        '</div>';
                $("#add_repair_rows_con").append(elem);
            });


        });
    </script>
    <!------------------------------------------------------------------------------------------------------------------------------------------------------------->




@endsection
