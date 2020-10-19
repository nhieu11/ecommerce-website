@extends('client.layouts.app', ['activePage' => 'home', 'title' => 'Sản phẩm'])
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
                                        <span><a href="/product/{{ $product->category_id }}/{{ $product->id }}"><i class="icon-eye"></i></a></span>


                                    </p>
                                </div>
                            </div>
                            <div class="desc">
                                <h3><a href="/product/{{ $product->category_id }}/{{ $product->id }}">{{ $product->name }}</a></h3>
                                <p class="price"><span>{{ number_format($product->price) }}</span></p>
                            </div>
                        </div>
                    </div>
                    @empty

                    @endforelse

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="pagination">
                            <li class="disabled"><a href="#">&laquo;</a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-md-pull-9">
                <div class="sidebar">
                    {{-- <div class="side"> --}}
                        {{-- <h2>Danh mục</h2> --}}
                        <div class="fancy-collapse-panel">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                                {{-- @include('client.product.row_category', ['level' => 0 ]) --}}
                                {{-- <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#menu2"
                                                aria-expanded="true" aria-controls="collapseOne">Quần
                                                Áo Nữ
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="menu2" class="panel-collapse collapse" role="tabpanel"
                                        aria-labelledby="headingOne">
                                        <div class="panel-body">
                                            <ul>
                                                <li><a href="#">Áo Sơ mi Nữ</a></li>
                                                <li><a href="#">Áo thun Nữ</a></li>
                                                <li><a href="#">Áo Khoác Nữ</a></li>

                                            </ul>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="navbar navbar-default" role="navigation">
                                    <div class="container">
                                      <div class="collapse navbar-collapse">
                                         <ul class="nav navbar-nav">
                                            <li>
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style = "font-size:20px">Danh mục    <b class="caret"></b></a>
                                                <ul class="dropdown-menu">
                                                    {{-- @include('client.product.menu_use',['parent'=>0]) --}}
                                                    @foreach ($categories as $category)
                                                        @if ($category->parent_id == $parent)
                                                            <li>
                                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ $category->name }}<b class="caret"></b></a>
                                                                <ul class="dropdown-menu">
                                                                @foreach($categories as $value)
                                                                    {{-- <li><a href="#">{{$value->name}}</a></li> --}}

                                                                    @if($category->id==$value->parent_id)
                                                                            <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ $value->name }}<b class="caret"></b></a>
                                                                            <ul class="dropdown-menu">
                                                                                @foreach($categories as $item)
                                                                                    @if($value->id==$item->parent_id)
                                                                                    <li><a href="#">{{ $item->name }}</a></li>
                                                                                    @endif
                                                                                    {{-- {{ $item->name }} --}}
                                                                                @endforeach
                                                                            </ul>
                                                                            </li>
                                                                    @endif
                                                                @endforeach
                                                                </ul>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                   {{-- <li><a href="#">Menu 1.1</a></li>
                                                   <li class="divider"></li>
                                                   <li><a href="#">Menu 1.1</a></li>
                                                   <li class="divider"></li>
                                                   <li>
                                                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu 1.1 <b class="caret"></b></a>
                                                      <ul class="dropdown-menu">
                                                          <li><a href="#">Menu 1.2</a></li>
                                                          <li>
                                                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu 1.2 <b class="caret"></b></a>
                                                              <ul class="dropdown-menu">
                                                                 <li>
                                                                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu 1.3 <b class="caret"></b></a>
                                                                     <ul class="dropdown-menu">
                                                                        <li><a href="#">Menu 1.4</a></li>
                                                                     </ul>
                                                                 </li>
                                                              </ul>
                                                           </li>
                                                       </ul>
                                                   </li> --}}
                                               </ul>
                                           </li>
                                        </ul>
                                    </div>
                                  </div>
                                </div>

                            </div>
                        </div>
                    {{-- </div> --}}
                    <div class="side">
                        <h2>Khoảng giá</h2>
                        <form method="post" class="colorlib-form-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="guests">Từ:</label>
                                        <div class="form-field">
                                            <i class="icon icon-arrow-down3"></i>
                                            <select name="start" id="people" class="form-control">
                                                <option value="#">100.000 VNĐ</option>
                                                <option value="#">200.000 VNĐ</option>
                                                <option value="#">300.000 VNĐ</option>
                                                <option value="#">500.000 VNĐ</option>
                                                <option value="#">1.000.000 VNĐ</option>
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
                                                <option value="#">2.000.000 VNĐ</option>
                                                <option value="#">4.000.000 VNĐ</option>
                                                <option value="#">6.000.000 VNĐ</option>
                                                <option value="#">8.000.000 VNĐ</option>
                                                <option value="#">10.000.000 VNĐ</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" style="width: 100%;border: none;height: 40px;">Tìm
                                kiếm</button>
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
            }
        })
    })
    $('.navbar a.dropdown-toggle').on('click', function(e) {
        var $el = $(this);
        var $parent = $(this).offsetParent(".dropdown-menu");
        $(this).parent("li").toggleClass('open');
        if(!$parent.parent().hasClass('nav')) {
             $el.next().css({"top": $el[0].offsetTop, "left": $parent.outerWidth() - 4});
        }
        $('.nav li.open').not($(this).parents("li")).removeClass("open");
        return false;
       });
})
{{-- debounce --}}

</script>
@endpush
