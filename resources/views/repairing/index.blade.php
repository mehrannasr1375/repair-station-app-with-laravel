@extends('layouts.app')
@section('page','قطعات در حال تعمیر')
@section('content')



    <!-- search bar -->
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
                        <a href="#" class="btn_unrepairable_order"><i class="fa fa-2x text-success fa-check pl-2"></i></a>
                        <a href="#" class=""><i class="fa fa-2x text-danger fa-close pl-2"></i></a>
                        <a href="#" class="btn_well_order"><i class="fa fa-2x text-success fa-heartbeat pl-2"></i></a>
                        <a href="#" class=""><i class="fa fa-2x text-warning fa-eye-slash"></i></a>
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



    <!-- Modal -->
    <section>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_confirm_repairing">Launch modal</button>
        <div class="modal fade" id="modal_confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">اخطار</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        آیا وضعیت دستگاه شماره<p class="px-2 mb-0 text-primary" style="display: inline-block"></p>به سالم تغییر یابد؟

                        <form id="frm_well_order" action="/repairing/healthy" method="POST">
                            @csrf
                            <input type="hidden" id="hidden_order_id" name="hidden_order_id" value="">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">انصراف</button>
                        <button type="button" id="btn_confirm_delivery" class="btn btn-sm btn-primary">بله</button>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(window).on('load',function(){
                $(".btn_well_order").click(function (event) {
                    modal = $("#modal_confirm");
                    order_id = $(this).parent().siblings('td:first-child').text();
                    modal.modal('show').find("#hidden_order_id").val(order_id);
                    modal.find('p').text(order_id);
                });

                $("#btn_confirm_delivery").click(function (event) {
                    $.ajax({
                        url:"/repairing/healthy",
                        method:"POST",
                        data:{
                            '_token' : '<?php echo csrf_token() ?>',
                            'hidden_order_id' : order_id
                        },
                        success:function (data) {
                            if (data == 'true') {
                                modal.modal('hide');
                                console.log('saved!');
                            }
                        }
                    });
                });
            });
        </script>

    </section>



@endsection
