@extends('layouts.app')
@section('body')



    <div id="login-wrapper">
        <div>


            <form action="/signup" method="POST" class="row">
                @csrf
                @method('POST')


                <p style="display: block !important; " class="text-vvsm text-center py-3">لطفا مشخصات خود را به عنوان مدیر برنامه وارد نمایید. در نظر داشته باشید که زین پس باید با این مشخصات وارد برنامه شوید.</p>


                <!-- Username  (=name) -->
                <div class="col-12 mt-2 mb-4 gradient-effect">
                    <i class="fa fa-2x fa-user"></i>
                    <input type="text" name="name" class="text-center" placeholder="نام کاربری" autocomplete="off" required >
                </div>


                <!-- email  (=email) -->
                <div class="col-12 mt-2 mb-4 gradient-effect">
                    <i class="fa fa-2x fa-inbox"></i>
                    <input type="text" name="email" class="text-center" placeholder="ایمیل" autocomplete="off" required >
                </div>


                <!-- Password  (=password) -->
                <div class="col-12 mb-4 gradient-effect">
                    <i class="fa fa-2x fa-lock"></i>
                    <input type="password" name="password" class="text-center" placeholder="رمز عبور" required >
                </div>


                <!-- Errors -->
                @if ($errors->has('name'))
                    <span class="login-error">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
                @if ($errors->has('email'))
                    <span class="login-error">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                @if ($errors->has('password'))
                <span class="login-error">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif


                <!-- Submit -->
                <div class="col-12 my-3">
                    <button type="submit" class="btn-login-custom">ثبت مشخصات</button>
                </div>



            </form>
        </div>
    </div>



@endsection
