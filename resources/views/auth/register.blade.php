@extends('auth.layouts.app')

@section('title', 'Register')

@section('content')
<div class="nk-block-head">
    <div class="nk-block-head-content">
        <h5 class="nk-block-title">Register</h5>
        <div class="nk-block-des">
            <p>Create new account here!</p>
        </div>
    </div>
</div>
@if($errors->any())
<div class="alert alert-danger">
    <b>Error: </b> {{ $errors->first() }}
</div>
@endif
<form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="form-group">
        <label class="form-label" for="name">Name</label>
        <div class="form-control-wrap">
            <input type="text" class="form-control form-control-lg" id="name" name="name" value="{{ old('name') }}" required autofocus placeholder="Enter your name">
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="email">Email</label>
        <div class="form-control-wrap">
            <input type="email" name="email" value="{{ old('email') }}" required class="form-control form-control-lg" id="email" placeholder="Enter your email address">
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="password">Password</label>
        <div class="form-control-wrap">
            <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
            </a>
            <input type="password" name="password" required autocomplete="new-password" class="form-control form-control-lg" id="password" placeholder="Enter your passcode">
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="password_confirmation">Confirm Password</label>
        <div class="form-control-wrap">
            <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password_confirmation">
                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
            </a>
            <input type="password" name="password_confirmation" required class="form-control form-control-lg" id="password_confirmation" placeholder="Enter your passcode">
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-lg btn-primary btn-block">Register</button>
    </div>
</form><!-- form -->
<div class="form-note-s2 pt-4"> Already have an account ? <a href="{{ route('login') }}"><strong>Sign in instead</strong></a></div>
@endsection