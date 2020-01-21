@extends('layout.app')

@section('head_content')
THÊM MỚI ĐOÀN PHÍ THEO THÁNG NĂM

@endsection
@section('link_content')
<h1>
  QUẢN LÝ ĐOÀN PHÍ THEO THÁNG NĂM
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách đoàn phí theo tháng năm</li>
  <li class="active">Thêm đoàn phí theo tháng năm</li>
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
  <form role="form" method="POST" action="{{ route('thangnam.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="box-body">
      <div class="form-group">
        <label for="namhoc">Năm học</label>
        <select class="form-control" id="namhoc" name="namhoc">
         <option value="">--Chọn Năm Học--</option>
         @foreach($nh as $namhoc)
         <option value="{{ $namhoc->ID }}">{{ $namhoc->TEN_NH }}</option>
         @endforeach
       </select>
     </div>

     <div class="form-group">
      <div class="input-group">
        <span class="input-group-addon">
          <label for="dtb2">Số tiền đoàn phí</label>
        </span>
        <input type="text" class="form-control" id="sotiendoanphi" name="sotiendoanphi">
      </div>
    </div>


  </div>
  <!-- /.card-body -->

  <div class="box-footer">
    <button  class="btn btn-success"><a href="{{ route('thangnam.index') }}" style="color: white;"> Trở về </a></button>
    <button type="submit" class="btn btn-primary"> Tạo tháng  </button>
  </div>
</form>
</div>


@endsection