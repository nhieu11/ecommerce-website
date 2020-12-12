@extends('admin.layouts.app', ['activePage' => 'coupon', 'title' => 'Danh mục'])
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li class="active">Mã giảm giá</li>
        </ol>
    </div>
    <!--/.row-->
    <div class="table-agile-info">
        <div class="panel panel-default">
          <div class="panel-heading">
            Liệt kê mã giảm giá
          </div>

          <div class="row w3-res-tb">
            {{-- <div class="col-sm-5 m-b-xs">
              <select class="input-sm form-control w-sm inline v-middle">
                <option value="0">Bulk action</option>
                <option value="1">Delete selected</option>
                <option value="2">Bulk edit</option>
                <option value="3">Export</option>
              </select>
              <button class="btn btn-sm btn-default">Apply</button>
            </div> --}}
            <div class="col-sm-4">
            </div>
            {{-- <div class="col-sm-3">
              <div class="input-group">
                <input type="text" class="input-sm form-control" placeholder="Search">
                <span class="input-group-btn">
                  <button class="btn btn-sm btn-default" type="button">Go!</button>
                </span>
              </div>
            </div> --}}
          </div>
          <div class="table-responsive">
                            <?php
                                  $message = Session::get('message');
                                  if($message){
                                      echo '<span class="text-alert">'.$message.'</span>';
                                      Session::put('message',null);
                                  }
                                  ?>
            <table class="table table-striped b-t b-light">
              <thead>
                <tr>


                  <th>Tên mã giảm giá</th>
                  <th>Mã giảm giá</th>
                  <th>Số lượng giảm giá</th>
                  <th>Điều kiện giảm giá</th>
                  <th>Số giảm</th>



                </tr>
              </thead>
              <tbody>
                @foreach($coupon as $key => $cou)
                <tr>

                  <td>{{ $cou->coupon_name }}</td>
                  <td>{{ $cou->coupon_code }}</td>
                  <td>{{ $cou->coupon_time }}</td>
                  <td><span class="text-ellipsis">
                    <?php
                     if($cou->coupon_condition==1){
                      ?>
                      Giảm theo %
                      <?php
                       }else{
                      ?>
                      Giảm theo tiền
                      <?php
                     }
                    ?>
                  </span>
                </td>
                   <td><span class="text-ellipsis">
                    <?php
                     if($cou->coupon_condition==1){
                      ?>
                      Giảm {{$cou->coupon_number}} %
                      <?php
                       }else{
                      ?>
                      Giảm {{$cou->coupon_number}} k
                      <?php
                     }
                    ?>
                  </span></td>

                  <td>

                    <a onclick="return confirm('Bạn có chắc là muốn xóa mã này ko?')" href="{{URL::to('admin/coupon/delete-coupon/'.$cou->coupon_id)}}" class="active styling-edit" ui-toggle-class="">
                      <i class="fa fa-times text-danger text"></i>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <footer class="panel-footer">
            <div class="row">

              <div class="col-sm-5 text-center">
                <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
              </div>
              <div class="col-sm-7 text-right text-center-xs">
                <ul class="pagination pagination-sm m-t-none m-b-none">
                   {!!$coupon->links()!!}
                </ul>
              </div>
            </div>
            <a href="/admin/coupon/insert_coupon" class="btn btn-primary">Tạo mới</a>
          </footer>
        </div>
      </div>

    {{-- <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Quản lý danh mục</h1>
        </div>
    </div>
    <!--/.row-->
    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-5">
                            <a href="/admin/categories/create" class="btn btn-primary">Tạo mới</a>
                            <h3 style="margin: 0;"><strong>Phân cấp Menu</strong></h3>
                            <div class="vertical-menu">
                                <div class="item-menu active">Danh mục </div>


                                @include('admin.categories.row', ['level' => 0 ])


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/.col-->


    </div>
    <!--/.row--> --}}
</div>
<!--/.main-->
@endsection
