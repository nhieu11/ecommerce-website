@extends('admin.layouts.app', ['title' => 'Đơn hàng đã hủy', 'activePage' => 'failed'])
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
					<div class="panel-heading">Danh sách đơn hàng đã hủy</div>
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
                                            <th>Phone</th>
                                            <th>Địa chỉ</th>
                                            <th>Shipper</th>
                                            <th>Thời gian tạo đơn hàng</th>
                                            <th>Thời gian bàn giao hàng</th>
                                            <th>Thời gian hoàn thành đơn hàng</th>
                                            <th>Xem chi tiết</th>
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
                                            <td>ABC</td>
                                            <td>{{Carbon\Carbon::parse($item->created_at)->toDayDateTimeString()}}</td>
                                            <td>{{Carbon\Carbon::parse($item->dateHandOver)->toDayDateTimeString()}}</td>
                                            <td>{{Carbon\Carbon::parse($item->dateCollection)->toDayDateTimeString()}}</td>
                                            <td>
                                                <a href="/admin/orders/{{$item->id}}/failed-detail" class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i>Xem chi tiết</a>
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
