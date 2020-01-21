@extends('layout.app')

@section('head_content')
CẬP NHẬT KIỂU DỮ LIỆU

@endsection
@section('link_content')
<h1>
  QUẢN LÝ KIỂU DỮ LIỆU
  <small>                
    <a href="" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách kiểu dữ liệu</li>
  <li class="active">Cập nhật kiểu dữ liệu</li>
</ol>
@endsection

@section('content')

@if(Session::has('success_message'))
<div class="alert alert-success" id="success-alert">
  <span class="glyphicon glyphicon-ok"></span>
  {!! session('success_message') !!}

  <button type="button" class="close" data-dismiss="alert" aria-label="close">
    <span aria-hidden="true">&times;</span>
  </button>

</div>
@endif
@if(Session::has('error_message'))
<div class="alert alert-danger" id="success-alert">
  <span class="glyphicon glyphicon-remove" ></span>
  {!! session('error_message') !!}

  <button type="button" class="close" data-dismiss="alert" aria-label="close">
    <span aria-hidden="true">&times;</span>
  </button>

</div>
@endif

<div class="box box-primary">
  <form role="form" method="post" action="{{route('kieu_dulieu.update',['kieu_dulieu'=>$kieu_dulieu->ID])}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field("PATCH") }}
    <div class="box-body">

      <div class="form-group">
        <label for="tenkieu_dulieu">Tên kiểu dữ liệu</label>
        <input class="form-control" id="tenkieu_dulieu" name="tenkieu_dulieu" placeholder="Nhập tên kiểu dữ liệu" type="text" value="{{$kieu_dulieu->TEN_KIEU_DULIEU}}" required>
      </div>

    </div>
    <!-- /.card-body -->

    <div class="box-footer">
      <button  class="btn btn-success"><a href="{{ route('kieu_dulieu.index') }}" style="color: white;">Trở về </a></button>
      <button type="submit" class="btn btn-primary"> Cập nhật </button>
    </div>
  </form>
</div>


@endsection