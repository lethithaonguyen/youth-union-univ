@extends('layout.app')

@section('head_content')
THÊM MỚI THÀNH TÍCH THAM GIA

@endsection
@section('link_content')
<h1>
  QUẢN LÝ THÀNH TÍCH THAM GIA
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách thành tích tham gia</li>
  <li class="active">Thêm thành tích tham gia</li>
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
  <form role="form" method="POST" action="{{ route('thanhtich_thamgia.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="box-body">

      <div class="form-group">
        <label for="tenthanhtich">Tên thành tích</label>
        <div class="col-3">
          <select class="form-control" id="tenthanhtich" name="tenthanhtich">
           <option value="">--Chọn thành tích--</option>
           @foreach($tt as $thanhtich)
           <option value="{{$thanhtich->ID}}">{{$thanhtich->TEN_TT}}</option>
           @endforeach
         </select>
       </div>
     </div>

     <div class="form-group">
      <label for="tenpt_doankhoa">Tên phong trào đoàn khoa</label>
      <div class="col-3">
        <select class="form-control" id="tenpt_doankhoa" name="tenpt_doankhoa">
         <option value="">--Chọn phong trào đoàn khoa--</option>
         @foreach($pt_dk as $pt_doankhoa)
         <option value="{{$pt_doankhoa->ID}}">{{$pt_doankhoa->TEN_PT_DK}}</option>
         @endforeach
       </select>
     </div>
   </div>

{{--       <div class="form-group">
        <label for="tendoanvien_thanhnien">Tên đoàn viên</label>
        <div class="col-3">
          <select class="form-control" id="tendoanvien_thanhnien" name="tendoanvien_thanhnien">
           <option value="">--Chọn đoàn viên--</option>
           @foreach($dvtn as $doanvien_thanhnien)
           <option value="{{$doanvien_thanhnien->ID}}">{{$doanvien_thanhnien->TEN_SV}}-{{$doanvien_thanhnien->MSSV}}</option>
           @endforeach
         </select>
       </div>
     </div> --}}


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
      <label for="tendiengiai">Diễn giải thành tích tham gia</label>
      <input class="form-control" id="tendiengiai" name="tendiengiai" placeholder="Nhập diễn giải thành tích tham gia" type="text">
    </div>


  </div>
  <!-- /.card-body -->

  <div class="box-footer">
    <button  class="btn btn-success"><a href="{{ route('thanhtich_thamgia.index') }}" style="color: white;"> Trở về </a></button>
    <button type="submit" class="btn btn-primary"> Lưu </button>
  </div>
</form>
</div>


@endsection