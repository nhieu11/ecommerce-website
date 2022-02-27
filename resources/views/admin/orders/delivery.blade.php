@extends('admin.layouts.app', ['title' => 'Đơn đang vận chuyển', 'activePage' => 'delivery'])
@section('content')
	<!--main-->
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home">
							<use xlink:href="#stroked-home"></use>
						</svg></a></li>
				<li class="active">Đơn hàng</li>
			</ol>
		</div>
		<!--/.row-->
		<div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12">

				<div class="panel panel-primary">
					<div class="panel-heading">Danh sách đơn đặt hàng đang vận chuyển</div>
					<div class="panel-body">
						<div class="bootstrap-table">
							<div class="table-responsive">
							{{--  	<a href="/admin/orders" class="btn btn-warning"><span class="glyphicon glyphicon-gift"></span>Đơn Hàng Đang Vận Chuyển</a>  --}}
								<table class="table table-bordered" style="margin-top:20px;">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>ID</th>
                                            <th>Tên khách hàng</th>
                                            <th>Email</th>
                                            <th>Sđt</th>
                                            <th>Địa chỉ</th>
                                            <th>Thời gian tạo đơn hàng</th>
                                            <th>Thời gian bàn giao hàng</th>
                                            <th>Xử lý đơn hàng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->email}}</td>
                                            <td>{{$item->phone}}</td>
                                            <td>{{$item->address}}</td>
                                            <td>{{Carbon\Carbon::parse($item->created_at)->toDayDateTimeString()}}</td>
                                            <td>{{Carbon\Carbon::parse($item->dateHandOver)->toDayDateTimeString()}}</td>
                                            <td >
                                                {{-- <a onclick="return complete()" class="{{ $item->processed ==  3 ? 'd-none' : 'btn btn-warning'  }}" href="/admin/orders/complete/{{$item->id}}">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>Hoàn thành
                                                </a> --}}
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      Xử lý
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                      <a class="dropdown-item" onclick="return complete()"  href="/admin/orders/complete/{{$item->id}}">Thành công</a>
                                                      <a class="dropdown-item" href="/admin/orders/{{$item->id}}/delivery-detail">Đổi hàng</a>
                                                      <a class="dropdown-item" href="/admin/orders/{{$item->id}}/delivery-detail">Trả 1 phần hàng</a>
                                                      <a class="dropdown-item" onclick="return cancel()" href="/admin/orders/cancel/{{$item->id}}">Thất bại</a>
                                                    </div>
                                                  </div>
											</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
							</div>
						</div>
                        <div class="clearfix"></div>
                        <div align="right">
                            {{$orders->links()}}
                        </div>
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
        function cancel(){
            return confirm("Bạn có chắc muốn hủy đơn hàng ?")
        }
    </script>
@endpush
