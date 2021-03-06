@extends('layout.app')

@section('head_content')
CẬP NHẬT MẪU PHIẾU

@endsection
@section('link_content')
<h1>
  QUẢN LÝ MẪU PHIẾU
  <small>                
    <a href="" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách mẫu phiếu</li>
  <li class="active">Cập nhật mẫu phiếu</li>
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
  <form role="form" method="post" action="{{route('mauphieu.update',['mauphieu'=>$mauphieu->ID])}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field("PATCH") }}
    <div class="box-body">

      <div class="form-group">
        <label for="tenmauphieu">Tên mẫu phiếu</label>
        <input class="form-control" id="tenmauphieu" name="tenmauphieu" placeholder="Nhập tên mẫu phiếu" type="text" value="{{$mauphieu->TEN_TG}}" required>
      </div>

    </div>
    <!-- /.card-body -->

    <div class="box-footer">
      <button  class="btn btn-success"><a href="{{ route('mauphieu.index') }}" style="color: white;"> Trở về </a></button>
      <button type="submit" class="btn btn-primary"> Cập nhật </button>
    </div>
  </form>
</div>


@endsection