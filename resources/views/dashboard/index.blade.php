@extends('layouts.frame')
@section('page','پیشخوان')
@section('content')



<div id="dashboard" class="">

    <!-- first row -->
    <div class="row">
        <div class="col-7 dash-con">
            <div class="dash-con-inner">
                <div>
                    <img src="{{ asset('/images/icons/message.png') }}" alt="">
                    <p>پیام ها</p>
                    <p>6 پیام</p>
                </div>
                <div>
                    <table class="tbl-1">
                        <tr>
                            <th>#</th>
                            <th>عیب</th>
                            <th>عیب</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>a</td>
                            <td>a</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>a</td>
                            <td>a</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>a</td>
                            <td>a</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-5 dash-con">
            <div class="dash-con-inner">
                <div>
                    <img src="{{ asset('/images/icons/calendar.png') }}" alt="">
                    <p>تقویم</p>
                    <p>امروز</p>
                </div>
            </div>
        </div>
    </div>

    <!-- diagram -->
    <div class="row">
        <div class="col dash-con">
            <div class="dash-con-inner">
                 <div>
                     <img src="{{ asset('/images/icons/clock.png') }}" alt="">
                     <p>زمان</p>
                     <p>جاری</p>
                 </div>
            </div>
        </div>
    </div>

    <!--  -->
    <div class="row">
        <div class="col dash-con">
            <div class="dash-con-inner">
                <div>
                    <img src="{{ asset('/images/icons/diagram.png') }}" alt="">
                    <p>نمودار</p>
                    <p>سود خالص ماهیانه</p>
                </div>
            </div>
        </div>
    </div>

</div>



@endsection
