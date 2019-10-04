@extends('layouts.frame')
@section('page','مشتریان')
@section('content')



    <!-- search bar ---------------------------------------------------------------------------------------------------------------------------------------------------------->
    @include('common.searchbar')



    <!-- Customize Paginator ------------------------------------------------------------------------------------------------------------------------------------------------->
    <div class="row">
        <div class="col-12 col-md-3 offset-9 input-group input-group-sm mb-4 mt-2">
            <div class="input-group-prepend"><div class="input-group-text text-black-50 text-vsm"><span class="label">تعداد در صفحه : </span></div></div>
            <input type="text" id="txt_paginator" class="form-control form-control-sm text-vsm text-center" placeholder="تعداد در صفحه" value="{{ $count }}"/>
            <div class="input-group-append">
                <button id="customize-paginator" class="btn btn-bordered text-vsm text-black-50" type="button">اعمال</button>
            </div>
        </div>
    </div>



    <!-- Tiny btns ----------------------------------------------------------------------------------------------------------------------------------------------------------->
    <div class="form-box pl-0 pr-2 mb-4">
        <ul class="nav nav-tabs nav-justified mt-4">
            <li class="nav-item {{ strpos(url()->current(), 'return/all') ? "active":"" }} ">
                <a href="/customers/return/all" class="nav-link {{ strpos(url()->current(), '/customers/return/all') ? "active":"" }} ">همه</a>
            </li>
            <li class="nav-item {{ strpos(url()->current(), 'return/partners') ? "active":"" }} ">
                <a href="/customers/return/partners" class="nav-link {{ strpos(url()->current(), '/customers/return/partners') ? "active":"" }} ">همکار</a>
            </li>
            <li class="nav-item {{ strpos(url()->current(), 'return/customers') ? "active":"" }} ">
                <a href="/customers/return/customers" class="nav-link {{ strpos(url()->current(), '/customers/return/customers') ? "active":"" }} ">مشتری</a>
            </li>
        </ul>
    </div>



    <!-- Customers container ---------------------------------------------------------------------------------------------------------------------------------------------------->
    <div class="tbl-main-con">
        <div id="normal">

            <!-- Table --->
            <table class="tbl-1">
                <tr>
                    <th style="width:60px;">شناسه مشتری</th>
                    <th>نام و نام خانوادگی</th>
                    <th>اطلاعات مشتری</th>
                    <th>لیست تمامی قطعات</th>
                    <th>قطعات موجود</th>
                    <th>قطعات آماده</th>
                    <th>صورت حساب</th>
                    <th>حذف مشتری</th>
                </tr>
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td><a href="/customers/{{ $customer->id }}/edit">{{ $customer->name }}</a></td>
                        <td><a href="/customers/{{ $customer->id }}"><i class="fa fa-2x text-secondary fa-info pl-2"></i></a></td>
                        <td><a href="/customers/{{ $customer->id }}/orders"><i class="fa fa-2x text-dark fa-microchip pl-2"></i></a></td>
                        <td>{{ $customer->available_orders_count == 0 ? "-":$customer->available_orders_count }}</td>
                        <td>{{ $customer->prepaired_orders_count == 0 ? "-":$customer->prepaired_orders_count }}</td>
                        <td><a href="/customers/{{ $customer->id }}/bills"><i class="fa fa-2x text-secondary fa-money pl-2"></i></a></td>
                        <td><a href="#" class="btn_delete_customer"><i class="fa fa-2x text-danger fa-close pl-2"></i></a></td>
                    </tr>
                @endforeach
            </table>

            <!-- Pagination -->
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    {{ $customers->onEachSide(2)->links() }}
                </div>
            </div>

        </div>
    </div>



    <!-- New Customer Btn ---------------------------------------------------------------------------------------------------------------------------------------------------->
    <div class="row my-5">
        <div class="col-12 d-flex justify-content-end">
            <a href="/customers/create" class="btn btn-bordered">مشتری جدید</a>
        </div>
    </div>



    <!-- Modals ------------------------------------------------------------------------------------------------------------------------------------------------------------------>
    <section id="customers-modals-con">

        <!-- modal delete_customer -->
        <div id="modal_delete_customer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <span>حذف مشتری</span>
                        <i class="fa fa-warning"></i>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="form-group input-group">
                            مشتری
                            <span class="text-danger px-2 font-weight-bold" id="span_customer_name"></span>
                            به همراه تمامی وابستگی هایش ( از جمله تعمیری ها پرداختی ها و ... ) حذف خواهد شد. آیا به حذف آن اطمینان دارید؟
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" id="btn_cancel" class="btn btn-sm btn-secondary" data-dismiss="modal">انصراف</button>
                        <button type="button" data-type="delete_customer" class="btn_confirm btn btn-sm btn-danger">بله</button>
                    </div>
                </div>
            </div>
        </div>

    </section>



    <!-- Scripts ---------------------------------------------------------------------------------------------------------------------------------------------------------->
    <script type="text/javascript">
        $(window).on('load', function() {



            // add click event listeners for show modals && get 'customer_id'
            $(".btn_delete_customer").click(function (event) {
                customer_id = $(this).parent().siblings('td:first-child').text();
                customer_name = $(this).parent().siblings('td:nth-child(2)').text();
                $("#span_customer_name").text(customer_name);
                $("#modal_delete_customer").modal('show');
            });



            // on confirm modal => send ajax request, and retreive response & take convenient action
            $(".btn_confirm").click(function (event) {

                //delete customer
                if ( $(this).data('type') == 'delete_customer' )
                {
                    $.ajax({
                        url:'/customers/delete/'+customer_id,
                        method:"POST",
                        data:{
                            '_token' : '<?php echo csrf_token() ?>'
                        },
                        success:function (data) {
                            if ( data == 'true' ) {
                                $(event.target).closest('.modal').modal('hide'); //hide modal
                                $(".tbl-1 td").filter(function() { //hide deleted table row from view
                                    return $(this).text() == customer_id;
                                }).closest("tr").css('background-color', 'red').hide(1000);
                                console.log('deleted!')
                            } else
                                console.log('error : ' + data);
                        }
                    });
                }

            });



            //customize paginator
            $("#customize-paginator").click(function (event) {
                let current_url = document.location.href;

                if ( current_url.includes('return/all') ) {
                    document.location.href = "/customers/return/all/count/" + $(this).parent().siblings().closest('input').val();
                }
                else if ( current_url.includes('return/partners') ) {
                    document.location.href = "/customers/return/partners/count/" + $(this).parent().siblings().closest('input').val();
                }
                else if ( current_url.includes('return/customers') ) {
                    document.location.href = "/customers/return/customers/count/" + $(this).parent().siblings().closest('input').val();
                }
                else {
                    document.location.href = "/customers/return/customers/count/" + $(this).parent().siblings().closest('input').val();
                }

            });



        });
    </script>
    <!---------------------------------------------------------------------------------------------------------------------------------------------------------------------------->



@endsection
