@extends('layouts.master_no_slider_sidebar')

@section('content')
    <div class="col-sm-4 col-sm-offset-1">
        <div class="login-form">
            <!--login form-->
            <h2>{{ __('Login to your account') }}</h2>
            <form method="POST" action="{{ route('getUserLogin') }}">
                @csrf

                @if (session('status'))
                <ul>
                    <li class="text-danger"> {{ session('status') }}</li>
                </ul>
                @endif

                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="txtEmail" value="{{ old('email') }}" required autofocus placeholder="{{ __('Email') }}">

                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="txtPassword" required placeholder="{{ __('Password') }}">

                <span><input class="checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}</span>
                <button type="submit" class="btn btn-default">{{ __('Login') }}</button>
            </form>
        </div>
        <!--/login form-->
    </div>
    <div class="col-sm-1">
        <h2 class="or">{{ __('OR') }}</h2>
    </div>
    <div class="col-sm-4">
        <div class="signup-form">
            <!--sign up form-->
            <h2>{{ __('New User Signup') }}</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus placeholder="{{ __('Name') }}">
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif

                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="{{ __('Email') }}">
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif

                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required  placeholder="{{ __('Password') }}">
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif

                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required  placeholder="{{ __('Password confirmation') }}">

                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required autofocus placeholder="{{ __('Phone') }}">
                @if ($errors->has('phone'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif

                <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" required autofocus placeholder="{{ __('Address') }}">
                @if ($errors->has('address'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                @endif

                <button type="submit" class="btn btn-default">{{ __('Signup') }}</button>
            </form>
        </div>
        <!--/sign up form-->
    </div>
@endsection
