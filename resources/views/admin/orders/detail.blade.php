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

                @if($errors->any())
                    @component('admin.layouts.components.alert')
                        @slot('type', 'danger')
                            @slot('stroke', 'cancel')
                                {{ $errors->first() }}
                            @endcomponent
                        @endif

                        <div class="panel-body">
                            <form action="/admin/orders/{{ $order->id }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="bootstrap-table">
                                    <div class="table-responsive">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="panel panel-blue">
                                                        <div class="panel-heading dark-overlay">Thông tin khách hàng
                                                        </div>
                                                        <div class="panel-body">
                                                            <strong><span class="glyphicon glyphicon-user"
                                                                    aria-hidden="true"></span> :
                                                                {{ $order->name }}</strong> <br>
                                                            <strong><span class="glyphicon glyphicon-phone"
                                                                    aria-hidden="true"></span> :
                                                                {{ $order->phone }}</strong>
                                                            <br>
                                                            <strong><span class="glyphicon glyphicon-send"
                                                                    aria-hidden="true"></span> :
                                                                {{ $order->address }}</strong>
                                                        </div>
                                                    </div>
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

                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach($order->orderDetail as $item)
                                                    <tr>
                                                        <td>{{ $item->id }}</td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <img width="100px" src="{{ $item->avatar }}"
                                                                        class="thumbnail">
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <p><b>Mã sản phẩm</b>: {{ $item->sku }}</p>
                                                                    <p><b>Tên Sản phẩm</b>: {{ $item->name }}</p>
                                                                    <p><b>Số lương</b> : {{ $item->quantity }}</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{ number_format($item->price) }} VNĐ</td>
                                                        <td>{{ number_format(($item->price)*($item->quantity)) }}
                                                            VNĐ</td>
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
                                                        <h4 align='right' style="color: brown;">
                                                            {{ number_format($order->total) }} VNĐ</h4>
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>

                                        <div class="form-group">
                                            <label>Chọn shipper</label>

                                            <select name="shipper_id" class="form-control">
                                                @foreach($shippers as $shipper)
                                                    <option value='{{ $shipper->id }}'>
                                                        {{ $shipper->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="alert alert-primary" role="alert" align='right'>
											<button onclick="return complete()" class="btn btn-success" type="submit">Bàn giao</button>
                                        </div>

                                    </div>
                                </div>
                                {{-- </form> --}}
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
        function complete() {
            return confirm("Đơn hàng sau khi xử lý sẽ được tính vào doanh thu!!")
        }

    </script>
@endpush
