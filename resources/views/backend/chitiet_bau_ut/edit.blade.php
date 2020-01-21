@extends('layout.app')

@section('head_content')
CẬP NHẬT CHI TIẾT BẦU ƯU TÚ @if(Session::get('session_vt')==3) CỦA CHI ĐOÀN <b>{{Session::get('session_ten_chidoan_sv')}}-{{Session::get('session_ten_khoa_sv')}}</b>@elseif(Session::get('session_vt')==2) CỦA ĐOÀN KHOA <b>{{Session::get('session_ten_doankhoa')}}</b>@endif

@endsection
@section('link_content')
<h1>
  QUẢN LÝ CHI TIẾT BẦU ƯU TÚ
  <small>                
    <a href="" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách chi tiết bầu ưu tú</li>
  <li class="active">Cập nhật chi tiết bầu ưu tú</li>
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
  <form role="form" method="post" action="{{route('chitiet_bau_ut.update',['chitiet_bau_ut'=>$chitiet_bau_ut->ID])}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field("PATCH") }}
    <div class="box-body">

     <div class="form-group">
      <label for="tenphieudanhgia_doanvien">Tên phiếu đánh giá đoàn viên</label>
      <div class="col-3">
        <select class="form-control" id="tenphieudanhgia_doanvien" name="tenphieudanhgia_doanvien">
         <option value="">--Chọn phiếu đánh giá đoàn viên--</option>
         @foreach($pdg_dv as $phieudanhgia_doanvien)
         <option value="{{ $phieudanhgia_doanvien->ID }}" <?php echo ($phieudanhgia_doanvien->ID == $chitiet_bau_ut->PHIEUDANHGIA_DOANVIEN_ID) ? 'selected' : '' ?>>{{ $phieudanhgia_doanvien->TEN_PDGDV }}</option>
         @endforeach
       </select>
     </div>
   </div>

   <div class="form-group">
    <label for="tenphieubau_uutu">Phiếu bầu ưu tú</label>
    <div class="col-3">
      <select class="form-control" id="tenphieubau_uutu" name="tenphieubau_uutu">
       <option value="">--Chọn phiếu bầu ưu tú--</option>
       @foreach($pb_ut as $phieubau_uutu)
       <option value="{{ $phieubau_uutu->ID }}" <?php echo ($phieubau_uutu->ID == $chitiet_bau_ut->PHIEUBAU_UUTU_ID) ? 'selected' : '' ?>>({{$phieubau_uutu->TEN_CD}}-{{$phieubau_uutu->TEN_KHOA}})-{{$phieubau_uutu->NGAY_BAU}}</option>
       @endforeach
     </select>
   </div>
 </div>

   <div class="form-group">
    <label for="tenchitiet_bau_ut">Số phiếu bầu đồng ý</label>
    <input class="form-control" id="tenchitiet_bau_ut" name="tenchitiet_bau_ut" placeholder="Nhập số phiếu bầu đồng ý" type="text" value="{{$chitiet_bau_ut->SOPHIEU_DONGY}}"  required>
  </div>
</div>
<!-- /.card-body -->

<div class="box-footer">
  <button  class="btn btn-success"><a href="{{ route('chitiet_bau_ut.index') }}" style="color: white;"> Trở về </a></button>
  <button type="submit" class="btn btn-primary"> Cập nhật </button>
</div>
</form>
</div>


@endsection