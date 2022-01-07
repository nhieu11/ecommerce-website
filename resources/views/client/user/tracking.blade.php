@extends('client.layouts.app', ['activePage' => 'user', 'title' => 'Đơn hàng'])
@section('content')
    <div class="colorlib-shop">
        <div class="container">
            <div class="row row-pb-md">
                <div class="col-md-10 col-md-offset-1">
                    <div class="process-wrap">
                        <div class="process text-center active">
                            <p><span>01</span></p>
                            <h3>Đơn hàng đã đặt</h3>
                        </div>
                        <div class="process text-center">
                            <p><span>02</span></p>
                            <h3>Giao hàng</h3>
                        </div>
                        <div class="process text-center">
                            <p><span>03</span></p>
                            <h3>Nhận hàng thành công</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row row-pb-md">
                <div class="col-md-10 col-md-offset-1">
                    <div class="product-name tracking-info">
                        <div class="four four-header">
                            <span>Thời gian ước tính</span>
                        </div>
                        <div class="four four-header">
                            <span>Địa chỉ</span>
                        </div>
                        <div class="four four-header">
                            <span>Trạng thái</span>
                        </div>
                        <div class="four four-header">
                            <span>ID đơn hàng</span>
                        </div>
                    </div>

                    <div class="product-cart tracking-info">
                        <div class="four text-center">
                            <div class="display-tc">
                                <span class="price">15-01-2022</span>
                            </div>
                        </div>
                        <div class="four text-center">
                            <div class="display-tc">
                                <span class="price">Ngõ 356, Cầu Giấy, Hà Nội</span>
                            </div>
                        </div>
                        <div class="four text-center">
                            <div class="display-tc">
                                <span class="price unit-price">Đang giao</span>
                            </div>
                        </div>
                        <div class="four text-center">
                            <div class="display-tc">
                                <span class="price unit-price">#123456789</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <h4 class="tracking-header">
                        Thông tin đơn hàng
                    </h4>
                    <div class="tracking-detail">
                        <div class="tracking-left">
                            <div class="img-container">
                                <img class="order-img"
                                    src="https://mcdn2-coolmate.cdn.vccloud.vn/uploads/November2021/2L6A8a954_copy.jpg"
                                    alt="">
                            </div>
                            <div class="order-desc">
                                <h4 class="order-name">Áo thun dài tay nam Cotton Compact phiên bản Premium</h4>
                                <p class="order-type">Loại hàng: <span>Xanh dương / XL</span></p>
                            </div>
                        </div>
                        <div class="order-price">
                            <span>289.000</span>
                        </div>
                    </div>

                    <div class="price-detail">
                        <ul class="price-list">
                            <li class="price-item">
                                <p class="right-content">Tổng tiền hàng</p>
                                <p class="left-content">289.000</p>
                            </li>
                            <li class="price-item">
                                <p class="right-content">Phí giao hàng</p>
                                <p class="left-content">20.000</p>
                            </li>
                            <li class="price-item">
                                <p class="right-content">Giảm giá</p>
                                <p class="left-content">0</p>
                            </li>
                            <li class="price-item">
                                <p style="align-self: center" class="right-content">Tổng tiền</p>
                                <p class="left-content big-price">309.000</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.15/lodash.min.js"></script>
@endpush
