@extends('client.layouts.app', ['activePage' => 'login', 'title' => 'Login'])
@section('css')
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
  
    </style>
@endsection
@section('content')
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v8.0&appId=718106402129554&autoLogAppEvents=1" nonce="bO3RbjoQ"></script>

@if ($errors->any())
@component('admin.layouts.components.alert')
@slot('type', 'danger')
@slot('stroke', 'cancel')
<span style="font-size: 30px">{{ $errors->first() }}</span>
@endcomponent
@endif
<div class="login-form">
        <div style="padding: 0 200px 0 200px;">
            @if ($errors->any())
            @component('admin.layouts.components.alert')
            @slot('type', 'danger')
            @slot('stroke', 'cancel')
            {{ $errors->first() }}
            @endcomponent
            @endif
        </div>
    <form action="/login" method="POST">
        @csrf
        <h2 class="text-center">Sign in</h2>
        <div class="form-group">
        	<div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fa fa-user"></span>
                    </span>
                </div>
                <input type="text" id="email" class="form-control" placeholder="Email của bạn" name="email">
            </div>
        </div>
		<div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-lock"></i>
                    </span>
                </div>
                <input type="password" class="form-control" placeholder="Nhập mật khẩu" name="password">
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary login-btn btn-block" style="background-color: #ff9600">Sign in</button>
        </div>
        <div class="clearfix">
            {{-- <label class="float-left form-check-label"  style="font-size:20px"><input type="checkbox"> Remember me</label> --}}
            <a href="#" class="float-right" style="font-size:20px">Forgot Password?</a>
        </div>
		<div class="or-seperator" style="font-size:20px"><i>or</i></div>
        <p class="text-center" style="font-size:20px">Login with your social media account</p>
        <div class="text-center social-btn">
            <a href="{{ URL::to('/auth/facebook') }}" id="fbLink" class="btn btn-secondary" style="font-size:20px"><i class="fa fa-facebook"></i>&nbsp; Facebook</a>
            {{-- <div class="fb-login-button" data-size="small" data-button-type="login_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false" data-width=""></div> --}}
            <a href="#" class="btn btn-info" style="font-size:20px"><i class="fa fa-twitter"></i>&nbsp; Twitter</a>
			<a href="#" class="btn btn-danger" style="font-size:20px"><i class="fa fa-google"></i>&nbsp; Google</a>
        </div>
    </form>
    <p class="text-center text-muted small" style="font-size:20px">Don't have an account? <a href="#" style="font-size:20px">Sign up here!</a></p>
</div>
@endsection
