@extends('layout.app')

@section('head_content')
THÊM MỚI PHIẾU ĐÁNH GIÁ CHI ĐOÀN

@endsection
@section('link_content')
<h1>
   PHIẾU ĐÁNH GIÁ CHI ĐOÀN: <b>{{ Session::get('session_ten_chidoan_sv') }}-{{ Session::get('session_ten_khoa_sv') }}</b>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Quản lý phiếu đánh giá chi đoàn</li>
  <li class="active">Thêm phiếu đánh giá chi đoàn</li>
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
  <form role="form" method="post" action="{{route('phieudanhgia_chidoan.store',$cd->ID)}}" >
    {!! csrf_field() !!}
    <div class="box-body">
      <div class="form-group">
        <label for="chidoan">Tên chi đoàn</label>
        <input class="form-control" id="chidoan" name="chidoan"  type="text" value="{{$cd->TEN_CD}}-{{ Session::get('session_ten_khoa_sv') }}">
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
        <label for="ten_pdgcd">Tên phiếu đánh giá</label>
        <input class="form-control" id="ten_pdgcd" name="ten_pdgcd" placeholder="Nhập tên phiếu đánh giá" type="text" value="">
      </div>
      <br><br>
      <div class="form-group">
        <label for="xeploai_cd">Chi đoàn tự xếp loại</label>
        <div class="col-3">
          <select class="form-control" id="xeploai_cd" name="xeploai_cd">
            <option value="">--Chọn xếp loại--</option>
            @foreach($xl_cd as $xeploai_cd)
            <option value="{{$xeploai_cd->ID}}">{{$xeploai_cd->TEN_XLCD}}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="box-footer">
        <button  class="btn btn-success"><a href="" style="color: white;"> Trở lại </a></button>
        <button type="submit"  class="btn btn-primary"> Lưu </button>
      </div>
    </form>
  </div>


  @endsection