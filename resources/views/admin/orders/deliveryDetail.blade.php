@extends('admin.layouts.app', ['title' => 'Chi tiết đơn hàng', 'activePage' => 'orders'])
@section('content')
<!--main-->
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home">
							<use xlink:href="#stroked-home"></use>
						</svg></a></li>
				<li class="active">Đơn hàng / Chi tiết đặt hàng</li>
			</ol>
		</div>
		<!--/.row-->
		<div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12">

				<div class="panel panel-primary">
                    <div class="panel-heading">Chi tiết đặt hàng</div>

                                @if ($errors->any())
                                @component('admin.layouts.components.alert')
                                @slot('type', 'danger')
                                @slot('stroke', 'cancel')
                                {{ $errors->first() }}
                                @endcomponent
                                @endif

					<div class="panel-body">
                        <form action="/admin/orders/any" method="post" >
						<div class="bootstrap-table">
							<div class="table-responsive">
								<div class="form-group">
									<div class="row">
										<div class="col-md-6">
											<div class="panel panel-blue">
												<div class="panel-heading dark-overlay">Thông tin khách hàng</div>
												<div class="panel-body">
													<strong><span class="glyphicon glyphicon-user" aria-hidden="true"></span> : {{$order->name}}</strong> <br>
													<strong><span class="glyphicon glyphicon-phone" aria-hidden="true"></span> : {{$order->phone}}</strong> <br>
													<strong><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> : {{$order->email}}</strong>
													<br>
													<strong><span class="glyphicon glyphicon-send" aria-hidden="true"></span> : {{$order->address}}</strong>
												</div>
											</div>
										</div>
									</div>


								</div>

								<!-- Button trigger modal -->
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
									Thêm sản phẩm
								</button>
								
									{{-- {{ method_field('put') }} --}}
									<!-- Modal -->
									<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<form action="/admin/orders" method="post" enctype="multipart/form-data">
												@csrf
												@method('PUT')
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLongTitle">Nhập mã sản phẩm</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<input id="sku" type="text" name="sku" />
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
													<button type="submit" class="btn btn-primary">Xác nhận</button>
												</div>
												<div class="clearfix"></div>
											</form>
										</div>
										</div>
									</div>

								<table class="table table-bordered" style="margin-top:20px;">
									<thead>
										<tr class="bg-primary">
											<th>ID</th>
											<th>Thông tin Sản phẩm</th>
											<th>Giá sản phẩm</th>
											<th>Thành tiền</th>
                                            <th>Thời gian tạo đơn hàng</th>
                                            <th>Thời gian bàn giao hàng</th>
											<th width='18%'>Tùy chọn</th>
										</tr>
									</thead>
									<tbody>
                                            @foreach ($order->orderDetail as $item)
                                            <tr>
                                                <td>{{$item->id}}</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <img width="100px" src="{{$item->avatar}}" class="thumbnail">
                                                        </div>
                                                        <div class="col-md-8">
                                                            <p><b>Mã sản phẩm</b>: {{$item->sku}}</p>
                                                            <p><b>Tên Sản phẩm</b>: {{$order->name}}</p>
                                                            <p><b>Số lương</b> : {{$item->quantity}}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ number_format($item->price) }} VNĐ</td>
                                                <td>{{ number_format(($item->price)*($item->quantity)) }} VNĐ</td>
                                                <td>{{Carbon\Carbon::parse($item->created_at)->toDayDateTimeString()}}</td>
                                                <td>{{Carbon\Carbon::parse($item->dateHandOver)->toDayDateTimeString()}}</td>
												<td>
													<a href="/admin/orders/{{$order->id}}/{{$item->product_id}}" class="btn btn-danger btn-destroy"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</a>
												</td>
                                            </tr>
                                            @endforeach
									</tbody>

								</table>
								<table class="table">
									<thead>
										<tr>
											<th width='70%'>
												<h4 align='right'>Tổng Tiền :</h4>
											</th>
											<th>
												<h4 align='right' style="color: brown;">{{ number_format($order->total) }} VNĐ</h4>
											</th>

										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
								<div class="alert alert-primary" role="alert" align='right'>
									<a onclick="return complete()" class="btn btn-success" href="/admin/orders/delivery" role="button">Xác nhận</a>
								</div>
							</div>
                        </div>
                        </form>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
		<!--/.row-->


	</div>
	<!--end main-->
@endsection
@push('adminJs')
    <script>
        function complete(){
            return confirm("Đơn hàng sau khi xử lý sẽ được tính vào doanh thu!!")
        }
		
		$(document).ready(function(){
        $(".btn-destroy").on("click", function(e){
            e.preventDefault()
            if (confirm("Bạn có chắc muốn xóa sản phẩm này khỏi đơn hàng không ?")) {
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
