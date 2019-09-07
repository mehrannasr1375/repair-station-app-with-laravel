@extends('layouts.app')
@section('page','قطعات در حال تعمیر')
@section('content')




    <!-- Search Bar -->
    @include('common.searchbar')




    <!-- Repairing Orders -->
    <div class="tbl-main-con">
        <table class="tbl-1">
            <tr>
                <th style="width:40px">شناسه</th>
                <th>نام و نام خانوادگی</th>
                <th>نوع دستگاه</th>
                <th>عیب</th>
                <th style="width:60px">جزئیات</th>
                <th style="width:60px">یادداشت</th>
                <th style="width:60px">تغییر وضعیت</th>
                <th>تاریخ دریافت</th>
            </tr>
            <tr>
                <td>aaaaaaaa</td>
                <td>aaaaaaaa</td>
                <td>aaaaaaaa</td>
                <td>aaaaaaaaa</td>
                <td style="width:40px;"><a href="/orders/degrfsdafgd"><i class="fa fa-2x fa-info text-secondary"></i></a></td>
                <td style="width:40px;"><a class="btn_add_repairing_note" href="#"><i class="fa fa-2x text-secondary fa-pencil-square-o"></i></a></td>
                <td style="width:200px;">
                    <a href="#" class=""><i class="fa fa-2x text-success fa-check pl-2"></i></a>
                    <a href="#" class="btn_unrepairable_order"><i class="fa fa-2x text-danger fa-close pl-2"></i></a>
                    <a href="#" class="btn_well_order"><i class="fa fa-2x text-success fa-heartbeat pl-2"></i></a>
                    <a href="#" class="btn_putoff_order"><i class="fa fa-2x text-warning fa-eye-slash"></i></a>
                </td>
                <td style="width:100px;">sadfgdsfgf</td>
            </tr>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->customer->name }}</td>
                    <td>{{ $order->device_type }}</td>
                    <td>{{ $order->problem }}</td>
                    <td style="width:40px;"><a href="/orders/{{ $order->id }}"><i class="fa fa-2x fa-info text-secondary"></i></a></td>
                    <td style="width:40px;"><a class="btn_add_repairing_note" href="#"><i class="fa fa-2x text-secondary fa-pencil-square-o"></i></a></td>
                    <td style="width:200px;">
                        <a href="#" class="btn_repaired_order"><i class="fa fa-2x text-success fa-check pl-2"></i></a>
                        <a href="#" class="btn_unrepairable_order"><i class="fa fa-2x text-danger fa-close pl-2"></i></a>
                        <a href="#" class="btn_well_order"><i class="fa fa-2x text-success fa-heartbeat pl-2"></i></a>
                        <a href="#" class="btn_putoff_order"><i class="fa fa-2x text-warning fa-eye-slash"></i></a>
                    </td>
                    <td style="width:100px;">{{ $order->receive_date }}</td>
                </tr>
            @endforeach
        </table>
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                {{ $orders->links() }}
            </div>
        </div>
    </div>




    <!-- Modals -->
    <section id="repairing-modals-con">


        <!-- modal well_order -->
        <div id="modal_confirm_well_order" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <div id="modal_confirm_unrepairable_order" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <div id="modal_confirm_putoff_order" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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


        <!-- modal add_repairing_note_for_order -->
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
                        <p class="px-2 mb-4 text-dark" style="display: inline-block">
                            لطفا توضیحات خود درمورد تعمیری شماره
                            <span class="font-weight-bold" id="add_note_id_txt"></span>
                            را در کادر زیر تایپ نمایید:
                        </p>
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


        <!-- modal show result -->
        <div id="modal_show_result" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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


        <!-- modal modal_repaired_order -->
        <div id="modal_repaired_order" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <span>ثبت هزینه ی تعمیر</span>
                        <i class="fa fa-gears"></i>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        
                        <div class="d-flex justify-content-between">
                            <div class="d-flex">
                                <label style="line-height:2.2;padding-left:6px;" class="text-vsm" for="title">عنوان:</label>
                                <input type="text" style="min-width:240px;margin-left:20px;" id="title" class="form-control form-control-sm text-vsm" placeholder="">
                            </div>
                            <div class="d-flex">
                                <label style="line-height:2.2;padding-left:6px" class="text-vsm" for="price">هزینه:</label>
                                <input type="text" id="price" class="form-control form-control-sm text-center text-vsm" placeholder="به تومان">
                            </div>
                            <span class="d-flex justify-content-center mr-3 mt-1"><i id="add_row" class="fa fa-2x fa-plus-circle text-secondary"></i></span>
                        </div>
                        <hr class="">
                        <div class="d-flex justify-content-end mb-0">
                            <label style="line-height:2.2;padding-left:6px" class="text-vsm" for="price">جمع کل :</label>
                            <input type="text" id="price" class="form-control form-control-sm text-center"  style="width:140px;" >
                        </div>

                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer border-0 mt-3">
                        <button type="button" id="btn_cancel" class="btn btn-sm btn-secondary" data-dismiss="modal">انصراف</button>
                        <button type="button" data-type="unrepairable" class="btn_confirm btn btn-sm btn-primary">ثبت</button>
                    </div>
                </div>
            </div>
        </div>


    </section>




    <!-- Modals Scripts -->
    <script type="text/javascript">

        $(window).on('load', function() {



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
                $(".btn_add_repairing_note").click(function (event) {
                    order_id = $(this).parent().siblings('td:first-child').text();
                    $('#add_note_id_txt').text(order_id);
                    $("#modal_add_repairing_note").modal('show');
                });
                $(".btn_repaired_order").click(function (event) {
                    order_id = $(this).parent().siblings('td:first-child').text();
                    $("#modal_repaired_order").modal('show');
                });


                $(".btn_confirm").click(function (event) {

                    if ( $(this).data('type')=='add_repairing_note' ) {
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
                                    $(event.target).closest('.modal').modal('hide'); //hide modal
                                else
                                    console.log('error : ' + errors_array['errors']);
                            }
                        });
                    }

                    switch ( $(this).data('type') ) {
                        case 'well_order':
                            target_url = '/repairing/healthy';
                            break;
                        case 'unrepairable':
                            target_url = '/repairing/unrepairable';
                            break;
                        case 'putoff':
                            target_url = '/repairing/putoff';
                            break;
                        default:
                            target_url = '';
                            break;
                    }

                    $.ajax({
                        url:target_url,
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




                });



        });
    </script>

































@endsection
