@extends('client.layouts.app', ['activePage' => 'home', 'title' => 'Trang chủ'])

@section('content')
@include('client.layouts.banner')
{{-- <div id="colorlib-featured-product">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a href="" class="f-product-1" style="background-image: url(/assets/client/images/35--min.png);">
                    <div class="desc">
                        <h2>Mẫu <br>cho <br>Nam</h2>
                    </div>
                </a>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <a href="" class="f-product-2" style="background-image: url(/assets/client/images/i2.jpg);">
                            <div class="desc">
                                <h2> <br>Váy <br> Mới</h2>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="" class="f-product-2" style="background-image: url(/assets/client/images/i3.jpg);">
                            <div class="desc">
                                <h2>Sale <br>20% <br>off</h2>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-12">
                        <a href="" class="f-product-2" style="background-image: url(/assets/client/images/i4.jpg);">
                            <div class="desc">
                                <h2>Giầy <br>cho <br>Nam</h2>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div id="colorlib-colection">
    <div class="container">
        <div class="row">
            <div style="margin-bottom: 10px" class="col-md-6 col-md-offset-3 text-center colorlib-heading">
                <h2><span>Bộ Sưu Tập</span></h2>
                <p>Đây là những bộ sưu tập mới nhất của chúng tôi</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="colorlib-colection-item">
                    <img class="f-product-1" src="https://images.unsplash.com/photo-1524532787116-e70228437bbe?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1469&q=80);">
                    <div class="desc">
                        <h2>Áo Nam</h2>
                        <p>Những chiếc áo phông nam năng động cho mùa hè <br/> Hãy mua ngay</p>
                        <a  class='btn btn-primary'href="/product/categorize_byID/3">Mua ngay</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="colorlib-colection-item">
                    <img class="f-product-1" src="https://template.hasthemes.com/norda/norda/assets/images/banner/banner-2.jpg" alt="">
                    <div class="desc">
                        <h2>Áo Nữ</h2>
                        <p>Tối giản sự lựa chọn  <br/>làm tăng vẻ đẹp.</p>
                        <a  class='btn btn-primary'href="/product/categorize_byID/5">Mua ngay</a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<div id="colorlib-intro" class="colorlib-intro" style="background-image: url(/assets/client/images/demo1-9776.jpg);"
    data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="intro-desc">
                    <div class="text-salebox">
                        <div class="text-lefts">
                            <div class="sale-box">
                                <div class="sale-box-top">
                                    <h2 class="number">45</h2>
                                    <span class="sup-1">%</span>
                                    <span class="sup-2">Off</span>
                                </div>
                                <h2 class="text-sale">Sale</h2>
                            </div>
                        </div>
                        <div class="text-rights">
                            <h3 class="title">Dặt hàng hôm nay,nhận ngay khuyến mãi!</h3>
                            <p>Đã có hơn 1000 đơn hàng được gửi đi ở khắp quốc gia.</p>
                            <p><a href="shop.html" class="btn btn-primary">Mua ngay</a> <a href="#"
                                    class="btn btn-primary btn-outline">Đọc
                                    thêm</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="colorlib-shop">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center colorlib-heading">
                <h2><span>Sản phẩm Nổi bật</span></h2>
                <p>Đây là những sản phẩm được ưa chuộng nhất năm 2019</p>
            </div>
        </div>
        <div class="row">
            @foreach ($prd_fe as $prd)
            <div class="col-md-3 text-center">
                <div class="product-entry">
                    <div class="product-img"
                        style="background-image: url({{$prd->avatar}});">
                        <div class="cart">
                            <p>
                                <span class="addtocart"> <a href="cart.html" class="btn-add-to-cart"
                                    data-product-id="{{$prd->id}}"
                                    data-name="{{$prd->name}}"
                                    data-price="{{$prd->price}}"
                                    ><i
                                            class="icon-shopping-cart"></i></a></span>
                                <span><a href="product/{{$prd->id}}"><i class="icon-eye"></i></a></span>


                            </p>
                        </div>
                    </div>
                    <div class="desc">
                        <h3><a href="product/{{$prd->id}}">{{$prd->name}}</a></h3>
                        <p class="price"><span>{{number_format($prd->price,0,'',',')}} VND</span></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<div class="colorlib-shop">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center colorlib-heading">
                <h2><span>Sản phẩm mới</span></h2>
                <p>Đây là những sản phẩm mới của năm năm 2019</p>
            </div>
        </div>

        <div class="row">
            @foreach ($prd_new as $prd)
            <div class="col-md-3 text-center">
                <div class="product-entry">
                    <div class="product-img"
                        style="background-image: url({{$prd->avatar}});">
                        <p class="tag"><span class="new">New</span></p>
                        <div class="cart">
                            <p>
                                <span class="addtocart">
                                    <a href="cart.html" class="btn-add-to-cart"
                                    data-product-id="{{$prd->id}}"
                                    data-name="{{$prd->name}}"
                                    data-price="{{$prd->price}}">
                                    <i class="icon-shopping-cart"></i></a></span>
                                <span><a href="product/{{$prd->id}}"><i class="icon-eye"></i></a></span>
                            </p>
                        </div>
                    </div>
                    <div class="desc">
                        <h3><a href="product/{{$prd->id}}">{{$prd->name}}</a></h3>
                        <p class="price"><span>{{number_format($prd->price,0,'',',')}} VND</span></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
$(document).ready(function() {

    $(".btn-add-to-cart").on('click',function(e){
        e.preventDefault()

        const product_id = $(this).data('product-id')
        const name = $(this).data('name')
        const price = $(this).data('price')
        const quantity = 1

        $.ajax({
            url:'/cart/add',
            data: {
                _token: "{{ csrf_token() }}",
                product_id: product_id,
                name: name,
                price: price,
                quantity: quantity
            },
            method:"POST",
            success: function(response) {
                $(".cart-total-quantity").text(response.cartTotalQuantity)
                window.location.reload(false)
            }
        })
    })

})
// {{-- debounce --}}

</script>
@endpush