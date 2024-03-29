@extends('admin.layouts.app', ['activePage' => 'shippers', 'title' => 'Danh sách shipper'])
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li class="active">Danh sách shipper</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">

            <div class="panel panel-primary">

                <div class="panel-body">
                    <div class="bootstrap-table">
                        <div class="table-responsive">
                        {{--   <div class="alert bg-success" role="alert">
                                <svg class="glyph stroked checkmark">
                                    <use xlink:href="#stroked-checkmark"></use>
                                </svg>Đã thêm thành công<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                            </div> --}}
                            <a href="/admin/shippers/create" class="btn btn-primary">Thêm Shipper</a>
                            <table class="table table-bordered" style="margin-top:20px;">

                                <thead>
                                    <tr class="bg-primary">
                                        <th>ID</th>
                                        <th>Email</th>
                                        <th>Full</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th width='18%'>Tùy chọn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($shippers as $shipper)
                                <tr>
                                        <td>{{ $shipper->id }}</td>
                                        <td>{{ $shipper->email }}</td>
                                        <td>{{ $shipper->name }}</td>
                                        <td>{{ $shipper->address }}</td>
                                        <td>{{ $shipper->phone ?? '' }}</td>
                                        {{--  <td>{{ $shipper->created_at ?? '' }}</td>  --}}

                                        <td>
                                            <a href="/admin/shippers/{{$shipper->id}}/edit" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</a>
                                            <a href="/admin/shippers/{{$shipper->id}}" class="btn btn-danger btn-destroy"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6">Không có bản ghi</td>
                                    </tr>
                                @endforelse

                                </tbody>
                            </table>
                            <div class='text-right'>
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
