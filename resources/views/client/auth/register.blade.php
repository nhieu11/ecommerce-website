@extends('client.layouts.app', ['activePage' => 'register', 'title' => 'Join us'])
@section('content')

<div class="container">
    <div class="row login-wrapper ">
        <div class="login-form">
            <form action="/login" method="POST">
                @csrf
                <h2 class="text-center">Join us</h2>
                <div class="form-group">
                    <label for="exampleInputEmail1">Họ tên</label>
                    <input type="text" class="form-control" placeholder="Họ tên của bạn" name="email">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Ngày sinh</label>
                    <input type="date" class="form-control" name="email">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Số điện thoai</label>
                    <input type="tel" class="form-control" placeholder="Số điện thoại của bạn" name="email">
                </div>

                <div class="form-group">
                    <label  for="exampleInputPassword1">Email</label>
                    <input type="email" class="form-control" placeholder="Email của bạn " name="password">
                </div>
                <div class="form-group">
                    <label  for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" placeholder="Nhập mật khẩu" name="password">
                </div>
                <div class="form-group">
                    <label  for="exampleInputPassword1">Nhận lại Password</label>
                    <input type="password" class="form-control" placeholder="Nhập lại Password" name="password">
                </div>

                <button type="submit" class=" login-btn btn-primary">Join us</button>

                {{-- <div class="clearfix" style=" text-align: center">
                    <a href="#" class="float-right">Forgot Password?</a>
                </div> --}}
            </form>
        </div>
    </div>
</div>

@endsection