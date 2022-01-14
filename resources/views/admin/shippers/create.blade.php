@extends('admin.layouts.app', ['activePage' => 'users', 'title' => 'Tạo mới người dùng'])
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm Thành viên</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading"><i class="fas fa-user"></i> Thêm thành viên</div>

                 @if ($errors->any())
                @component('admin.layouts.components.alert')
                @slot('type', 'danger')
                @slot('stroke', 'cancel')
                {{ $errors->first() }}
                @endcomponent
                @endif

                <div class="panel-body">
                    <form action="/admin/shippers" method="POST">
                    @csrf
                    <div class="row justify-content-center" style="margin-bottom:40px">

                        <div class="col-md-8 col-lg-8 col-lg-offset-2">

                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control">
                                {{-- <div class="alert alert-danger" role="alert">
                                    <strong>email đã tồn tại!</strong>
                                </div> --}}
                            </div>
                            <div class="form-group">
                                <label>Full name</label>
                                <input type="name" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="address" name="address" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="phone" name="phone" class="form-control">
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-8 col-lg-8 col-lg-offset-2 text-right">

                                <button class="btn btn-success" type="submit">Thêm shipper</button>
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
