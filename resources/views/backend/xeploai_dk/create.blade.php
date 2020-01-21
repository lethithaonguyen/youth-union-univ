@extends('layout.app')

@section('head_content')
THÊM MỚI XẾP LOẠI ĐOÀN KHOA

@endsection
@section('link_content')
<h1>
  QUẢN LÝ XẾP LOẠI ĐOÀN KHOA
  <small>                
    <a href="" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách xếp loại đoàn khoa</li>
  <li class="active">Thêm xếp loại đoàn khoa</li>
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
  <form role="form" method="POST" action="{{ route('xeploai_dk.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="box-body">

      <div class="form-group">
        <label for="tenxeploai_dk">Tên xếp loại đoàn khoa</label>
        <input class="form-control" id="tenxeploai_dk" name="tenxeploai_dk" placeholder="Nhập tên xếp loại đoàn khoa" type="text"  required>
        
         <label for="diemdat_dk">Điểm đạt đoàn khoa</label>
        <input class="form-control" id="diemdat_dk" name="diemdat_dk" placeholder="Nhập điểm đạt đoàn khoa" type="text"  required>
      </div>

    </div>
    <!-- /.card-body -->

    <div class="box-footer">
      <button  class="btn btn-success"><a href="{{ route('xeploai_dk.index') }}" style="color: white;"> Trở về </a></button>
      <button type="submit" class="btn btn-primary"> Lưu </button>
    </div>
  </form>
</div>


@endsection