@extends('auth.layouts.app')

@section('title', 'Login')

@section('content')
<div class="nk-block-head">
    <div class="nk-block-head-content">
        <h5 class="nk-block-title">Log In</h5>
        <div class="nk-block-des">
            <p>Access your account using your email and password.</p>
        </div>
    </div>
</div>
@if($errors->any())
<div class="alert alert-danger">
    <b>Error: </b> {{ $errors->first() }}
</div>
@endif
<form method="POST" action="{{ route('login') }}" class="form-validate is-alter" autocomplete="off">
    @csrf
    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="email-address">Email</label>
        </div>
        <div class="form-control-wrap">
            <input id="email" type="email" name="email" value="{{old('email')}}" required autofocus autocomplete="off" class="form-control form-control-lg" required placeholder="Enter your email address">
        </div>
    </div><!-- .form-group -->
    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="password">Password</label>
            @if (Route::has('password.request'))
            <a class="link link-primary link-sm" tabindex="-1" href="{{ route('password.request') }}">Forgot Password?</a>
            @endif
        </div>
        <div class="form-control-wrap">
            <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
            </a>
            <input autocomplete="current-password" name="password" type="password" class="form-control form-control-lg" required id="password" placeholder="Enter your password">
        </div>
    </div><!-- .form-group -->
    <div class="form-group">
        <button class="btn btn-lg btn-primary btn-block">Log In</button>
    </div>
</form>
<!-- form -->
@if (Route::has('register'))
<div class="form-note-s2 pt-4"> New on our platform? <a href="{{ route('register') }}">Create an account</a></div>
@endif
@endsection