@extends('layout.app')

@section('head_content')
THÊM MỚI PHIẾU BẦU ƯU TÚ CỦA CHI ĐOÀN <b>{{Session::get('session_ten_chidoan_sv')}}-{{Session::get('session_ten_khoa_sv')}}</b>

@endsection
@section('link_content')
<h1>
  QUẢN LÝ PHIẾU BẦU ƯU TÚ
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách phiếu bầu ưu tú</li>
  <li class="active">Thêm phiếu bầu ưu tú</li>
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
  <form role="form" method="POST" action="{{ route('phieubau_uutu.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="box-body">

      <div class="form-group">
        <label for="tenchidoan">Tên chi đoàn</label>
        <div class="col-3">
          <select class="form-control" id="tenchidoan" name="tenchidoan">
           <option value="">--Chọn chi đoàn--</option>
           @foreach($cd as $chidoan)
           <option value="{{$chidoan->ID}}">{{$chidoan->TEN_CD}}-{{$chidoan->TEN_KHOA}}</option>
           @endforeach
         </select>
       </div>
     </div>

     <div class="form-group">
      <label for="tenphieubau_uutu">Số phiếu bầu ưu tú</label>
      <input class="form-control" id="tenphieubau_uutu" name="tenphieubau_uutu" placeholder="Nhập số phiếu bầu ưu tú" type="text"  required>
    </div>

    <div class="form-group">
      <label for="tenngay_bau">Ngày bầu ưu tú</label>
      <input class="form-control" id="tenngay_bau" name="tenngay_bau" placeholder="Nhập ngày bầu ưu tú" type="date"  required>
    </div>
    <div class="form-group">
      <label for="tendoanvien_thanhnien">Tên người lập</label>
      <div class="col-3">
        <select class="form-control" id="tendoanvien_thanhnien" name="tendoanvien_thanhnien">
         <option value="">--Chọn đoàn viên--</option>
         @foreach($dvtn as $doanvien_thanhnien)
         <option value="{{$doanvien_thanhnien->ID}}">{{$doanvien_thanhnien->TEN_SV}}</option>
         @endforeach
       </select>
     </div>
   </div>

 </div>
 <!-- /.card-body -->

 <div class="box-footer">
  <button  class="btn btn-success"><a href="{{ route('phieubau_uutu.index') }}" style="color: white;"> Trở về </a></button>
  <button type="submit" class="btn btn-primary"> Lưu </button>
</div>
</form>
</div>


@endsection