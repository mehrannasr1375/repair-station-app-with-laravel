@extends('layouts.app')
@section('page','قطعات آماده تحویل')
@section('content')



    <!-- search bar -->
    @include('common.searchbar')



    <!-- Prepaired Orders -->
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
                    <td><a href=""><i class="fa fa-2x text-success fa-pencil-square-o"></i></a></td>
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



    <!-- Modals -->
    <section id="prepaired-modals-con">

        <div id="modal_confirm_checkout_order" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <span>اخطار</span>
                        <i class="fa fa-1x fa-info-circle text-info ml-2"></i>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p class="px-2 mb-0 text-dark" style="display: inline-block">
                            آیا مایل به تحویل تعمیری می باشید؟
                        </p>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" id="btn_cancel" class="btn btn-sm btn-secondary" data-dismiss="modal">انصراف</button>
                        <button type="button" data-type="checkout" class="btn_confirm btn btn-sm btn-primary">بله</button>
                    </div>
                </div>
            </div>
        </div>

    </section>



    <!-- Modals Scripts -->
    <script type="text/javascript">

        $(window).on('load', function() {

            $(".btn_checkout").click(function (event) {
                order_id = $(this).parent().siblings('td:first-child').text();
                $("#modal_confirm_checkout_order").modal('show');
            });

            $(".btn_confirm").click(function (event)
            {
                $.ajax({
                    url:'/prepaired/checkout',
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
