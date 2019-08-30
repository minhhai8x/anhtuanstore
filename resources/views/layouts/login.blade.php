@extends('layouts.master_no_slider_sidebar')

@section('content')
    <div class="col-sm-4 col-sm-offset-1">
        <div class="login-form">
            <!--login form-->
            <h2>Login to your account</h2>
            <form method="POST" action="{{ route('getUserLogin') }}">
                @csrf
                @if ($errors->any())
                 <ul>
                     @foreach($errors->all() as $error)
                         <li class="text-danger"> {{ $error }}</li>
                     @endforeach
                 </ul>
                @endif

                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="txtEmail" value="{{ old('email') }}" required autofocus>

                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="txtPassword" required>

                <span><input class="checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}</span>
                <button type="submit" class="btn btn-default">{{ __('Login') }}</button>
            </form>
        </div>
        <!--/login form-->
    </div>
    <div class="col-sm-1">
        <h2 class="or">OR</h2>
    </div>
    <div class="col-sm-4">
        <div class="signup-form">
            <!--sign up form-->
            <h2>New User Signup!</h2>
            <form action="#">
                <input type="text" placeholder="Name" />
                <input type="email" placeholder="Email Address" />
                <input type="password" placeholder="Password" />
                <button type="submit" class="btn btn-default">Signup</button>
            </form>
        </div>
        <!--/sign up form-->
    </div>
@endsection
