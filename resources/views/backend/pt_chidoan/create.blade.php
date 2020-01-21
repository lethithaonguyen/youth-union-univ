@extends('layout.app')

@section('head_content')
THÊM MỚI PHONG TRÀO CHI ĐOÀN <b>{{Session::get('session_ten_chidoan_sv')}}</b>

@endsection
@section('link_content')
<h1>
  QUẢN LÝ PHONG TRÀO CHI ĐOÀN
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách phong trào chi đoàn</li>
  <li class="active">Thêm phong trào chi đoàn</li>
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
  <form role="form" method="POST" action="{{ route('pt_chidoan.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="box-body">

      <div class="form-group">
        <label for="tenchidoan">Tên chi đoàn</label>
        <div class="col-3">
          <select class="form-control" id="tenchidoan" name="tenchidoan">
           <option value="">--Chọn chi đoàn-</option>
           @foreach($cd as $chidoan)
           <option value="{{$chidoan->ID}}">{{$chidoan->TEN_CD}}</option>
           @endforeach
         </select>
       </div>
     </div>
{{--      <div class="form-group">
      <label for="tenchidoan">Tên chi đoàn</label>
      @foreach($cd as $chidoan)
      <input class="form-control" id="tenchidoan" name="tenchidoan" placeholder="Nhập tên chi đoàn" type="text" value="{{$chidoan->TEN_CD}}">
      @endforeach
    </div> --}}
    <div class="form-group">
      <label for="tenloai_pt">Tên loại phong trào</label>
      <div class="col-3">
        <select class="form-control" id="tenloai_pt" name="tenloai_pt">
         <option value="">--Chọn loại phong trào-</option>
         @foreach($lpt as $loai_pt)
         <option value="{{$loai_pt->ID}}">{{$loai_pt->TEN_LOAI_PT}}</option>
         @endforeach
       </select>
     </div>
   </div>

   <div class="form-group">
    <label for="tenhocky">Tên học kỳ</label>
    <div class="col-3">
      <select class="form-control" id="tenhocky" name="tenhocky">
       <option value="">--Chọn học kỳ-</option>
       @foreach($hk as $hocky)
       <option value="{{$hocky->ID}}">{{$hocky->TEN_HK}}</option>
       @endforeach
     </select>
   </div>
 </div>

 <div class="form-group">
  <label for="tenpt_chidoan">Tên phong trào chi đoàn</label>
  <input class="form-control" id="tenpt_chidoan" name="tenpt_chidoan" placeholder="Nhập tên phong trào chi đoàn" type="text"  required>
</div>

<div class="col-lg-6">
  <div class="input-group">
    <span class="input-group-addon">
      <label for="ngaybd">Ngày bắt đầu</label>
    </span>
    <input class="form-control" id="ngaybd" name="ngaybd" placeholder="Nhập ngày bắt đầu" type="date"  required>
  </div>
  <!-- /input-group -->
</div>
<!-- /.col-lg-6 -->
<div class="col-lg-6">
  <div class="input-group">
    <span class="input-group-addon">
      <label for="ngaykt">Ngày kết thúc</label>
    </span>
    <input class="form-control" id="ngaykt" name="ngaykt" placeholder="Nhập ngày kết thúc" type="date"  required>
  </div>
  <!-- /input-group -->
</div>
<br>

<div class="form-group">
  <label for="ghichu">Ghi chú</label>
  <input class="form-control" id="ghichu" name="ghichu" placeholder="Nhập ghi chú" type="text"  >
</div>

</div>
<!-- /.card-body -->

<div class="box-footer">
  <button  class="btn btn-success"><a href="{{ route('pt_chidoan.index') }}" style="color: white;"> Trở về </a></button>
  <button type="submit" class="btn btn-primary"> Lưu </button>
</div>
</form>
</div>


@endsection