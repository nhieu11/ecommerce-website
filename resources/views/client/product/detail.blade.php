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
										<div class="product-img" style="background-image: url({{$product->avatar}});">

										</div>

									</div>
								</div>
								<div class="col-md-7">
									<form action="product/AddCart" method="post">

										<div class="desc">
											<h3>{{$product->name}}</h3>
											<p class="price">
												<span>{{ number_format($product->price) }} VND</span>
											</p>
											<p>Thông tin</p>
											<p style="text-align: justify;">
												{{--  HUST STORE sẽ giao hàng tận nơi khi chọn mua sản phẩm: Áo Sơ Mi Trắng Kem ASM844. Hoặc quí khách có thể đến tại địa chỉ shop có hiển thị bên dưới, khi chọn size phù hợp để xem và thử trực tiếp.  --}}
                                                {{$product->detail}}
											</p>


											<div class="row row-pb-sm">
												<div class="col-md-4">
													<div class="input-group">
														<span class="input-group-btn">
															<button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
																<i class="icon-minus2"></i>
															</button>
														</span>
														<input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
														<span class="input-group-btn">
															<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
																<i class="icon-plus2"></i>
															</button>
														</span>
													</div>
												</div>
											</div>
											<input type="hidden" name="id_product" value="1">
											<p><button class="btn btn-primary btn-addtocart" type="submit"> Thêm vào giỏ hàng</button></p>
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
										{{$product->description}}
									</div>
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
						<h2><span>Sản phẩm Mới</span></h2>
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
                                        <span class="addtocart"><a href="product/{{$prd->category_id}}/{{$prd->id}}"><i
                                                    class="icon-shopping-cart"></i></a></span>
                                        <span><a href="product/{{$prd->category_id}}/{{$prd->id}}"><i class="icon-eye"></i></a></span>


                                    </p>
                                </div>
                            </div>
                            <div class="desc">
                                <h3><a href="product/{{$prd->category_id}}/{{$prd->id}}">{{$prd->name}}</a></h3>
                                <p class="price"><span>{{number_format($prd->price,0,'',',')}} VND</span></p>
                            </div>
                        </div>
                    </div>
                    @endforeach
				</div>
			</div>
		</div>
		<!-- end main -->
@endsection
