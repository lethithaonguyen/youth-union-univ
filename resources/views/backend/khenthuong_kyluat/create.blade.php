@extends('layout.app')

@section('head_content')
THÊM MỚI KHEN THƯỞNG KỶ LUẬT

@endsection
@section('link_content')
<h1>
  QUẢN LÝ KHEN THƯỞNG KỶ LUẬT
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách khen thưởng  kỷ luật</li>
  <li class="active">Thêm khen thưởng  kỷ luật</li>
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
  <form role="form" method="POST" action="{{ route('khenthuong_kyluat.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="box-body">

      <div class="form-group">
        <label for="tenloai_ktkl">Tên loại khen thưởng  kỷ luật</label>
        <div class="col-3">
          <select class="form-control" id="tenloai_ktkl" name="tenloai_ktkl">
           <option value="">--Chọn loại khen thưởng  kỷ luật-</option>
           @foreach($lktkl as $loai_ktkl)
           <option value="{{$loai_ktkl->ID}}">{{$loai_ktkl->TEN_LOAIKTKL}}</option>
           @endforeach
         </select>
       </div>
     </div>

     <div class="form-group">
      <label for="tenhinhthuc_ktkl">Tên hình thức khen thưởng  kỷ luật</label>
      <div class="col-3">
        <select class="form-control" id="tenhinhthuc_ktkl" name="tenhinhthuc_ktkl">
         <option value="">--Chọn hình thức khen thưởng  kỷ luật-</option>
         @foreach($ht_ktkl as $hinhthuc_ktkl)
         <option value="{{$hinhthuc_ktkl->ID}}">{{$hinhthuc_ktkl->TEN_HT}}</option>
         @endforeach
       </select>
     </div>
   </div>

    <div class="form-group">
        <label for="tendoanvien_thanhnien">Tên đoàn viên lập</label>
        <div class="col-3">
          <select class="form-control" id="tendoanvien_thanhnien" name="tendoanvien_thanhnien">
           <option value="">--Chọn đoàn viên lập--</option>
           @foreach($dv_tn as $doanvien_thanhnien)
           <option value="{{$doanvien_thanhnien->ID}}">{{$doanvien_thanhnien->TEN_SV}}</option>
           @endforeach
         </select>
       </div>
     </div>

   <div class="form-group">
    <label for="tenkhenthuong_kyluat">Tên khen thưởng  kỷ luật</label>
    <input class="form-control" id="tenkhenthuong_kyluat" name="tenkhenthuong_kyluat" placeholder="Nhập tên khen thưởng  kỷ luật" type="text"  required>
  </div>

</div>
<!-- /.card-body -->

<div class="box-footer">
  <button  class="btn btn-success"><a href="{{ route('khenthuong_kyluat.index') }}" style="color: white;"> Trở về </a></button>
  <button type="submit" class="btn btn-primary"> Lưu </button>
</div>
</form>
</div>


@endsection