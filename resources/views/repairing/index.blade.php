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
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->customer->name }}</td>
                    <td>{{ $order->device_type }}</td>
                    <td>{{ $order->problem }}</td>
                    <td style="width:40px;"><a href="/orders/{{ $order->id }}"><i class="fa fa-2x fa-info text-secondary"></i></a></td>
                    <td style="width:40px;"><a class="btn_add_repairing_note" href="#"><i class="fa fa-2x text-secondary fa-pencil-square-o"></i></a></td>
                    <td style="width:200px;">
                        <a href="#" class=""><i class="fa fa-2x text-success fa-check pl-2"></i></a>
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
                        <h6 class="modal-title">
                            <i class="fa fa-1x fa-info-circle text-info ml-2"></i>
                            اخطار
                        </h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p class="px-2 mb-0 text-dark" style="display: inline-block">
                            آیا وضعیت دستگاه به سالم تغییر یابد؟
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
                        <h6 class="modal-title">
                            <i class="fa fa-1x fa-info-circle text-info ml-2"></i>
                            اخطار
                        </h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p class="px-2 mb-0 text-dark" style="display: inline-block">
                            آیا مایل به تغییر وضعیت تعمیری به غیرقابل تعمیر می باشید؟
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
                        <h6 class="modal-title">
                            <i class="fa fa-1x fa-info-circle text-info ml-2"></i>
                            اخطار
                        </h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p class="px-2 mb-0 text-dark" style="display: inline-block">
                            آیا مایل به تغییر وضعیت تعمیری به انصراف مشتری می باشید؟
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
                        <h6 class="modal-title">
                            <i class="fa fa-1x fa-pencil text-info ml-2"></i>
                            افزودن یادداشت برای تعمیری
                        </h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p class="px-2 mb-4 text-dark" style="display: inline-block">
                            لطفا توضیحات خود درمورد تعمیری شماره
                            <span class="text-info" id="add_note_id_txt"></span>
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



                $(".btn_confirm").click(function (event) {


                    if ( $(this).data('type')=='add_repairing_note' ) {
                        note = $('#txt_note').val();
                        $.ajax({
                            url:'/repairing/addnote',
                            method:"POST",
                            data:{ '_token' : '<?php echo csrf_token() ?>', 'order_id' : order_id, 'note' : note },
                            success:function (data) {
                                if ( data=='true' )
                                    $(event.target).closest('.modal').modal('hide'); //hide modal
                                else
                                    console.log('error : ' + data);
                            }
                        });
                    }


                    switch ( $(this).data('type') ) {
                        case 'well_order':
                            target_url = '/repairing/healthy';
                            message = 'وضعیت دستگاه به سالم تغییر یافت!';
                            break;
                        case 'unrepairable':
                            target_url = '/repairing/unrepairable';
                            message = 'وضعیت دستگاه به غیر قابل تعمیر تغییر یافت!';
                            break;
                        case 'putoff':
                            target_url = '/repairing/putoff';
                            message = 'وضعیت دستگاه به انصراف مشتری تغییر یافت!';
                            break;
                        default:
                            message = '';
                            break;
                    }


                    $.ajax({
                        url:target_url,
                        method:"POST",
                        data:{ '_token' : '<?php echo csrf_token() ?>', 'order_id' : order_id },
                        success:function (data) {
                            if ($.isNumeric(data['order_id'])) {
                                $(event.target).closest('.modal').modal('hide'); //hide modal
                                $(".tbl-1 td").filter(function() { //hide deleted table row from view
                                    return $(this).text() == order_id;
                                }).closest("tr").hide(1000);
                            }
                            else
                                console.log('error : ' + data);
                        }
                    });




                });



        });
    </script>

































@endsection
