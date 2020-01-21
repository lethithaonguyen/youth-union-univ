@extends('layout.app')

@section('head_content')
THÊM MỚI THÀNH TÍCH
@endsection
@section('link_content')
<h1>
  QUẢN LÝ THÀNH TÍCH  

</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách thành tích</li>
  <li class="active">Thêm thành tích</li>
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
  <form role="form" method="POST" action="{{ route('thanhtich.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="box-body">

      <div class="form-group">
        <label for="tenthanhtich">Tên thành tích</label>
        <input class="form-control" id="tenthanhtich" name="tenthanhtich" placeholder="Nhập tên thành tích" type="text"  required>
      </div>

    </div>
    <!-- /.card-body -->

    <div class="box-footer">
      <button  class="btn btn-success"><a href="{{ route('thanhtich.index') }}" style="color: white;"> Trở về </a></button>
      <button type="submit" class="btn btn-primary"> Lưu </button>
    </div>
  </form>
</div>


@endsection