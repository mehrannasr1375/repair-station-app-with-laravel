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


        <!-- Customize Modal -->
        @extends('modals.modal')
        @section('modal_title', 'اخطار')
        @section('modal_form_action_url', '/repairing/healthy')
        @section('modal_content_data', '')
        @section('btn_confirm_type', 'well_order')


        <!-- Modal Scripts -->
        <script type="text/javascript">

            $(window).on('load',function()
            {
                $(".btn_well_order").click(function (event)
                {
                    modal = $("#modal_confirm");
                    order_id = $(this).parent().siblings('td:first-child').text();
                    modal.modal('show');
                    modal.find('p').text(order_id);
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
                        default:
                                console.log('btn_confirm type not allowed!');
                                break;
                    }
                });
            });

        </script>


    </section>
































@endsection
