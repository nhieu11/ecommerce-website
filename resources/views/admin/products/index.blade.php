@extends('admin.layouts.app', ['title' => 'Danh sách sản phẩm', 'activePage' => 'products' ])
@section('content')
<!--main-->
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home">
							<use xlink:href="#stroked-home"></use>
						</svg></a></li>
				<li class="active">Danh sách sản phẩm</li>
			</ol>
		</div>
		<!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Danh sách sản phẩm</h1>
			</div>
		</div>
		<!--/.row-->

		<div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12">

				<div class="panel panel-primary">

					<div class="panel-body">
						<div class="bootstrap-table">
							<div class="table-responsive">
								<div class="alert bg-success" role="alert">
									<svg class="glyph stroked checkmark">
										<use xlink:href="#stroked-checkmark"></use>
									</svg>Đã thêm thành công<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
								</div>
								<a href="/admin/products/create" class="btn btn-primary">Thêm sản phẩm</a>
								<table class="table table-bordered" style="margin-top:20px;">

									<thead>
										<tr class="bg-primary">
											<th>ID</th>
											<th>Thông tin sản phẩm</th>
											<th>Giá sản phẩm</th>
											<th>Tình trạng</th>
											<th>Danh mục</th>
											<th width='18%'>Tùy chọn</th>
										</tr>
									</thead>
									<tbody>

                                        @forelse ($products as $item)
										<tr>
											<td>{{$item->id}}</td>
											<td>
												<div class="row">
													<div class="col-md-3"><img src="{{$item->avatar}}" alt="{{$item->name}}" width="100px" class="thumbnail"></div>
													<div class="col-md-9">
														<p><strong>Mã sản phẩm : {{ $item->sku }}</strong></p>
														<p>Tên sản phẩm : {{ $item->name }}</p>


													</div>
												</div>
											</td>
											<td> {{ number_format($item->price) }}</td>
											<td>
												<a class="btn btn-{{ $item->quantity>0 ? 'success' : 'danger' }}" href="#" role="button">{{$item->quantity>0 ? 'Còn hàng' : 'Hết hàng'}}</a>
											</td>
											<td>{{ optional($item->category)->name }}</td> {{-- $item là 1 bản ghi product, hàm category() định nghĩa ở entities/product --}}
											<td>
												<a href="/admin/products/{{$item->id}}/edit" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</a>
												<a href="/admin/products/{{$item->id}}" class="btn btn-danger btn-destroy"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</a>
											</td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6">Không có bản ghi</td>
                                            </tr>
                                        @endforelse

										{{--  <tr>
											<td>1</td>
											<td>
												<div class="row">
													<div class="col-md-3"><img src="/assets/admin/img/ao-khoac.jpg" alt="Áo đẹp" width="100px" class="thumbnail"></div>
													<div class="col-md-9">
														<p><strong>Mã sản phẩm : SP01</strong></p>
														<p>Tên sản phẩm :Áo Khoác Bomber Nỉ Xanh Lá Cây AK179</p>


													</div>
												</div>
											</td>
											<td>500.000 VND</td>
											<td>
												<a class="btn btn-danger" href="#" role="button">hết hàng</a>
											</td>
											<td>Áo Khoác Nam</td>
											<td >
												<a href="#" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</a>
												<a href="#" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</a>
											</td>
										</tr>  --}}


									</tbody>
								</table>
								<div align='right'>
									<ul class="pagination">
										<li class="page-item"><a class="page-link" href="#">Trở lại</a></li>
										<li class="page-item"><a class="page-link" href="#">1</a></li>
										<li class="page-item"><a class="page-link" href="#">2</a></li>
										<li class="page-item"><a class="page-link" href="#">3</a></li>
										<li class="page-item"><a class="page-link" href="#">tiếp theo</a></li>
									</ul>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>

					</div>
				</div>
				<!--/.row-->


			</div>
        </div>
    </div>
<!--end main-->
@endsection


@push('adminJs')
<script>
    $(document).ready(function(){
        $(".btn-destroy").on("click", function(e){
            e.preventDefault()
            if (confirm("Bạn có chắc?")) {
               $.ajax({
                   url: $(this).attr('href'),
                   method: "POST",
                   data: {
                       _token: "{{ csrf_token() }}",
                       _method: "DELETE"
                   },
                   success: function(){
                       window.location.reload()
                   }
               }) //Truyền vào 1 obj
            }
        })
    })
</script>
@endpush
