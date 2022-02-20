@extends('admin.layouts.app', ['title' => 'Đơn đã xử lý', 'activePage' => 'processed'])
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
					<div class="panel-heading">Danh sách đơn đặt hàng đã xử lý</div>
					<div class="panel-body">
						<div class="bootstrap-table">
							<div class="table-responsive">
								<a href="/admin/orders" class="btn btn-warning"><span class="glyphicon glyphicon-gift"></span>Đơn Chưa xử lý</a>
								<table class="table table-bordered" style="margin-top:20px;">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>ID</th>
                                            <th>Tên khách hàng</th>
                                            <th>Tên shipper</th>
                                            <th>Email</th>
                                            <th>Sđt</th>
                                            <th>Địa chỉ</th>
                                            <th>Thời gian</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{($item->shipper)->name}}</td>

                                            <td>{{$item->email}}</td>
                                            <td>{{$item->phone}}</td>
                                            <td>{{$item->address}}</td>
                                            <td>{{Carbon\Carbon::parse($item->updated_at)->format('d-m-Y')}}</td>
                                            <td>
                                                <a href="/admin/orders/{{$item->id}}/processed" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i>Xử lý</a>
                                            </td>
                                        </tr>
                                        @endforeach

                                        {{-- <tr>
                                            <td>1</td>
                                            <td>Nguyễn thế phúc</td>
                                            <td>admin@gmail.com</td>
                                            <td>0906013526</td>
                                            <td>Thường tín , hà nội</td>
                                            <td>2018-12-06 02:05:30</td>
                                        </tr> --}}
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
