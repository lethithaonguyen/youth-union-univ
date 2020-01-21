@extends('layout.app')

@section('head_content')
THÊM MỚI PHIẾU ĐÁNH GIÁ ĐOÀN KHOA 

@endsection
@section('link_content')
<h1>
   PHIẾU ĐÁNH GIÁ ĐOÀN KHOA: <b>{{ Session::get('session_ten_doankhoa') }}</b>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Quản lý phiếu đánh giá đoàn khoa</li>
  <li class="active">Thêm phiếu đánh giá đoàn khoa</li>
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
  <form role="form" method="post" action="{{route('phieudanhgia_doankhoa.store',$dk->ID)}}" >
    {!! csrf_field() !!}
    <div class="box-body">
      <div class="form-group">
        <label for="doankhoa">Tên đoàn khoa</label>
        <input class="form-control" id="doankhoa" name="doankhoa"  type="text" value="{{$dk->TEN_DK}}">
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
        <label for="ten_pdgdk">Tên phiếu đánh giá</label>
        <input class="form-control" id="ten_pdgdk" name="ten_pdgdk" placeholder="Nhập tên phiếu đánh giá" type="text" value="">
      </div>
      <br><br>
      <div class="form-group">
        <label for="xeploai_dk">Đoàn khoa tự xếp loại</label>
        <div class="col-3">
          <select class="form-control" id="xeploai_dk" name="xeploai_dk">
            <option value="">--Chọn xếp loại--</option>
            @foreach($xl_dk as $xeploai_dk)
            <option value="{{$xeploai_dk->ID}}">{{$xeploai_dk->TEN_XLDK}}</option>
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
        <button  class="btn btn-success"><a href="" style="color: white;"> Trở về </a></button>
        <button type="submit"  class="btn btn-primary"> Lưu </button>
      </div>
    </form>
  </div>


  @endsection