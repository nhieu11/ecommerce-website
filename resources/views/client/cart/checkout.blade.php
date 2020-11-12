@extends('client.layouts.app', ['activePage' => 'home', 'title' => 'Giỏ hàng'])
@section('content')
<div class="colorlib-shop">
    <div class="container">
        <div class="row row-pb-md">
            <div class="col-md-10 col-md-offset-1">
                <div class="process-wrap">
                    <div class="process text-center active">
                        <p><span>01</span></p>
                        <h3>Giỏ hàng</h3>
                    </div>
                    <div class="process text-center active">
                        <p><span>02</span></p>
                        <h3>Thanh toán</h3>
                    </div>
                    <div class="process text-center">
                        <p><span>03</span></p>
                        <h3>Hoàn tất thanh toán</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <form action="/checkout" method="post" class="colorlib-form">
                    @csrf
                    <h2>Chi tiết thanh toán</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fname">Họ & Tên</label>
                                <input type="text" id="fname" class="form-control" name="name" placeholder="First Name" value="{{ $user->name }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="fname">Địa chỉ</label>
                                <input type="text" id="address" name="address" class="form-control"
                                    placeholder="Nhập địa chỉ của bạn"
                                    value="{{ $user->address }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="email">Địa chỉ email</label>
                                <input type="email" id="email" name="email" class="form-control"
                                    placeholder="Ex: youremail@domain.com"
                                    value="{{ $user->email }}">
                            </div>
                            <div class="col-md-6">
                                <label for="Phone">Số điện thoại</label>
                                <input type="text" id="zippostalcode" name="phone" class="form-control"
                                    placeholder="Ex: 0123456789"
                                    value="{{ $user->phone }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">

                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Thanh toán</button>
                </form>
            </div>
            <div class="col-md-5">
                <div class="cart-detail">
                    <h2>Tổng Giỏ hàng</h2>
                    <ul>
                        <li>

                            <ul>
                                @foreach (Cart::getContent() as $item)
                                    <li><span>{{ $item->quantity }} x {{ $item->name }}</span> <span>{{ number_format($item->price) }} đ</span></li>
                                @endforeach
                                {{-- <li><span>1 x Tên sản phẩm</span> <span>₫ 780.000</span></li> --}}
                            </ul>
                        </li>

                        <li><span>Tổng tiền đơn hàng</span> <span>{{ number_format(Cart::getTotal()) }} đ</span></li>
                    </ul>
                </div>

                {{-- <div class="row">
                    <div class="col-md-12">
                        <p><a href="/complete" class="btn btn-primary">Thanh toán</a></p>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection
