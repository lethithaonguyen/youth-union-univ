@extends('layout.app')

@section('head_content')
THÊM MỚI CHI TIẾT BẦU ƯU TÚ @if(Session::get('session_vt')==3) CỦA CHI ĐOÀN <b>{{Session::get('session_ten_chidoan_sv')}}-{{Session::get('session_ten_khoa_sv')}}</b>@elseif(Session::get('session_vt')==2) CỦA ĐOÀN KHOA <b>{{Session::get('session_ten_doankhoa')}}</b>@endif

@endsection
@section('link_content')
<h1>
  QUẢN LÝ CHI TIẾT BẦU ƯU TÚ
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách chi tiết bầu ưu tú</li>
  <li class="active">Thêm chi tiết bầu ưu tú</li>
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
<br><br>
  <form method="get" action="{{route('chitiet_bau_ut.getnam_ctbau')}}" >
   <label class="col-md-2 control-label">Chọn Năm học</label>
   <div class="col-md-4">
    <select class="form-control" name="namhoc" id="namhoc">
      @foreach($nh as $namhoc)
      <option @if($n_dp->ID == $namhoc->ID ) selected @endif value ="{{$namhoc->ID}}">{{$namhoc->TEN_NH}}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-2 control-label">
    <button type='submit' class="btn btn-info"> Liệt kê </button>
  </div>
</form>
<br><br>
<form role="form" method="POST" action="{{ route('chitiet_bau_ut.store') }}" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="box-body">


   <div class="form-group">
    <label for="tenphieubau_uutu">Phiếu bầu ưu tú</label>
    <div class="col-3">
      <select class="form-control" id="tenphieubau_uutu" name="tenphieubau_uutu">
       <option value="">--Chọn phiếu bầu ưu tú--</option>
       @foreach($pb_ut as $phieubau_uutu)
       <option value="{{$phieubau_uutu->ID}}">{{$phieubau_uutu->NGAY_BAU}}</option>
       @endforeach
     </select>
   </div>
 </div>

 <div class="form-group">
  <label for="pdg">Tên phiếu đánh giá đoàn viên</label>
  <div class="col-3">
    <select class="form-control" id="pdg" name="pdg">
     <option value="">--Chọn phiếu đánh giá đoàn viên--</option>
     @foreach($pdg_dv as $phieudanhgia_doanvien)
     <option value="{{$phieudanhgia_doanvien->ID}}">{{$phieudanhgia_doanvien->TEN_PDGDV}}</option>
     @endforeach
   </select>
 </div>
</div>

<div class="form-group">
  <label for="tenchitiet_bau_ut">Số phiếu đồng ý</label>
  <input class="form-control" id="tenchitiet_bau_ut" name="tenchitiet_bau_ut" placeholder="Nhập số phiếu bầu đồng ý" type="text"  >
</div>


</div>
<!-- /.card-body -->

<div class="box-footer">
  <button  class="btn btn-success"><a href="{{ route('chitiet_bau_ut.index') }}" style="color: white;"> Trở về </a></button>
  <button type="submit" class="btn btn-primary"> Lưu </button>
</div>
</form>
</div>


@endsection