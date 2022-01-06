@extends('client.layouts.app', ['activePage' => 'product', 'title' => 'Sản phẩm'])
@section('css')
<style>

*{margin:0;padding:0;}
.clearfix:before,.clearfix:after{
	content: '';
	display: table;
	clear: both;
}
.menu-cap3{
	width: 1200px;
	margin: 0 auto;
	list-style: none;

}
.menu-cap3 > li{
	float: left;
}
.menu-cap3 > li a{
	font-size: 16px;
	display: block;
	padding: 10px 15px;
	text-decoration: none;
	border-right: 1px solid #e0caca;

}
.menu-cap3 > li:last-child a{
	border-right: 0;
    color: #000;
}
.menu-cap3 li{
	position: relative;
}
.menu-cap3 li .menu-sub{
	list-style: none;
	position: absolute;
	top: 100%;
	left: 0;
	width: 200px;
	box-shadow: 0px 1px 8px -4px #333;
	background-color: #f8f8f8;;
	/*display: none;*/
	opacity: 0;
	visibility: hidden;
	top: 150%;
	transition: all 0.5s ease-in-out;
}
.menu-cap3 li .menu-sub ul{
	top: 0;
	/*left: 100%;*/
	left: 150%;
}
.menu-cap3 li:hover > .menu-sub{
	/*display: block;*/
	opacity: 1;
	visibility: visible;
	top: 100%;
}
.menu-cap3 li .menu-sub li:hover > ul{
	top: 0;
	left: 100%;
}
/* .menu-cap3 li:hover > a {
	background: #f8f8f8;
} */
    </style>
@endsection
@section('content')
<div class="colorlib-shop">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-push-3">
                <div class="row row-pb-lg">
                    @forelse ($products as $product)
                    <div class="col-md-4 text-center">
                        <div class="product-entry">
                            <div class="product-img"
                                style="background-image: url({{$product->avatar}});">

                                <div class="cart">
                                    <p>
                                        <span class="addtocart">
                                            <a href="cart.html" class="btn-add-to-cart"
                                            data-product-id="{{$product->id}}"
                                            data-name="{{$product->name}}"
                                            data-price="{{$product->price}}"
                                            >
                                                <i class="icon-shopping-cart"></i>
                                            </a>
                                        </span>
                                        <span><a href="/product/{{ $product->id }}"><i class="icon-eye"></i></a></span>


                                    </p>
                                </div>
                            </div>
                            <div class="desc">
                                <h3><a href="/product/{{ $product->id }}">{{ $product->name }}</a></h3>
                                <p class="price"><span>{{ number_format($product->price) }} VND</span></p>
                            </div>
                        </div>
                    </div>
                    @empty

                    @endforelse

                </div>
                <div class="row">
                    <div class="col-md-12">
                        {{$products->links()}}
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-md-pull-9">
                <div class="sidebar">
                    <div class="fancy-collapse-panel">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="navbar navbar-default" role="navigation">
                                <div class="container">
                                    <div class="collapse navbar-collapse">
                                        <ul class="menu-cap3 clearfix">
                                        <li>
                                            <a href="#" style = "font-size:20px; color:black; ">Danh mục    <b class="caret"></b></a>
                                            <ul class="menu-sub">
                                                @foreach ($categories as $category)
                                                    @if ($category->parent_id == $parent)
                                                        <li>
                                                            <a href="/product/categorize_byID/{{$category->id}}" >{{ $category->name }}<b class="caret"></b></a>
                                                            <ul class="menu-sub">
                                                            @foreach($categories as $value)
                                                                @if($category->id==$value->parent_id)
                                                                        <li><a href="/product/categorize_byID/{{$value->id}}" >{{ $value->name }}<b class="caret"></b></a>
                                                                        <ul class="menu-sub">
                                                                            @foreach($categories as $item)
                                                                                @if($value->id==$item->parent_id)
                                                                                <li><a href="/product/categorize_byID/{{$item->id}}" class="button">{{ $item->name }}</a></li>
                                                                                @endif
                                                                            @endforeach
                                                                        </ul>
                                                                        </li>
                                                                @endif
                                                            @endforeach
                                                            </ul>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="side">
                        <h2>Khoảng giá</h2>
                        <form action="/product" method="GET" class="colorlib-form-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="guests">Từ:</label>
                                        <div class="form-field">
                                            <i class="icon icon-arrow-down3"></i>
                                            <select id="select-start" name="start" id="people" class="form-control">
                                                <option value="{{App\Entities\Product::min('price')}}">Min Price</option>
                                                <option value="100000">100.000 VNĐ</option>
                                                <option value="200000">200.000 VNĐ</option>
                                                <option value="300000">300.000 VNĐ</option>
                                                <option value="500000">500.000 VNĐ</option>
                                                <option value="1000000">1.000.000 VNĐ</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="guests">Đến:</label>
                                        <div class="form-field">
                                            <i class="icon icon-arrow-down3"></i>
                                            <select name="end" id="people" class="form-control">
                                                <option value="2000000">2.000.000 VNĐ</option>
                                                <option value="4000000">4.000.000 VNĐ</option>
                                                <option value="6000000">6.000.000 VNĐ</option>
                                                <option value="8000000">8.000.000 VNĐ</option>
                                                <option value="10000000">10.000.000 VNĐ</option>
                                                <option value="{{App\Entities\Product::max('price')}}">Max Price</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" style="width: 100%;border: none;height: 40px;">Tìm kiếm</button>
                        </form>
                    </div>
                    <div class="side">
                        <h2>Màu Sắc</h2>
                        <form action="/product" method="GET" class="colorlib-form-2">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="guests">Color</label>
                                        <div class="form-field">
                                            <i class="icon icon-arrow-down3"></i>
                                            <select name="color" id="people" class="form-control">
                                                <option value="black">Đen</option>
                                                <option value="white">Trắng</option>
                                               {{--   <option value="{{App\Entities\Product::max('price')}}">Max Price</option>  --}}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" style="width: 100%;border: none;height: 40px;">Tìm kiếm</button>
                        </form>
                    </div>
                    <div class="side">
                        <h2>Nhãn Hiệu</h2>
                        <form action="/product" method="GET" class="colorlib-form-2">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="guests">Brand</label>
                                        <div class="form-field">
                                            <i class="icon icon-arrow-down3"></i>
                                            <select name="brand" id="people" class="form-control">
                                                <option value="highway">Highway</option>
                                                <option value="zara">Zara</option>
                                                <option value="coolmate">Coolmate</option>
                                              {{--    <option value="{{App\Entities\Product::max('price')}}">Max Price</option>  --}}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" style="width: 100%;border: none;height: 40px;">Tìm kiếm</button>
                        </form>
                    </div>
                </div>
            </div>
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
