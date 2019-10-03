@extends('layouts.frame')
@section('page','تاریخچه کلی مشتری ')
@section('content')



    <!-- Customer details ----------------------------------------------------------------------------------------------------------------->
    <div class="alert alert-info mt-6 mb-2">
        <div class="d-flex flex-wrap justify-content-between">
            <p class="text-right mb-3 text-black font-weight-bold">صورت حساب مشتری :</p>
            <div>
                <span>تاریخ : </span>
                <span class="font-weight-bold"> {{ new Verta(new \DateTime()) }} </span>
            </div>
        </div>
        <div class="d-flex flex-wrap justify-content-between">
            <div>
                <span>نام : </span>
                <span class="font-weight-bold"> {{ $customer->name }} </span>
            </div>
            <div>
                <span>کد : </span>
                <span class="font-weight-bold"> {{ $customer->id }} </span>
            </div>
            <div>
                <span>شماره های تماس : </span>
                <span class="font-weight-bold"> {{ $customer->mobile_1 }} و {{ $customer->tell_1 }} </span>
            </div>
        </div>
    </div>



    <!-- Orders ------------------------------------------------------------------------------------------------------------------------------------------------------>
    <div class="tbl-main-con">
        <div id="normal">

            <!-- Table -->
            <table class="tbl-1">
                @if ( count($orders) == 0 )
                    <p class="text-center text-sm-center text-secondary pt-5">
                        <i class="fa fa-2x fa-close mb-4"></i>
                        <br>
                        اینجا خبری نیست!
                    </p>
                @else
                    <tr>
                        <th style="width:60px;" class="text-right pr-4">#</th>
                        <th style="width:60px;">شناسه تعمیری</th>
                        <th>عنوان</th>
                        <th>نوع پرداخت  (فقط پرداختی ها)</th>
                        <th>مبلغ</th>
                        <th>بدهکار / بستانکار</th>
                        <th style="width:110px;">تاریخ</th>
                    </tr>
                    <?php $i=1; ?>
                    @foreach ($orders as $order)

                        <?php $order_details_sum = 0; ?>
                        @foreach ($order->OrderDetails as $orderDetail)
                            <tr class="text-danger">
                                <td>{{ $i++ }}</td>
                                <td>{{ $order->id }}</td>
                                <td>{{ $orderDetail->key }}</td>
                                <td>-</td>
                                <td>{{ $orderDetail->user_amount }}</td>
                                <td>بدهکار</td>
                                <td>-</td>
                            </tr>
                                <?php $order_details_sum += $orderDetail->user_amount;?>
                        @endforeach
                            <?php $payments_sum = 0; ?>
                        @foreach ($order->Payments as $payment)
                            <tr class="text-success">
                                <td>{{ $i++ }}</td>
                                <td>{{ $order->id }}</td>
                                <td>مبلغ دریافتی از مشتری</td>
                                <td>{{ $payment->payment_type }}</td>
                                <td>{{ $payment->amount }}</td>
                                <td>بستانکار</td>
                                <td>{{ $payment->date }}</td>
                            </tr>
                                <?php $payments_sum += $payment->amount;?>
                            @endforeach

                    @endforeach
                @endif
            </table>

            <div class="m-auto d-block mb-5">
                <table class="m-5 m-auto table-bordered ">
                    <tr>
                        <td class="px-4 text-vsm">وضعیت کلی:</td>
                        <td>
                            <input type="text" class="form-control form-control-sm text-center" disabled value="{{ ($order_details_sum - $payments_sum) > 0 ? $order_details_sum - $payments_sum.' بستانکار ':$payments_sum - $order_details_sum.' بدهکار ' }}" >
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Pagination
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
{{--                    {{ $orders->links() }}--}}
                </div>
            </div>-->

        </div>
    </div>



@endsection
