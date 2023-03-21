@extends('layouts.app')

@section('content')
<style type="text/css">
#logoImg{
    width: 400px;
}
    @media(max-width:500px) {
 #logoImg{
    width: 250px;
    }
}
    </style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="text-align: center;">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <div class="text-logo">
                            <img id="logoImg" src="js-css/img/logo2.png" height="auto">
                        </div>
                    </a>
                </div>

                <div class="session">
                    @if(Session::has('notification'))
                       <div class="session-notification"><i class="fa fa-check" aria-hidden="true"></i> {{Session::get('notification')}}</div>
                    @endif
                </div>

                <div class="card-body card-login">
                    <form method="POST" action="loginkms">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-12">
                                @if(Session::has('email'))
                                    <input id="email" type="email" class="form-control border-red @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                                    <span class="invalid-feedback1" role="alert">
                                        <strong>{{Session::get('email')}}</strong>
                                    </span>
                                @else
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                @if(Session::has('password'))
                                    <input id="password" type="password" class="form-control border-red @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                    <span class="invalid-feedback1" role="alert">
                                        <strong>{{Session::get('password')}}</strong>
                                    </span>
                                @else
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                @endif
                            </div>
                        </div>

                       <!--  <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                            <div class="col-md-6 offset-md-4 aaa">
                                {!! app('captcha')->display() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                        <span class="invalid-feedback1">{{ $errors->first('g-recaptcha-response') }}</span>
                                    </span>
                                @endif
                            </div>
                        </div> -->

                        <div class="form-group row mb-0">
                            <div class="col-md-12" style="font-size:24px; font-weight: 900;">
                                <button type="submit" class="btn btn-model login">
                                    {{ __('Đăng nhập') }}
                                </button>
                                <hr>
                                    <a href="/register">
                                <button type="button" class="btn btn-model login" style="background-color:red">Đăng ký
                                </button></a>

                                <!-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif -->
                            </div>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>
<link href="{{ asset('js-css/css/login1.css') }}" rel="stylesheet">
@endsection
