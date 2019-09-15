@extends('layouts.app')
@section('page', 'ویرایش اطلاعات مشتری')
@section('content')



    <!-- search bar -->
    @include('common.searchbar')



    <div class="form-box">



        <!-- Form for show && edit customer -->
        <form action="/customers/{{ $customer->id }}" method="POST">

            @method('PATCH')

            <div class="con">

                <div>
                    <p class="mb-0 p-1"><i class="fa fa-user"></i> مشخصات مشتری : </p>
                </div>
                <div class="row">

                    <!-- full name -->
                    <div class="col-12 col-lg-6 form-group input-group">
                        <div class="input-group-prepend"><div class="input-group-text"><span class="label">نام و نام خانوادگی :</span></div></div>
                        <input type="text" class="form-control border-fix" name="name" value="{{ $customer->name }}" />
                    </div>
                    <div class="text-danger" role='alert' style="line-height:2.5;">
                        {{ $errors->first('name') }}
                    </div>

                    <!-- is_partner -->
                    <div id="chk_is_partner" class="col-12 col-lg-4 form-group input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <input type="checkbox" name="is_partner" {{ $customer->is_partner ? 'checked':'' }} />
                            </div>
                        </div>
                        <div class="input-group-append"><div class="input-group-text label bg-white">همکار</div></div>
                    </div>

                    <!-- id -->
                    <div class="col-6  col-lg-2 form-group input-group">
                        <div class="input-group-prepend"><div class="input-group-text"><span class="label">شناسه:</span></div></div>
                        <input type="text" class="form-control" name="id" value="{{ $customer->id }}" disabled/>
                    </div>

                </div>
                <div class="row">

                    <!-- phone -->
                    <div class="col-12 col-lg-6 form-group input-group">
                        <div class="input-group-prepend"><div class="input-group-text"><span class="label">تلفن ثابت :</span></div></div>
                        <input type="text" class="form-control" name="tell_1" value="{{ $customer->tell_1 }}" />
                    </div>
                    <div class="col-12 col-lg-6 form-group input-group">
                        <div class="input-group-prepend"><div class="input-group-text"><span class="label">تلفن همراه :</span></div></div>
                        <input type="text" class="form-control" name="mobile_1" value="{{ $customer->mobile_1 }}" />
                    </div>

                    <!-- address -->
                    <div class="col-12 form-group input-group">
                        <div class="input-group-prepend"><div class="input-group-text"><span class="label">آدرس :</span></div></div>
                        <input type="text" class="form-control" name="address" value="{{ $customer->address }}" />
                    </div>

                </div>

                <!-- btn submit -->
                <button class="btn btn-outline-secondary btn-sm my-2" type="submit" >  ویرایش  <i class="fa fa-check"></i></button>

            </div>

            @csrf
        </form>



    </div>


    <script type="text/javascript">
        $(window).on('load', function() {
            $("#chk_is_partner").click(function (event) {
                $('input[type=checkbox][name=is_partner]').click();
            });
        });
    </script>


@endsection
