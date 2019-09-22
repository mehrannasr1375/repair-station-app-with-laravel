@extends('layouts.app')
@section('body')



    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


    <div id="login-wrapper">
        <div>
            <form action="" method="post" class="row">

                <P class="text-vvsm">مشخصات ورود : </P>

                <div class="col-12 mt-2 mb-4 f-e-2">
                    <i class="fa fa-2x fa-user"></i>
                    <input type="text" name="" class="" placeholder="نام کاربری">
                </div>

                <div class="col-12 f-e-2 mb-4">
                    <i class="fa fa-2x fa-lock"></i>
                    <input type="text" name="" class="" placeholder="رمز عبور">
                </div>

                <div class="col-12 mt-5">
                    <a href="./index.php"><button type="button" name="" class="btn-login-custom">ورود</button></a>
                </div>
                <div class="col-12 mt-3 mb-4">
                    <a href="../index.php"><button type="button" name="" class="btn-login-custom">انصراف</button></a>
                </div>

                <p class="text-vvsm text-center">توجه : نام کاربری و رمز عبور جهت بررسی وضعیت تعمیر و یا سفارشات، همان کد رهگیری می باشد.</p>

            </form>
        </div>
    </div>


@endsection
