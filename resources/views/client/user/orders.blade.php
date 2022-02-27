@extends('client.layouts.app', ['activePage' => 'login', 'title' => 'Đơn hàng'])
@section('content')
    <div class="colorlib-shop">
        <div class="container">
            <div class="row row-pb-md">
                <div class="col-md-10 col-md-offset-1">
                    @foreach ($orders as $orderDetail)
                        <div class="product-detail">
                            <div class="product-name product-status">
                                <div class="right-side">
                                    <a href="/user/trackingorder/{{ $orderDetail->id }}">
                                        Đơn hàng
                                        {{ $orderDetail->id }}</a>
                                </div>
                                <div class="left-side">
                                    <span style="color:#26aa99; border-right: 1px solid #000">
                                        @if ($orderDetail->processed == 0)
                                            Đang chuẩn bị
                                            hàng
                                            <i class="fas fa-shipping-fast"></i>
                                        @endif
                                        @if ($orderDetail->processed == 1)
                                            Shipper nhận hàng

                                            <i class="fas fa-shipping-fast"></i>
                                        @endif
                                        @if ($orderDetail->processed == 2)
                                            Đang giao
                                            hàng
                                            <i class="fas fa-shipping-fast"></i>
                                        @endif
                                        @if ($orderDetail->processed == 3)
                                            Giao hàng
                                            thành công
                                            <i class="fa-solid fa-circle-check"></i>
                                        @endif
                                    </span>
                                    <span style="color: #ff9600">
                                        @if ($orderDetail->processed == 3)
                                            Đã giao
                                        @else
                                            Đang giao
                                        @endif
                                    </span>
                                </div>
                            </div>
                            @foreach ($orderDetail->orderDetail as $item)
                                <div class="product-cart">
                                    <div class="one-forth">
                                        <div class="product-img">
                                            <img class="img-thumbnail cart-img" src="{{ $item->avatar }}">
                                        </div>
                                        <div class="detail-buy">
                                            <h4 style="margin-top:10px; cursor: pointer"> <a
                                                    href="/product/{{ $item->product_id }}"
                                                    style="color: black">{{ $item->name }}</a>
                                            </h4>
                                            <h5>Loại hàng : Xanh / XL</h5>
                                            <h5>Mã hàng : {{ $item->sku }}</h5>
                                        </div>
                                    </div>
                                    <div class="one-eight text-center">
                                        <div class="display-tc">
                                            <span class="price prd-price">{{ number_format($item->price) }} đ</span>
                                        </div>
                                    </div>
                                    <div class="one-eight text-center">
                                        <div class="display-tc">
                                            <span class="price unit-price prd-quantity">{{ $item->quantity }}</span>
                                        </div>
                                    </div>
                                    <div style="padding-right: 30px;" class="one-six">
                                        <div class="display-tc">
                                            <span style='font-weight: bold;color: #ff9600'
                                                class="price unit-price total-price">
                                                {{ number_format($item->quantity * $item->price) }} đ
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="product-name product-total">
                                Tổng tiền: <span class="total"> {{ number_format($orderDetail->total) }} đ</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.15/lodash.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".closed").on("click", function(e) {
                e.preventDefault()
                const _this = $(this)
                $.ajax({
                    url: '/cart/remove',
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        product_id: $(this).data('product-id'),
                    },
                    success: function() {
                        _this.parents(".product-cart").remove()
                        window.location.reload(false)
                    }
                })
            })

            $(".input-quantity").on("change", _.debounce(function() {
                const quantity = $(this).val()
                const product_id = $(this).data('product-id')
                const _input_quantity_context = $(this)
                $.ajax({
                    url: '/cart/update',
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        product_id: product_id,
                        quantity: quantity
                    },
                    success: function(response) {
                        _input_quantity_context
                            .parents('.product-cart')
                            .find('.unit-price')
                            .text(response.itemSubTotal + ' đ')

                        $(".cart-total").text(response.total + ' đ')
                    }
                })
            }, 1000))

            const price = parseInt($(".prd-price").text());
        })
    </script>
@endpush
