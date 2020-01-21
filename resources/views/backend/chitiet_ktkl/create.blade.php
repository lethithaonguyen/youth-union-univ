@extends('layout.app')

@section('head_content') 
THÊM MỚI QUYẾT ĐỊNH KHEN THƯỞNG - KỶ LUẬT @if(Session::get('session_vt')==3)<b>{{Session::get('session_ten_chidoan_sv')}}-{{Session::get('session_ten_khoa_sv')}}</b> @endif

@endsection
@section('link_content')
<h1>
  QUẢN LÝ QUYẾT ĐỊNH KHEN THƯỞNG - KỶ LUẬT
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách quyết định khen thưởng - kỷ luật</li>
  <li class="active">Thêm quyết định khen thưởng - kỷ luật</li>
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
  <form role="form" method="POST" action="{{ route('chitiet_ktkl.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="box-body">
     <div class="form-group">
      <label for="tenkhenthuong_kyluat">Tên khen thưởng - kỷ luật</label>
      <div class="col-3">
        <select class="form-control" id="tenkhenthuong_kyluat" name="tenkhenthuong_kyluat">
         <option value="">--Chọn tên khen thưởng - kỷ luật--</option>
         @foreach($kt_kl as $khenthuong_kyluat)
         <option value="{{$khenthuong_kyluat->ID}}">{{$khenthuong_kyluat->TEN_KTKL}}</option>
         @endforeach
       </select>
     </div>
   </div>
     <label for="tendoanvien_thanhnien">Tên đoàn viên được khen thưởng - kỷ luật</label>
     <table class="table table-bordered table-striped dataTable" id="" role="grid" aria-describedby="example1_info">
      <thead>
        <tr role="row">
          <th style="text-align: center;">Stt</th>
          <th style="text-align: center;">Mssv</th>
          <th style="text-align: center;">Đoàn viên</th>
          <th style="text-align: center;"><input type="checkbox"  id="selectall" class="checked" />Chọn</th>

        </tr>
      </thead>
      <?php
      $stt=1;
      ?> 
      <tbody>  
        @foreach($dv_tn as $doanvien_thanhnien)          
        <tr class="odd" role="row">

          <td class="sorting_1">{{$stt++}}</td>
          <td>{{$doanvien_thanhnien->MSSV}}</td>
          <td>{{$doanvien_thanhnien->TEN_SV}}</td>
          <td><input type="checkbox" onClick="checkbox_is_checked()" name="doanvien[]" value="{{$doanvien_thanhnien->ID}}" class="check-all"></td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <div class="form-group">
      <label for="tennoidung">Nội dung khen thưởng - kỷ luật</label>
      <input class="form-control" id="tennoidung" name="tennoidung" placeholder="Nhập nội dung khen thưởng - kỷ luật" type="text"  >
    </div>

    <div class="form-group">
      <label for="tenngaybatdau">Ngày khen thưởng - kỷ luật</label>
      <input class="form-control" id="tenngaybatdau" name="tenngaybatdau" placeholder="Nhập ngày khen thưởng - kỷ luật" type="date"  >
    </div>

</div>
<!-- /.card-body -->

<div class="box-footer">
  <button  class="btn btn-success"><a href="{{ route('chitiet_ktkl.index') }}" style="color: white;"> Trở về </a></button>
  <button type="submit" class="btn btn-primary"> Lưu </button>
</div>
</form>
</div>


@endsection