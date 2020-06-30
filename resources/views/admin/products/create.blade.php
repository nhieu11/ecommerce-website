@extends('admin.layouts.app', ['title' => 'Danh sách sản phẩm', 'activePage' => 'products' ])
@section('content')
<!--main-->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm sản phẩm</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-xs-6 col-md-12 col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Thêm sản phẩm</div>
                @if ($errors->any())
                {{--  <div class="alert bg-{{ $type ?? 'danger' }}" role="alert">
                <svg class="glyph stroked {{ $stroke }}">
                <use xlink:href="#stroked-{{ $stroke }}"></use>
                </svg> {{ $slot }}
                <a href="#" class="pull-right">
                <span class="glyphicon glyphicon-remove"></span>
                </a>
                    </div>  --}}
                    @component('admin.layouts.components.arlert')
                    @slot('type','danger')
                    @slot('stroke','cancel')
                    {{ $errors->first() }}
                    @endcomponent
                @endif
                <div class="panel-body">
                    <form action="/admin/products" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row" style="margin-bottom:40px">

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Danh mục</label>
                                        <select name="category_id" class="form-control">
                                            <option value='1' selected>Nam</option>
                                            <option value='3'>---|Áo khoác nam</option>
                                            <option value='2'>Nữ</option>
                                            <option value='4'>---|Áo khoác nữ</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Mã sản phẩm</label>
                                        <input type="text" name="sku" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Tên sản phẩm</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Giá sản phẩm (Giá chung)</label>
                                        <input type="number" name="price" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Sản phẩm có nổi bật</label>
                                        <select name="featured" class="form-control">
                                            <option value="0">Không</option>
                                            <option value="1">Có</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Số lượng</label>
                                        <input type="number" class="form-control" name="quantity">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Ảnh sản phẩm</label>
                                        <input id="img" type="file" name="img" class="form-control hidden"
                                            onchange="changeImg(this)">
                                        <img id="avatar" class="thumbnail" width="100%" height="350px" src="/assets/admin/img/import-img.png">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Thông tin</label>
                                        <textarea name="detail" style="width: 100%;height: 100px;"></textarea>
                                    </div>
                                 </div>



                    </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Miêu tả</label>
                                    <textarea id="editor" name="description" style="width: 100%;height: 100px;"></textarea>
                                </div>
                                <button class="btn btn-success" type="submit">Thêm sản phẩm</button>
                                <button class="btn btn-danger" type="reset">Huỷ bỏ</button>
                            </div>
                        </div>
                    <div class="clearfix"></div>

                    </form>
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
    function changeImg(input){
           //Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới
           if(input.files && input.files[0]){
               var reader = new FileReader();
               //Sự kiện file đã được load vào website
               reader.onload = function(e){
                   //Thay đổi đường dẫn ảnh
                   $('#avatar').attr('src',e.target.result);
               }
               reader.readAsDataURL(input.files[0]);
           }
       }
       $(document).ready(function() {
           $('#avatar').click(function(){
               $('#img').click();
           });
       });

</script>
@endpush
