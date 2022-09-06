@extends('auth.layouts.app')

@section('title', 'Reset Password')

@section('content')
<div class="nk-block-head">
    <div class="nk-block-head-content">
        <h5 class="nk-block-title">Reset password</h5>
        <div class="nk-block-des">
            <p>Here you can reset your password.</p>
        </div>
    </div>
</div>
@if($errors->any())
<div class="alert alert-danger">
    <b>Error: </b> {{ $errors->first() }}
</div>
@endif
<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <div class="form-control-wrap">
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
    </div>
    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="email">Email</label>
        </div>
        <div class="form-control-wrap">
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" class="form-control form-control-lg" placeholder="Enter your email address">
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="password">Password</label>
        <div class="form-control-wrap">
            <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
            </a>
            <input id="password" type="password" name="password" required autocomplete="new-password" class="form-control form-control-lg" placeholder="Enter your password">
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="password_confirmation">Confirm Password</label>
        <div class="form-control-wrap">
            <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password_confirmation">
                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
            </a>
            <input type="password" name="password_confirmation" required class="form-control form-control-lg" id="password_confirmation" placeholder="Enter your password">
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-lg btn-primary btn-block">Reset Password</button>
    </div>
</form>
@endsection