@extends('layouts.app')
@section('body')



    <div id="login-wrapper">
        <div>
            <form action="{{ route('login') }}" method="POST" class="row">
                @csrf
                <P class="text-vvsm">مشخصات ورود : </P>


                <!-- Username or Email -->
                <div class="col-12 mt-2 mb-4 f-e-2">
                    <i class="fa fa-2x fa-user"></i>
                    <input type="text" id="email" class="text-center @error('email') is-invalid @enderror" placeholder="ایمیل" name="email" value="test@test.com" autocomplete="off" required >
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <!-- Password -->
                <div class="col-12 f-e-2 mb-4">
                    <i class="fa fa-2x fa-lock"></i>
                    <input name="password" id="password" type="password" class="text-center @error('password') is-invalid @enderror" value="12345678" placeholder="رمز عبور" required >
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <!-- Remember Me -->
                <div class="form-group d-flex justify-content-center py-4 m-auto text-vsm">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                                مرا به خاطر بسپار
                        </label>
                    </div>
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
