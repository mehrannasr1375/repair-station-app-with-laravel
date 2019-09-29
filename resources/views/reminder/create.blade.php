@extends('layouts.frame')
@section('page','ثبت یادآوری جدید')
@section('content')



    <!-- Form --------------------------------------------------------------------------------------------------------------------->
    <div class="form-box">
        <form action="/dashboard/reminder" method="POST">
        @csrf


            <!-- reminder details -->
            <div class="con mt-6">
                <div><p class="mb-0"><i class="fa fa-plus-circle"></i> یادآوری جدید : </p></div>
                <div class="row">
                    <!-- title -->
                    <div class="col-12 form-group input-group">
                        <div class="input-group-prepend"><div class="input-group-text"><span class="label">عنوان یادآوری :</span></div></div>
                        <input type="text" class="form-control border-fix" name="title" value="{{ old('title') }}" autocomplete="off"/>
                    </div>
                    <!-- start_date -->
                    <div class="col-6 form-group input-group">
                        <div class="input-group-prepend"><div class="input-group-text"><span class="label">تاریخ آغاز :</span></div></div>
                        <input type="text" class="form-control text-center" name="start_date"  value="{{ Verta::now() }}" autocomplete="off" />
                    </div>
                    <!-- end_date -->
                    <div class="col-6 form-group input-group">
                        <div class="input-group-prepend"><div class="input-group-text"><span class="label">تاریخ پایان :</span></div></div>
                        <input type="text" class="form-control text-center" name="end_date"  value="{{ Verta::now() }}" autocomplete="off" />
                    </div>
                    <!-- description -->
                    <div class="col-12 form-group input-group">
                        <div class="input-group-prepend"><div class="input-group-text"><span class="label">توضیحات :</span></div></div>
                        <textarea class="form-control text-vsm" name="description" autocomplete="off" style="min-height:100px;" >
                            {{ old('description') }}
                        </textarea>
                    </div>
                </div>



                <!-- btn submit -->
                <div class="d-flex justify-content-center">
                    <button class="btn btn-bordered my-2" type="submit" >  ثبت  <i class="fa fa-check"></i></button>
                </div>


            </div>


        </form>
    </div>



@endsection
