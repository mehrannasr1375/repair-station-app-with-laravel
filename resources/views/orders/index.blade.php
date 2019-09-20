@extends('layouts.app')
@section('page','تاریخچه کلی')
@section('content')



    <!-- search bar -------------------------------------------------------------------------------------------------------------------------------------------------->
    @include('common.searchbar')



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
            <th style="width:50px">تحویل</th>
            <th style="width:80px">وضعیت بدهی</th>
            <th style="width:50px">حذف</th>
        </tr>
        <tr>
            <td>0</td>
            <td>نام تست</td>
            <td>دستگاه تست</td>
            <td>عیب تست</td>
            <td><a href="/orders/1111/edit"><i class="fa fa-2x text-secondary fa-info pl-2"></i></a></td>
            <td>تاریخ تست</td>
            <td style="font-size:20px !important;"><i class='fa fa-refresh text-info'></i></td>
            <td style="font-size:20px !important;"><i class='fa fa-check text-success'></i></td>
            <td style="width:100px;">بد</td>
            <td><button type="submit" class="btn-delete-order btn-border-less" ></button></td>
        </tr>
        @foreach ($orders as $order)
            <tr>
                <td style="width:30px !important;" class="text-right">{{ $order->id }}</td>
                <td>{{ $order->customer->name }}</td>
                <td>{{ $order->device_type }}</td>
                <td style="max-width:150px; padding:14px;">{{ $order->problem }}</td>
                <td><a href="/orders/{{ $order->id }}/edit"><i class="fa fa-2x text-secondary fa-info pl-2"></i></a></td>
                <td style="width:80px;">{{ new Verta($order->receive_date) }}</td>
                <td>
                    <?php
                        if      ( $order->status_code == 'تعمیر شده' )         echo "<i class='fa fa-check text-success'></i>";
                        else if ( $order->status_code == 'در حال تعمیر' )      echo "<i class='fa fa-refresh text-info'></i>";
                        else if ( $order->status_code == 'تعمیر نمی شود' )     echo "<i class='fa fa-close text-danger'></i>";
                        else if ( $order->status_code == 'انصراف مشتری' )     echo "<i class='fa fa-eye-slash text-black-50'></i>";
                        else if ( $order->status_code == 'ایراد ندارد' )         echo "<i class='fa fa-heartbeat text-success'></i>";
                    ?>
                </td>
                <td>
                    <?php
                        if ( $order->checkout )   echo "<i class='fa fa-plane text-success'></i>";
                        else                      echo " - ";
                    ?>
                </td>
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
            {{ $orders->links() }}
        </div>
    </div>



    <!-- Btn New Order ----------------------------------------------------------------------------------------------------------------------------------------------->
    <div class="row">
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

    </section>




    <!-- Modals Scripts -------------------------------------------------------------------------------------------------------------------------------------------->
    <script type="text/javascript">
        $(window).on('load', function() {


            //add click event listeners for show modals && get 'order_id'
            $(".btn-delete-order").click(function (event) {
                order_id = $(this).parent().siblings('td:first-child').text();
                $("#modal_confirm_delete").modal('show');
            });


            //on confirm modal
            $(".btn_confirm").click(function (event) {
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
            });


        });
    </script>
    <!-------------------------------------------------------------------------------------------------------------------------------------------------------------->




@endsection
