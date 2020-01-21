@extends('layout.app')

@section('head_content')
THÊM MỚI NGƯỜI DÙNG

@endsection
@section('link_content')
<h1>
  QUẢN LÝ NGƯỜI DÙNG
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách người dùng</li>
  <li class="active">Thêm người dùng</li>
</ol>
@endsection

@section('content')

@if(Session::has('success_message'))
<div class="alert alert-success"id="success-alert">
  <span class="glyphicon glyphicon-ok"></span>
  {!! session('success_message') !!}

  <button type="button" class="close" data-dismiss="alert" aria-label="close">
    <span aria-hidden="true">&times;</span>
  </button>

</div>
@endif
@if(Session::has('error_message'))
<div class="alert alert-danger" id="success-alert">
  <span class="glyphicon glyphicon-remove"></span>
  {!! session('error_message') !!}

  <button type="button" class="close" data-dismiss="alert" aria-label="close">
    <span aria-hidden="true">&times;</span>
  </button>

</div>
@endif

<div class="box box-primary">
  <form role="form" method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="box-body">

      <div class="form-group">
        <label for="doanvien">Tên đoàn viên</label>
        <div class="col-3">
          <select class="form-control" id="doanvien" name="doanvien">
           <option value="">--Chọn đoàn viên-</option>
           @foreach($dv_tn as $doanvien_thanhnien)
           <option value="{{$doanvien_thanhnien->ID}}">{{$doanvien_thanhnien->TEN_SV}}-{{$doanvien_thanhnien->MSSV}}</option>
           @endforeach
         </select>
       </div>
     </div>

     <div class="form-group">
      <label for="vaitro">Tên vai trò</label>
      <div class="col-3">
        <select class="form-control" id="vaitro" name="vaitro">
         <option value="">--Chọn vai trò-</option>
         @foreach($vt as $vaitro)
         <option value="{{$vaitro->ID}}">{{$vaitro->TEN_VT}}</option>
         @endforeach
       </select>
     </div>
   </div>

   <div class="form-group">
    <label for="email">Email đăng nhập</label>
    <input class="form-control" id="email" name="email" placeholder="Nhập email" type="email"  required>
  </div>

  <div class="form-group">
    <label for="matkhau">Mật khẩu</label>
    <input class="form-control" id="matkhau" name="matkhau" placeholder="Nhập mật khẩu" type="password"  required>
  </div>

</div>
<!-- /.card-body -->

<div class="box-footer">
  <button  class="btn btn-success"><a href="{{ route('users.index') }}" style="color: white;"> Trở về </a></button>
  <button type="submit" class="btn btn-primary"> Lưu </button>
</div>
</form>
</div>


@endsection