@extends('layouts.frame')
@section('content')



    <div id="dashboard">



        <div id="dash-situation-summary">
            <p class="title-p-1">خلاصه وضعیت:</p>
            <div id="dash-top-con">
                <div class="dash-part-con">
                    <h3 class="text-info">68</h3>
                    <div>
                        <i class="fa fa-wrench"></i>
                        <span>در حال تعمیر</span>
                    </div>
                </div>
                <div class="dash-part-con">
                    <h3 class="text-warning">5</h3>
                    <div>
                        <i class="fa fa-check"></i>
                        <span>تعمیر شده</span>
                    </div>
                </div>
                <div class="dash-part-con">
                    <h3 class="text-danger">25</h3>
                    <div>
                        <i class="fa fa-close"></i>
                        <span>تعمیر نشده</span>
                    </div>
                </div>
                <div class="dash-part-con">
                    <h3 class="text-success">12</h3>
                    <div>
                        <i class="fa fa-check-circle-o"></i>
                        <span>آماده تحویل</span>
                    </div>
                </div>
                <div class="dash-part-con">
                    <h3 class="text-dark">127</h3>
                    <div>
                        <i class="fa fa-archive"></i>
                        <span>قطعات موجود</span>
                    </div>
                </div>
                <div class="dash-part-con">
                    <h3 class="text-info">3</h3>
                    <div>
                        <i class="fa fa-clone"></i>
                        <span>چک لیست من</span>
                    </div>
                </div>
            </div>
        </div>



        <div>

        </div>



    </div>



@endsection
