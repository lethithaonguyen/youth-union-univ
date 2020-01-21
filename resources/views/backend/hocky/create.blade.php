@extends('layout.app')

@section('head_content')
THÊM MỚI HỌC KỲ

@endsection
@section('link_content')
<h1>
  QUẢN LÝ HỌC KỲ
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách học kỳ</li>
  <li class="active">Thêm học kỳ</li>
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
  <form role="form" method="POST" action="{{ route('hocky.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="box-body">

      <div class="form-group">
        <label for="tennamhoc">Tên năm học</label>
        <div class="col-3">
          <select class="form-control" id="tennamhoc" name="tennamhoc">
           <option value="">--Chọn năm học-</option>
           @foreach($nh as $namhoc)
           <option value="{{$namhoc->ID}}">{{$namhoc->TEN_NH}}</option>
           @endforeach
         </select>
       </div>
     </div>

   <div class="form-group">
    <label for="tenhocky">Tên học kỳ</label>
    <input class="form-control" id="tenhocky" name="tenhocky" placeholder="Nhập tên học kỳ" type="text"  required>
  </div>

</div>
<!-- /.card-body -->

<div class="box-footer">
  <button  class="btn btn-success"><a href="{{ route('hocky.index') }}" style="color: white;"> Trở về </a></button>
  <button type="submit" class="btn btn-primary"> Lưu </button>
</div>
</form>
</div>


@endsection