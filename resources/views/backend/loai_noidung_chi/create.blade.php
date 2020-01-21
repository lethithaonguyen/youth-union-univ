@extends('layout.app')

@section('head_content')
THÊM MỚI LOẠI NỘI DUNG CHI

@endsection
@section('link_content')
<h1>
  QUẢN LÝ LOẠI NỘI DUNG CHI
  <small>                
    <a href="" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách loại nội dung chi</li>
  <li class="active">Thêm loại nội dung chi</li>
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
  <form role="form" method="POST" action="{{ route('loai_noidung_chi.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="box-body">

      <div class="form-group">
        <label for="tenloai_noidung_chi">Tên loại nội dung chi</label>
        <input class="form-control" id="tenloai_noidung_chi" name="tenloai_noidung_chi" placeholder="Nhập tên loại nội dung chi" type="text"  required>
      </div>

    </div>
    <!-- /.card-body -->

    <div class="box-footer">
      <button  class="btn btn-success"><a href="{{ route('loai_noidung_chi.index') }}" style="color: white;"> Trở về</a></button>
      <button type="submit" class="btn btn-primary"> Lưu </button>
    </div>
  </form>
</div>


@endsection