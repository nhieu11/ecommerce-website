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
        </div>
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
                        <span>Xóa</span>
                    </div>
                </div>
                @foreach (Cart::getContent() as $item)
                <div class="product-cart">
                    <div class="one-forth">
                        <div class="product-img">
                            <img class="img-thumbnail cart-img" src="images/ao-so-mi-hoa-tiet-den-asm1223-10191.jpg">
                        </div>
                        <div class="detail-buy">
                            <h4>Mã : {{$item->attributes['sku']}}</h4>
                            <h5>{{$item->name}}</h5>
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <span class="price">{{ number_format($item->price)}}</span>
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <input type="number"
                                class="form-control input-number input-quantity text-center" data-product-id="{{ $item->id }}" value="{{ $item->quantity }}">
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <span class="price unit-price">{{number_format($item->quantity * $item->price)}}</span>
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <a href="#" class="closed data-product-id={{$item->id}}"></a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="total-wrap">
                    <div cqlass="row">
                        <div class="col-md-8">

                        </div>
                        <div class="col-md-3 col-md-push-1 text-center">
                            <div class="total">
                                <div class="sub">

                                </div>
                                <div class="grand-total">
                                    <p><span><strong>Tổng cộng:</strong></span> <span class="cart-total">{{ number_format(Cart::getTotal()) }}</span></p>
                                    <a href="checkout.html" class="btn btn-primary">Thanh toán <i
                                            class="icon-arrow-right-circle"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.15/lodash.min.js"></script>
<script>
    $(document).ready(function(){

        $(".closed").on("click",function(e) {
            e.preventDefault();
            $.ajax({
                url: "/cart/remove",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: $(this).data("product_id"),
                },
            })
            $(this).parents(".product-cart").remove()
        })


        $(".input-quantity").on("change", _.debounce(function(){

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
                success: function(response){
                    _input_quantity_context
                    .parents('.product-cart')
                    .find('.unit-price')
                    .text(response.itemSubTotal + ' đ')

                $(".cart-total").text(response.total + 'đ')
                }
            })
        }, 1000))
    })

</script>

@endpush
