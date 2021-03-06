@extends('layouts.app')
@section('body')



    <div id="login-wrapper">
        <div>
            <form action="{{ route('login') }}" method="POST" class="row">
                @csrf


                <p class="text-vvsm">مشخصات ورود : </p>


                <!-- Username or Email -->
                <div class="col-12 mt-2 mb-4 gradient-effect">
                    <i class="fa fa-2x fa-user"></i>
                    <input type="text" id="email" class="text-center" placeholder="ایمیل" name="email" value="{{ 'test@test.com' }}" autocomplete="off" required >
                </div>


                <!-- Password -->
                <div class="col-12 mb-4 gradient-effect">
                    <i class="fa fa-2x fa-lock"></i>
                    <input name="password" id="password" class="text-center" type="password" value="{{ 'abcd1234' }}" placeholder="رمز عبور" required >
                </div>


                <!-- Errors-->
                @error('password')
                    <span class="login-error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                @error('email')
                    <span class="login-error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror


                <!-- Remember Me -->
                <div class="form-group d-flex justify-content-center py-4 m-auto text-vsm">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            مرا به خاطر بسپار
                        </label>
                    </div>
                </div>


                <!-- Signup Link -->
                <div class="form-group d-flex justify-content-center py-4 m-auto text-vsm">
                    <a href="/signup">ثبت نام</a>
                </div>


                <!-- Submit -->
                <div class="col-12 my-3">
                    <button type="submit" class="btn-login-custom">ورود</button>
                </div>


                {{--@if (Route::has('password.request'))--}}
                   {{-- <a class="btn btn-link text-center" href="{{ route('password.request') }}">--}}
                        {{--رمز عبورم را فراموش کرده ام--}}
                   {{-- </a>--}}
                {{--@endif--}}


            </form>
        </div>
    </div>



@endsection
