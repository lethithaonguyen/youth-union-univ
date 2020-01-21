@extends('layout.app')

@section('head_content')
THÊM MỚI PHIẾU ĐÁNH GIÁ ĐOÀN VIÊN {{-- <b>{{ Session::get('session_ten_sv') }} ({{ Session::get('session_mssv_sv') }})</b> --}}

@endsection
@section('link_content')
<h1>
   PHIẾU ĐÁNH GIÁ ĐOÀN VIÊN <b>{{ Session::get('session_ten_sv') }} ({{ Session::get('session_mssv_sv') }})</b>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Quản lý phiếu đánh giá đoàn viên</li>
  <li class="active">Thêm phiếu đánh giá đoàn viên</li>
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
  <form role="form" method="post" action="{{route('phieudanhgia_doanvien.store',$dv_tn->ID)}}" >
    {!! csrf_field() !!}
    <div class="box-body">
      <div class="form-group">
        <label for="doanvien">Họ tên đoàn viên sinh viên</label>
        <input class="form-control" id="doanvien" name="doanvien"  type="text" value="{{$dv_tn->TEN_SV}}" disabled>
      </div>
      <div class="form-group">
        <label for="mauphieu">Mẫu phiếu</label>
        <div class="col-3">
          <select class="form-control" id="mauphieu" name="mauphieu">
            @foreach($mp as $mauphieu)
            <option value="{{$mauphieu->ID}}">{{$mauphieu->TEN_MP}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="namhoc">Năm học</label>
        <div class="col-3">
          <select class="form-control" id="namhoc" name="namhoc">
            @foreach($nh as $namhoc)
            <option value="{{$namhoc->ID}}">{{$namhoc->TEN_NH}}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group">
        <label for="ten_pdgdv">Tên phiếu đánh giá</label>
        <input class="form-control" id="ten_pdgdv" name="ten_pdgdv" placeholder="Nhập tên phiếu đánh giá" type="text" value="">
      </div>


      <div class="col-lg-6">
        <div class="input-group">
          <span class="input-group-addon">
            <label for="dtb1">Điểm trung bình học kỳ 1</label>
          </span>
          <input type="text" class="form-control" id="dtb1" name="dtb1">
        </div>
        <!-- /input-group -->
      </div>
      <!-- /.col-lg-6 -->
      <div class="col-lg-6">
        <div class="input-group">
          <span class="input-group-addon">
            <label for="dtb2">Điểm trung bình học kỳ 2</label>
          </span>
          <input type="text" class="form-control" id="dtb2" name="dtb2">
        </div>
        <!-- /input-group -->
      </div>
      <!-- /.col-lg-6 -->
      <br><br><br>
      <div class="col-lg-6">
        <div class="input-group">
          <span class="input-group-addon">
            <label for="drl1">Điểm rèn luyện học kỳ 1</label>
          </span>
          <input type="text" class="form-control" id="drl1" name="drl1">
        </div>
        <!-- /input-group -->
      </div>
      <!-- /.col-lg-6 -->
      <div class="col-lg-6">
        <div class="input-group">
          <span class="input-group-addon">
            <label for="drl2">Điểm rèn luyện học kỳ 2</label>
          </span>
          <input type="text" class="form-control" id="drl2" name="drl2">
        </div>
        <!-- /input-group -->
      </div>
      <br><br>
      <div class="form-group">
        <label for="xeploai_dv">Đoàn viên tự xếp loại</label>
        <div class="col-3">
          <select class="form-control" id="xeploai_dv" name="xeploai_dv">
            <option value="">--Chọn xếp loại--</option>
            @foreach($xl_dv as $xeploai_dv)
            <option value="{{$xeploai_dv->ID}}">{{$xeploai_dv->TEN_XLDV}}</option>
            @endforeach
          </select>
        </div>
      </div>

{{--       <div class="form-group">
        <label for="xeploai_dv">BAN CHẤP HÀNH CHI ĐOÀN XẾP LOẠI</label>
        <div class="col-3">
          <select class="form-control" id="cd_xeploai" name="cd_xeploai" disabled>
            @foreach($xl_dv as $xeploai_dv)
            <option value="">--Chọn xếp loại--</option>
            <option value="{{$xeploai_dv->ID}}">{{$xeploai_dv->TEN_XLDV}}</option>
            @endforeach
          </select>
        </div>
      </div> --}}

      <!-- /.card-body -->

      <div class="box-footer">
        <button  class="btn btn-success"><a href="" style="color: white;"> Trở lại </a></button>
        <button type="submit"  class="btn btn-primary"> Lưu </button>
      </div>
    </form>
  </div>


  @endsection