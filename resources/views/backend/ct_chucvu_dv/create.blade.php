@extends('layout.app')

@section('head_content')
THÊM MỚI CHI TIẾT CHỨC VỤ ĐOÀN VIÊN

@endsection
@section('link_content')
<h1>
  QUẢN LÝ CHI TIẾT CHỨC VỤ ĐOÀN VIÊN
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách chi tiết chức vụ đoàn viên</li>
  <li class="active">Thêm chi tiết chức vụ đoàn viên</li>
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
  <form role="form" method="POST" action="{{ route('ct_chucvu_dv.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="box-body">

      <div class="form-group">
        <label for="tendoanvien_thanhnien">Tên đoàn viên</label>
        <div class="col-3">
          <select class="form-control" id="tendoanvien_thanhnien" name="tendoanvien_thanhnien">
           <option value="">--Chọn đoàn viên--</option>
           @foreach($dv_tn as $doanvien_thanhnien)
           <option value="{{$doanvien_thanhnien->ID}}">{{$doanvien_thanhnien->TEN_SV}}</option>
           @endforeach
         </select>
       </div>
     </div>

     <div class="form-group">
      <label for="tenchucvu_dv">Tên chức vụ</label>
      <div class="col-3">
        <select class="form-control" id="tenchucvu_dv" name="tenchucvu_dv">
         <option value="">--Chọn chức vụ--</option>
         @foreach($cv_dv as $chucvu_dv)
         <option value="{{$chucvu_dv->ID}}">{{$chucvu_dv->TEN_CHUCVU}}</option>
         @endforeach
       </select>
     </div>
   </div>

   <div class="form-group">
    <label for="ngaybd">Ngày bắt đầu</label>
    <input class="form-control" id="ngaybd" name="ngaybd" placeholder="Nhập ngày bắt đầu" type="date"  required>
  </div>

  <div class="form-group">
    <label for="ngaykt">Ngày kết thúc</label>
    <input class="form-control" id="ngaykt" name="ngaykt" placeholder="Nhập ngày kết thúc" type="date"  >
  </div>


</div>
<!-- /.card-body -->

<div class="box-footer">
  <button  class="btn btn-success"><a href="{{ route('ct_chucvu_dv.index') }}" style="color: white;"> Trở về </a></button>
  <button type="submit" class="btn btn-primary"> Lưu </button>
</div>
</form>
</div>


@endsection