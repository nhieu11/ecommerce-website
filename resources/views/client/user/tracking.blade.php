@extends('client.layouts.app', ['activePage' => 'login', 'title' => 'Đơn hàng'])
@section('content')
    <div class="colorlib-shop">
        <div class="container">
            <div class="row row-pb-md">
                <div class="col-md-10 col-md-offset-1">
                    <div class="process-wrap">
                        <div class="  process-lg text-center">
                            <p class='tracking'><span>01</span></p>
                            <h3>Đang chuẩn bị hàng</h3>
                        </div>
                        <div class=" process-lg text-center">
                            <p class='tracking'><span>02</span></p>
                            <h3>Lấy hàng thành công</h3>
                        </div>
                        <div class=" process-lg text-center">
                            <p class='tracking'><span>03</span></p>
                            <h3>Đang giao hàng</h3>
                        </div>
                        <div class=" process-lg text-center">
                            <p class='tracking'><span>04</span></p>
                            <h3>Giao hàng thành công</h3>
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
                                <span
                                    class="price">{{ $date }}/{{ $order->created_at->format('m/Y') }}</span>
                            </div>
                        </div>
                        <div class="four text-center">
                            <div class="display-tc">
                                <span class="price">{{ $order->address }}</span>
                            </div>
                        </div>
                        <div class="four text-center">
                            <div class="display-tc">
                                <span id='tracking-pro' class="price unit-price">
                                    <a style="display:none" class="tracking-id "> {{ $order->processed }} </a>
                                    @if ($order->processed == 0) Đang chuẩn bị
                                        hàng
                                    @endif
                                    @if ($order->processed == 1) Lấy hàng
                                        thành công
                                    @endif
                                    @if ($order->processed == 2) Đang giao
                                        hàng
                                    @endif
                                    @if ($order->processed == 3)Nhận hàng
                                        thành công
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="four text-center">
                            <div class="display-tc">
                                <span class="price unit-price">#{{ $order->id }}</span>
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

                    <div class="product-cart">
                        <div class="one-forth">
                            <div class="product-img">
                                <img class="img-thumbnail cart-img" src="{{ $product->avatar }}">
                            </div>
                            <div class="detail-buy">
                                <h4 style="margin-top:10px; cursor: pointer"> <a href="/user/tracking/{{ $product->id }}"
                                        style="color: black">{{ $product->name }}</a>
                                </h4>
                                <h5>Loại hàng : Xanh / XL</h5>
                                <h5>Mã hàng : {{ $product->sku }}</h5>
                            </div>
                        </div>
                        <div class="one-eight text-center">
                            <div class="display-tc">
                                <span id="price" class="price prd-price">{{ number_format($product->price) }} đ</span>
                            </div>
                        </div>
                        <div class="one-eight text-center">
                            <div class="display-tc">
                                <span id='number' class="price unit-price prd-quantity">{{ $product->quantity }}</span>
                            </div>
                        </div>
                        <div class="one-six">
                            <div class="display-tc">
                                <span id='total' style='font-weight: bold;color: #ff9600'
                                    class="price unit-price total-price">
                                    500.000 đ
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="price-detail col-md-10 col-md-offset-1">
                    <ul class="price-list">
                        <li class="price-item">
                            <p class="right-content">Tổng tiền hàng</p>
                            <p id='total' class="left-content">{{ number_format($product->price) }} đ</p>
                        </li>
                        {{-- <li class="price-item">
                            <p class="right-content">Phí giao hàng</p>
                            <p class="left-content">20,000</p>
                        </li> --}}
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
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.15/lodash.min.js"></script>
    <script src="/assets/admin/js/chart.min.js"></script>

    <script>
        $(document).ready(function() {
            const price = $("#price").text();
            const number = $("#number").text();
            $("#total").text((parseInt(price) * parseInt(number) * 1000).toString().replace(
                /(\d)(?=(\d{3})+(?!\d))/g,
                "$1,") + " đ");
        })

        // tracking-process
        const tracking_id = parseInt(document.querySelector(".tracking-id").innerHTML) + 1
        const tracking = document.querySelectorAll('.tracking');
        console.log(tracking)
        tracking.forEach(element => {
            console.log(element.parentElement)
            if (parseInt(element.firstChild.innerHTML) <= tracking_id) {
                console.log(parseInt(element.firstChild.innerHTML));
                console.log(tracking_id);
                element.parentElement.classList.add('active');
            }
        })


        // console.log($order - > processed)
    </script>
@endpush
<input type="hidden" value="{{ $activePage ?? '' }}" id="page-id" />
