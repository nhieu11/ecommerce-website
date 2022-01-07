@extends('client.layouts.app', ['activePage' => 'user', 'title' => 'Đơn hàng'])
@section('content')
<div class="colorlib-shop">
    <div class="container">
        {{-- <div class="row row-pb-md">
            <div class="col-md-10 col-md-offset-1">
                <div class="process-wrap">
                    <div class="process text-center active">
                        <p><span>01</span></p>
                        <h3>Giỏ hàng</h3>
                    </div>
                    <div class="process text-center">
                        <p><span>02</span></p>
                        <h3>Thanh toán</h3>
                    </div>
                    <div class="process text-center">
                        <p><span>03</span></p>
                        <h3>Hoàn tất thanh toán</h3>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="row row-pb-md">
            <div class="col-md-10 col-md-offset-1">
                <div class="product-name">
                    <div class="one-forth text-center">
                        <span>Chi tiết sản phẩm</span>
                    </div>
                    <div class="one-eight text-center">
                        <span>Giá</span>
                    </div>
                    <div class="one-eight text-center">
                        <span>Số lượng</span>
                    </div>
                    <div class="one-eight text-center">
                        <span>Tổng</span>
                    </div>
                    <div class="one-eight text-center">
                        <span>Trạng thái</span>
                    </div>
                </div>

                {{-- @forelse (Cart::getContent() as $item) --}}
                <div class="product-cart">
                    <div class="one-forth">
                        <div class="product-img">
                            {{-- <img class="img-thumbnail cart-img" src="{{$item->attributes['avatar']}}"> --}}
                            <img class="img-thumbnail cart-img" src="https://images.unsplash.com/photo-1593642634524-b40b5baae6bb?ixlib=rb-1.2.1&ixid=MnwxMjA3fDF8MHxlZGl0b3JpYWwtZmVlZHwxfHx8ZW58MHx8fHw%3D&auto=format&fit=crop&w=500&q=60">
                        </div>
                        <div class="detail-buy">
                            <h4 style="margin-top:10px; cursor: pointer"> <a href="" style="color: black">Áp phông</a></h4>
                            <h5>Loại hàng : Xanh / XL</h5>
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <span class="price">289.000 đ</span>
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <span class="price unit-price">2</span>
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <span class="price unit-price">289.000 đ</span>
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <span class="price unit-price">Giao hàng thành công</span>
                        </div>
                    </div>
                </div>
                <div class="product-cart">
                    <div class="one-forth">
                        <div class="product-img">
                            {{-- <img class="img-thumbnail cart-img" src="{{$item->attributes['avatar']}}"> --}}
                            <img class="img-thumbnail cart-img" src="https://images.unsplash.com/photo-1625910513413-c23b8bb81cba?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8N3x8cG9sb3xlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60">
                        </div>
                        <div class="detail-buy">
                            <h4 style="margin-top:10px; cursor: pointer"> <a href="/user/tracking" style="color: black">Áp polo</a> </h4>
                            <h5>Loại hàng : Xanh / XL</h5>
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <span class="price">289.000 đ</span>
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <span class="price unit-price">2</span>
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <span class="price unit-price">289.000 đ</span>
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <span class="price unit-price">Đang giao hàng</span>
                        </div>
                    </div>
                </div>
                {{-- @empty

                @endforelse --}}



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
})
</script>

@endpush
