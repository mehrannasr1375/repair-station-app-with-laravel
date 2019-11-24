@extends('layouts.frame')
@section('page', 'ویرایش اطلاعات مشتری')
@section('content')



    <div class="form-box">


        <!-- Messages -->
        <span class="row my-4">
            <span class="col-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
            </span>
        </span>
        <span class="row my-2">
            <span class="col-12">
                @if ( session()->has('success') )
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
            </span>
        </span>

        <!-- Form for show && edit customer -->
        <form action="/customers/{{ $customer->id }}" method="POST">

            @method('PATCH')

            <div class="con">

                <div>
                    <p class="mb-0"><i class="fa fa-user"></i> مشخصات مشتری : </p>
                </div>
                <div class="row">

                    <!-- full name -->
                    <div class="col-12 col-lg-6 form-group input-group">
                        <div class="input-group-prepend"><div class="input-group-text"><span class="label">نام و نام خانوادگی :</span></div></div>
                        <input type="text" class="form-control border-fix" name="name" value="{{ $customer->name }}"  autocomplete="off" />
                    </div>

                    <!-- is_partner -->
                    <div id="chk_is_partner" class="col-12 col-lg-3 form-group input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <input type="checkbox" name="is_partner" {{ $customer->is_partner ? 'checked':'' }}  autocomplete="off" />
                            </div>
                        </div>
                        <div class="input-group-append"><div class="input-group-text label bg-white">همکار</div></div>
                    </div>

                    <!-- id -->
                    <div class="col-12 col-lg-3 form-group input-group mr-auto">
                        <div class="input-group-prepend"><div class="input-group-text"><span class="label">شناسه:</span></div></div>
                        <input type="text" class="form-control font-weight-bold text-danger text-center" name="id" value="{{ $customer->id }}" disabled autocomplete="off" />
                    </div>

                </div>
                <div class="row">

                    <!-- phone -->
                    <div class="col-12 col-lg-6 form-group input-group">
                        <div class="input-group-prepend"><div class="input-group-text"><span class="label">تلفن ثابت :</span></div></div>
                        <input type="text" class="form-control" name="tell_1" value="{{ $customer->tell_1 }}" autocomplete="off" />
                    </div>
                    <div class="col-12 col-lg-6 form-group input-group">
                        <div class="input-group-prepend"><div class="input-group-text"><span class="label">تلفن همراه :</span></div></div>
                        <input type="text" class="form-control" name="mobile_1" value="{{ $customer->mobile_1 }}" autocomplete="off" />
                    </div>

                    <!-- address -->
                    <div class="col-12 form-group input-group">
                        <div class="input-group-prepend"><div class="input-group-text"><span class="label">آدرس :</span></div></div>
                        <input type="text" class="form-control" name="address" value="{{ $customer->address }}" autocomplete="off" />
                    </div>

                </div>

                <!-- btn submit -->
                <div class="d-flex justify-content-center">
                    <button class="btn btn-bordered my-2" type="submit" >  ویرایش  <i class="fa fa-check"></i></button>
                </div>

            </div>

            @csrf
        </form>



        <!-- back to customers list link -->
        <div class="d-flex justify-content-end">
            <a class="btn-bordered" href="/customers/{{ $customer->id }}/bills"> پرداختی ها <i class="fa fa-dollar"></i></a>
            <a class="btn-bordered mx-2" href="/customers/{{ $customer->id }}/orders"> تعمیری ها <i class="fa fa-microchip"></i></a>
            <a class="btn-bordered" href="/customers/return/all"> بازگشت به لیست مشتری ها <i class="fa fa-angle-double-left"></i></a>
        </div>



    </div>


    <script type="text/javascript">
        $(window).on('load', function() {
            $("#chk_is_partner").click(function (event) {
                $('input[type=checkbox][name=is_partner]').click();
            });
        });
    </script>


@endsection
