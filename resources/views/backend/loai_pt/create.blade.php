@extends('layout.app')

@section('head_content')
THÊM MỚI LOẠI PHONG TRÀO

@endsection
@section('link_content')
<h1>
  QUẢN LÝ LOẠI PHONG TRÀO
  <small>                
    <a href="" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách loại phong trào</li>
  <li class="active">Thêm loại phong trào</li>
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
  <form role="form" method="POST" action="{{ route('loai_pt.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="box-body">

      <div class="form-group">
        <label for="tenloai_pt">Tên loại phong trào</label>
        <input class="form-control" id="tenloai_pt" name="tenloai_pt" placeholder="Nhập tên loại phong trào" type="text"  required>
      </div>

    </div>
    <!-- /.card-body -->

    <div class="box-footer">
      <button  class="btn btn-success"><a href="{{ route('loai_pt.index') }}" style="color: white;"> Trở về </a></button>
      <button type="submit" class="btn btn-primary"> Lưu </button>
    </div>
  </form>
</div>


@endsection