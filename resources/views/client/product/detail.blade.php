@extends('client.layouts.app', ['activePage' => 'home', 'title' => 'Chi tiết sản phẩm'])
@section('content')
    <!-- main -->
    <div class="colorlib-shop">
        <div class="container">
            <div class="row row-pb-lg">
                <div class="col-md-10 col-md-offset-1">
                    <div class="product-detail-wrap">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="product-entry">
                                    <div class="product-img" style="background-image: url({{ $product->avatar }});">

                                    </div>

                                </div>
                            </div>
                            <div class="col-md-7">
                                <form action="/cart/add" method="post">
                                    @csrf
                                    <div class="desc">
                                        <h3><input type="hidden" name="name"
                                                value="{{ $product->name }}">{{ $product->name }}</h3>
                                        <p class="price">
                                            <span style="color: #ff9600"><input type="hidden" name="price"
                                                    value="{{ $product->price }}">{{ number_format($product->price) }}
                                                VND</span>
                                        </p>


                                        {{-- <div class="product-color">
                                            <p class="color-header">
                                                Màu Sắc:
                                            </p>
											<ul class="color-list">
												<li class="color-item">

												</li>
											</ul>
                                        </div> --}}

                                        <div class="row row-pb-sm">
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="quantity-left-minus btn"
                                                            data-type="minus" data-field="quantity">
                                                            <i class="icon-minus2"></i>
                                                        </button>
                                                    </span>
                                                    <input type="text" id="quantity" name="quantity"
                                                        class="form-control input-number" value="1" min="1" max="100">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="quantity-right-plus btn"
                                                            data-type="plus" data-field="quantity">
                                                            <i class="icon-plus2"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button class="btn-add btn-primary btn-addtocart"
                                            style="padding:10px 20px 10px 20px; font-size:20px" type="submit"> Thêm vào giỏ
                                            hàng</button>

                                        <div class="description">
                                            <h4 class="d-header">
                                                Mô tả:
                                            </h4>
                                            <div class="d-list">
                                                <p>Thương hiệu: <span>
                                                        {{ $product->brand }}</span></p>
                                                <p>Màu sắc: {{ $product->color }}</p>
                                                <p>Loại áo: {{ $product->description }}</p>
                                                <p>Sản phẩm đã có hàng trên các hệ thóng</p>
                                            </div>
                                        </div>
                                        {{-- <p style="text-align: justify;">
                                            Mô tả: <br>
                                            {{ $product->detail }}
                                        </p>
                                        <p>Thương Hiệu: <span style="font-weight: bold; text-transform: uppercase">
                                                {{ $product->brand }}</span></p> --}}

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="row">
                        <div class="col-md-12 tabulation">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#description">Mô tả</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="description" class="tab-pane fade in active">
                                    {{ $product->description }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="comment row">
                <div class="title col-md-10 col-md-offset-1">Nhận xét khách hàng</div>
                <div class="content col-md-10 col-md-offset-1">
                    <div id="fb-root"></div>
                    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v9.0"
                                        nonce="cfll8TVJ"></script>

                    <div id="comment_fb">
                        <div class="fb-comments" data-href="http://127.0.0.1:8000/product/{{ $product->id }}"
                            data-numposts="5" data-width="1000"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="colorlib-shop">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center colorlib-heading">
                    <h2><span>Sản phẩm Mới</span></h2>
                </div>
            </div>
            <div class="row">
                @foreach ($prd_new as $prd)
                    <div class="col-md-3 text-center">
                        <div class="product-entry">
                            <div class="product-img" style="background-image: url({{ $prd->avatar }});">
                                <p class="tag"><span class="new">New</span></p>
                                <div class="cart">
                                    <p>
                                        <span class="addtocart"><a
                                                href="product/{{ $prd->category_id }}/{{ $prd->id }}"><i
                                                    class="icon-shopping-cart"></i></a></span>
                                        <span><a href="product/{{ $prd->category_id }}/{{ $prd->id }}"><i
                                                    class="icon-eye"></i></a></span>


                                    </p>
                                </div>
                            </div>
                            <div class="desc">
                                <h3><a
                                        href="product/{{ $prd->category_id }}/{{ $prd->id }}">{{ $prd->name }}</a>
                                </h3>
                                <p class="price"><span>{{ number_format($prd->price, 0, '', ',') }} VND</span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- end main -->
@endsection
@push('js')
    <script>
        $('.btn').click(function(e) {
            e.preventDefault();

            fieldName = $(this).attr('data-field');
            type = $(this).attr('data-type');
            var input = $("input[name='" + fieldName + "']");
            var currentVal = parseInt(input.val());
            if (!isNaN(currentVal)) {
                if (type == 'minus') {

                    if (currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    }
                } else {
                    if (currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                }
            } else {
                input.val(0);
            }
        });
    </script>
@endpush
