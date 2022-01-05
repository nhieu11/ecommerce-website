@extends('client.layouts.app', ['activePage' => 'login', 'title' => 'Login'])
{{-- @section('css')
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
@endsection --}}

@section('content')
{{-- <div id="fb-root"></div>
<script async defer crossorigin="anonymous"
    src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v8.0&appId=718106402129554&autoLogAppEvents=1"
    nonce="bO3RbjoQ"></script>

@if ($errors->any())
@component('admin.layouts.components.alert')
@slot('type', 'danger')
@slot('stroke', 'cancel')
<span style="font-size: 30px">{{ $errors->first() }}</span>
@endcomponent
@endif --}}


<div class="container">
     <div style="padding: 0 200px 0 200px;">
            @if ($errors->any())
            @component('admin.layouts.components.alert')
            @slot('type', 'danger')
            @slot('stroke', 'cancel')
            {{ $errors->first() }}
            @endcomponent
            @endif
        </div>
    <div class="row login-wrapper ">
        <div class="login-form">
            <form action="/login" method="POST">
                @csrf
                <h2 class="text-center">Sign in</h2>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="text" class="form-control" placeholder="Email của bạn" name="email">
                </div>

                <div class="form-group">
                    <label  for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" placeholder="Nhập mật khẩu" name="password">
                </div>

                <button type="submit" class=" login-btn btn-primary">Sign in</button>

                <div class="clearfix text-forget">
                    <a href="#" class="float-right">Forgot Password?</a>
                </div>
            </form>
        </div>

        <!-- đăng nhập FB -->
        <div class="social-login">
            <p class="text-muted" style="margin-bottom: 0px">hoặc</p>
            <h2  class="text-center" style="font-size:30px; line-height: 33px; margin-bottom: 10px">Login with</h2>
            <div class="text-center social-btn">
                <a  href="{{ URL::to('/auth/facebook') }}" id="fbLink" class="btn social-link"
                    style="background-color: #318CF2">Facebook</a>
                {{-- <div class="fb-login-button" data-size="small" data-button-type="login_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false" data-width=""></div> --}}
                {{-- <a href="#" class="btn btn-info" style="font-size:20px">Twitter</a> --}}
                <a href="" class="btn btn-danger social-link" style="">Google</a>
            </div>
            <p class="text-center text-muted small" style="font-size:16px">Don't have an account?
                <a href="/register" style="font-size:16px">Sign up here!</a>
            </p>
        </div>
    </div>
</div>

@endsection
