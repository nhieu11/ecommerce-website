@extends('client.layouts.app', ['activePage' => 'cart', 'title' => 'Giỏ hàng'])
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

                @forelse (Cart::getContent() as $item)
                <div class="product-cart">
                    <div class="one-forth">
                        <div class="product-img">
                            <img class="img-thumbnail cart-img" src="{{$item->attributes['avatar']}}">
                        </div>
                        <div class="detail-buy">
                            <h4>Mã : {{ $item->attributes['sku'] }}</h4>
                            <h5>{{ $item->name }}</h5>
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <span class="price">{{ number_format($item->price) }} đ</span>
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <input type="number"
                                class="form-control input-number input-quantity text-center"
                                data-product-id="{{ $item->id }}"
                                value="{{ $item->quantity }}">
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <span class="price unit-price">{{ number_format($item->quantity * $item->price) }} đ</span>
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <a href="#" class="closed" data-product-id="{{ $item->id }}"></a>
                        </div>
                    </div>
                </div>
                @empty

                @endforelse



            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="total-wrap">
                    <div class="row">
                        <div class="col-md-3 col-md-push-1 text-center">
                            <div class="total">
                                <div class="grand-total">
                                    @if(session()->has('message'))
                                        <div class="alert alert-success">
                                            {!! session()->get('message') !!}
                                        </div>
                                    @elseif(session()->has('error'))
                                        <div class="alert alert-danger">
                                            {!! session()->get('error') !!}
                                        </div>
                                    @endif
                                    <form method="POST" action="{{url('/check-coupon')}}">
                                        @csrf
                                            <input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá"><br>
                                            <input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Tính mã giảm giá">
                                    </form>
                                    @if(Session::get('coupon'))
                                    <a class="btn btn-default check_out" href="{{url('/unset-coupon')}}">Xóa mã khuyến mãi</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                        </div>
                        <div class="col-md-3 col-md-push-1 text-center">
                            <div class="total">
                                <div class="grand-total">
                                    <p>Tổng cộng: {{ number_format(Cart::getTotal()) }} đ</p>
                                    @if(Session::get('coupon'))
                                        <li>

                                            @foreach(Session::get('coupon') as $key => $cou)
                                                @if($cou['coupon_condition']==1)
                                                    Mã giảm : {{$cou['coupon_number']}} %
                                                    <p>
                                                        @php
                                                        $total_coupon = (Cart::getTotal()*$cou['coupon_number'])/100;
                                                        $bill = Cart::getTotal()-$total_coupon;
                                                        echo '<p><li>Tổng giảm:'.number_format($total_coupon,0,',','.').'đ</li></p>';
                                                        @endphp
                                                    </p>
                                                @elseif($cou['coupon_condition']==2)
                                                    Mã giảm : {{number_format($cou['coupon_number'],0,',','.')}} k
                                                    <p>
                                                        @php
                                                        $bill = Cart::getTotal() - $cou['coupon_number'];
                                                        @endphp
                                                    </p>
                                                @endif
                                            @endforeach
                                        </li>
                                        @php
                                        echo '<p><span><strong>Thành tiền:</strong></span> <span class="cart-total">'.number_format($bill,0,',','.').'đ</span></p>';
                                        @endphp
                                    @else
                                        @php
                                        echo '<p><span><strong>Thành tiền:</strong></span> <span class="cart-total">'.number_format(Cart::getTotal(),0,',','.').'đ</span></p>';
                                        @endphp
                                    @endif

                                    <a href="/checkout" class="btn btn-primary">Thanh toán <i class="icon-arrow-right-circle"></i></a>
                                    <a href="" class="btn btn-danger">Xóa giỏ hàng <i class="icon-arrow-right-circle"></i></a>


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
