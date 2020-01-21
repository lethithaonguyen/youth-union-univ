@extends('layout.app')

@section('head_content')
THÊM MỚI QUYẾT ĐỊNH KẾT NẠP CHI ĐOÀN <b>{{Session::get('ten_chidoan')}}-{{Session::get('ten_khoa')}}</b>

@endsection
@section('link_content')
<h1>
  QUẢN LÝ QUYẾT ĐỊNH KẾT NẠP
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách quyết định kết nạp</li>
  <li class="active">Thêm quyết định kết nạp</li>
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
  <form role="form" method="POST" action="{{ route('qd_dv_ketnap.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="box-body">

   <!--    <div class="form-group">
        <label for="tendoanvien_thanhnien">Tên đoàn viên lập</label>
        <div class="col-3">
          <select class="form-control" id="tendoanvien_thanhnien" name="tendoanvien_thanhnien">
           <option value="">--Chọn đoàn viên lập--</option>
           @foreach($dv_kn as $dv_ketnap)
           <option value="{{$dv_ketnap->DOANVIEN_THANHNIEN_ID}}">{{$dv_ketnap->TEN_SV}}</option>
           @endforeach
         </select>
       </div>
     </div> -->

     <div class="form-group">
      <label for="tendv_ketnap">Ngày kết nạp</label>
      <div class="col-3">
        <select class="form-control" id="tendv_ketnap" name="tendv_ketnap">
         <option value="">--Chọn ngày kết nạp--</option>
         @foreach($dv_kn as $dv_ketnap)
         <option value="{{$dv_ketnap->ID}}">{{$dv_ketnap->NGAYKETNAP}}</option>
         @endforeach
       </select>
     </div>
   </div>

{{--       <div class="form-group">
        <label for="tendoanvien_thanhnien">Tên đoàn viên được kết nạp</label>
        <div class="col-3">
          <select class="form-control" id="tendoanvien_thanhnien" name="tendoanvien_thanhnien">
           <option value="">--Chọn đoàn viên được kết nạp--</option>
           @foreach($dv_tn as $doanvien_thanhnien)
           <option value="{{$doanvien_thanhnien->ID}}">{{$doanvien_thanhnien->TEN_SV}}</option>
           @endforeach
         </select>
       </div>
     </div> --}}
     <label for="tendoanvien_thanhnien">Tên đoàn viên được kết nạp</label>
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

   <!-- <div class="form-group">
    <label for="tendiengiai">Tình trạng kết nạp</label>
    <input class="form-control" id="tendiengiai" name="tendiengiai" placeholder="Nhập diễn giải quyết định kết nạp" type="text"  >
  </div>
-->

</div>
<!-- /.card-body -->

<div class="box-footer">
  <button  class="btn btn-success"><a href="{{ route('qd_dv_ketnap.index') }}" style="color: white;"> Trở về </a></button>
  <button type="submit" class="btn btn-primary"> Lưu </button>
</div>
</form>
</div>


@endsection