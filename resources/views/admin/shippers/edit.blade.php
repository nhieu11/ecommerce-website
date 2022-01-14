@extends('admin.layouts.app', ['activePage' => 'shipper', 'title' => 'Cập nhật thông tin shipper'])
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Sửa Thông Tin Shipper</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading"><i class="fas fa-user"></i> Sửa thông tin shipper - admin@gmail.com</div>

                @if ($errors->any())
                @component('admin.layouts.components.alert')
                @slot('type', 'danger')
                @slot('stroke', 'cancel')
                {{ $errors->first() }}
                @endcomponent
                @endif

                <div class="panel-body">
                    <form action="/admin/shippers/{{$shipper->id}}" method="POST">
                        @csrf
                        @method('PUT')
                    <div class="row justify-content-center" style="margin-bottom:40px">

                        <div class="col-md-8 col-lg-8 col-lg-offset-2">

                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control" value="{{$shipper->email}}">
                                {{-- <div class="alert alert-danger" role="alert">
                                    <strong>email đã tồn tại!</strong>
                                </div> --}}
                            </div>
                            {{-- <div class="form-group">
                                <label>password</label>
                                <input type="text" name="password" class="form-control" value="{{$user->password}}">
                            </div> --}}
                            <div class="form-group">
                                <label>Full name</label>
                                <input type="name" name="name" class="form-control" value="{{$shipper->name}}">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="address" name="address" class="form-control" value="{{$shipper->address}}">
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="phone" name="phone" class="form-control" value="{{$shipper->phone}}">
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-8 col-lg-8 col-lg-offset-2 text-right">

                                <button class="btn btn-success" name="add-user" type="submit">Sửa thông tin shipper</button>
                                <button class="btn btn-danger" type="reset">Huỷ bỏ</button>
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
@endsection
