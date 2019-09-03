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
                    <td style="width:40px;"><a href=""><i class="fa fa-2x text-secondary fa-pencil-square-o"></i></a></td>
                    <td style="width:200px;">
                        <a href="#" class=""><i class="fa fa-2x text-success fa-check pl-2"></i></a>
                        <a href="#" class="btn_unrepairable_order"><i class="fa fa-2x text-danger fa-close pl-2"></i></a>
                        <a href="#" class="btn_well_order"><i class="fa fa-2x text-success fa-heartbeat pl-2"></i></a>
                        <a href="#" class="btn-putoff_order"><i class="fa fa-2x text-warning fa-eye-slash"></i></a>
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
    <section id="repairing-modal-con">
        <div id="modal_confirm_well_order" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">
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
                        <button type="button" id="btn_confirm" data-type="well_order" class="btn btn-sm btn-primary">بله</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="modal_confirm_unrepairable_order" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">
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
                        <button type="button" id="btn_confirm" data-type="unrepairable" class="btn btn-sm btn-primary">بله</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="modal_confirm_putoff_order" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">
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
                        <button type="button" id="btn_confirm" data-type="putoff" class="btn btn-sm btn-primary">بله</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Scripts -->
        <script type="text/javascript">
            $(window).on('load',function()
            {

                $(".btn_well_order").click(function (event) {
                    order_id = $(this).parent().siblings('td:first-child').text();
                    $("#modal_confirm_well_order").modal('show');
                });

                $(".btn_unrepairable_order").click(function (event) {
                    order_id = $(this).parent().siblings('td:first-child').text();
                    $("#modal_confirm_unrepairable_order").modal('show');
                });

                $(".btn_unrepairable_order").click(function (event) {
                    order_id = $(this).parent().siblings('td:first-child').text();
                    $("#modal_confirm_putoff_order").modal('show');
                });

                $("#btn_confirm").click(function (event)
                {
                    switch ( $(this).data('type') ) {
                        case 'well_order':
                                $.ajax({
                                    url:"/repairing/healthy",
                                    //dataType: "json",
                                    method:"POST",
                                    data:{
                                        '_token' : '<?php echo csrf_token() ?>',
                                        'order_id' : order_id
                                    },
                                    success:function (data) {
                                        if ($.isNumeric(data['order_id'])) { // send deleted order_id
                                            //location.reload();
                                            /*reseived = JSON.parse(data);
                                            id = data[0].order_id;
                                            console.log('success result. updated order = '+id);*/
                                            console.log('success result');
                                            //location.reload();
                                        }
                                        else {
                                            console.log('error : '+data);
                                        }
                                    }
                                });
                                break;
                        case 'unrepairable':
                                $.ajax({});
                                break;
                        case 'putoff':
                            $.ajax({});
                            break;
                        default:
                                console.log('btn_confirm type not allowed!');
                                break;
                    }
                });
            });
        </script>
    </section>
































@endsection
