@extends('layouts.frame')
@section('page','جستجوی مشتری')
@section('content')



    <!-- Customize Paginator ------------------------------------------------------------------------------------------------------------------------------------------------->
    <div class="row p-2 bg-light shadow-sm">

        <!-- search customer by name form -->
        <div class="col-12 col-lg-5 input-group input-group-sm p-2">
            <div class="input-group-prepend"><div class="input-group-text text-black-50 text-vsm"><span class="label">جستجو بر اساس نام : </span></div></div>
            <input type="text" id="search_title" class="form-control form-control-sm text-vsm text-center" value="{{ $search_title }}" autocomplete="off" />
            <div class="input-group-append">
                <button id="search_customer" class="btn btn-bordered text-vsm text-black-50" type="button">جستجو کن</button>
            </div>
        </div>

        <!-- btn back to customers list -->
        <div class="col-12 col-lg-3 offset-lg-4 py-2">
            <a href="/customers/return/all" class="btn btn-bordered text-vsm text-black-50">بازگشت به لیست مشتری ها<i class="fa fa-backward pr-3"></i></a>
        </div>

    </div>



    <!-- Customers container ---------------------------------------------------------------------------------------------------------------------------------------------------->
    <div class="tbl-main-con">
        <div id="normal">



            <!-- search result title --->
            <div class="alert alert-info mt-5 d-flex justify-content-between">
                <span>
                    نتایج حاصل از جستجوی
                    <span class="font-weight-bold mb-1 mx-2 text-dark">{{ $search_title }}</span>
                    در لیست مشتری ها :
                </span>
                <span>
                    {{ count($customers) }}
                    مورد یافت شد
                </span>
            </div>



            <!-- Table --->
            <table class="tbl-1">
                @if (count($customers) == 0)
                    <div class="d-flex justify-content-center flex-row p-5">
                        <i class='fa fa-3x fa-frown-o'></i>
                        <p class='p-2 text-center' style="font-size: 18px;">اینجا خبری نیست!</p>
                    </div>
                @else
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
                            <td><a href="/customers/{{ $customer->id }}"><i class="fa fa-2x text-info fa-info pl-2"></i></a></td>
                            <td><a href="/customers/{{ $customer->id }}/orders"><i class="fa fa-2x text-dark fa-microchip pl-2"></i></a></td>
                            <td>{{ $customer->available_orders_count == 0 ? "-":$customer->available_orders_count }}</td>
                            <td>{{ $customer->prepaired_orders_count == 0 ? "-":$customer->prepaired_orders_count }}</td>
                            <td><a href="/customers/{{ $customer->id }}/bills"><i class="fa fa-2x text-secondary fa-money pl-2"></i></a></td>
                            <td><a href="#" class="btn_delete_customer"><i class="fa fa-2x text-danger fa-close pl-2"></i></a></td>
                        </tr>
                    @endforeach
                @endif
            </table>



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
                            به همراه تمامی وابستگی هایش ( از جمله تعمیری ها، پرداختی ها و ... ) حذف خواهد شد. آیا به حذف آن اطمینان دارید؟
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


            // search customer by name
            $("#search_customer").click(function (event) {
                let search = $('#search_title').val();
                if (search != '')
                    document.location.href = '/customers/search/' + search;
            });


        });
    </script>
    <!---------------------------------------------------------------------------------------------------------------------------------------------------------------------------->



@endsection
