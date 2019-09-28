@extends('layouts.frame')
@section('page','پیشخوان')
@section('content')



<div id="dashboard">

    <!-- first row -->
    <div class="row">

        <div class="col-7 dash-con">
            <div class="dash-con-inner">
                <div class="d-flex flex-row justify-content-between" style="line-height:3.4;">
                    <img src="{{ asset('/images/icons/message.png') }}">
                    <p>یاد آوری ها</p>
                    <p class="ml-auto" style="line-height:4;" >( 8 )</p>
                    <i id="btn-add-reminder" class="fa fa-2x fa-plus-circle"></i>

                </div>
                <div class="tbl-2-con">
                    <table class="tbl-2">
                        <tr>
                            <td>1</td>
                            <td>ارسال پیام به حسن حسنی</td>
                            <td>
                                <i class="fa fa-check-circle text-success mr-2"></i>
                                <i class="fa fa-check-circle text-danger mr-2"></i>
                                <i class="fa fa-info-circle text-info mr-2"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>تماس با رضا رضایی</td>
                            <td>
                                <i class="fa fa-check-circle text-success mr-2"></i>
                                <i class="fa fa-check-circle text-danger mr-2"></i>
                                <i class="fa fa-info-circle text-info mr-2"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>تماس با قلی</td>
                            <td>
                                <i class="fa fa-check-circle text-success mr-2"></i>
                                <i class="fa fa-check-circle text-danger mr-2"></i>
                                <i class="fa fa-info-circle text-info mr-2"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>ثبت تعمیری حسین حسینی</td>
                            <td>
                                <i class="fa fa-check-circle text-success mr-2"></i>
                                <i class="fa fa-check-circle text-danger mr-2"></i>
                                <i class="fa fa-info-circle text-info mr-2"></i>
                            </td>
                        </tr>
                    </table>
                    <div class="pt-4 d-flex justify-content-center">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#"><</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-5 dash-con">
            <div class="dash-con-inner">

                <div>
                    <img src="{{ asset('/images/icons/calendar.png') }}">
                    <p>زمان و تاریخ</p>
                    <p id="show-time"></p>
                </div>

                @include('calendar.index')

            </div>
        </div>

    </div>


    <!-- diagram -->
    <div class="row">
        <div class="col dash-con">
            <div class="dash-con-inner">

                <div>
                    <img src="{{ asset('/images/icons/diagram.png') }}">
                    <p>نمودار</p>
                    <p>سود خالص 30 روز اخیر</p>
                </div>

                <div id="pop_div" class="w-100 h-100 m-auto py-2"></div>
                {!! Lava::render('AreaChart', 'Population', 'pop_div') !!}

            </div>
        </div>
    </div>

</div>



@endsection
