@extends('layout.app')

@section('head_content')
THÊM MỚI NỘI DUNG PHIẾU ĐÁNH GIÁ

@endsection
@section('link_content')
<h1>
  QUẢN LÝ NỘI DUNG PHIẾU ĐÁNH GIÁ
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách nội dung phiếu đánh giá</li>
  <li class="active">Thêm nội dung phiếu đánh giá</li>
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
  <form role="form" method="POST" action="{{ route('noidung_pdg.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="box-body">

      <div class="form-group">
        <label for="tennoidung_pdg_cha">Tên nội dung phiếu đánh giá cha</label>
        <div class="col-3">
          <select class="form-control" id="tennoidung_pdg_cha" name="tennoidung_pdg_cha">
           <option value="">--Chọn nội dung phiếu đánh giá cha--</option>
           @foreach($ndpdg_cha as $noidung_pdg_cha)
           <option value="{{$noidung_pdg_cha->ID}}">{{$noidung_pdg_cha->TEN_NDPDG}}</option>
           @endforeach
         </select>
       </div>
     </div>

     <div class="form-group">
      <label for="tenkieu_dulieu">Tên kiểu dữ liệu</label>
      <div class="col-3">
        <select class="form-control" id="tenkieu_dulieu" name="tenkieu_dulieu">
         <option value="">--Chọn kiểu dữ liệu-</option>
         @foreach($kdl as $kieu_dulieu)
         <option value="{{$kieu_dulieu->ID}}">{{$kieu_dulieu->TEN_KIEU_DULIEU}}</option>
         @endforeach
       </select>
     </div>
   </div>

    <div class="form-group">
      <label for="tenloai_noidung_pdg">Tên loại nội dung </label>
      <div class="col-3">
        <select class="form-control" id="tenloai_noidung_pdg" name="tenloai_noidung_pdg">
         <option value="">--Chọn loại nội dung--</option>
         @foreach($lnd as $loai_noidung_pdg)
         <option value="{{$loai_noidung_pdg->ID}}">{{$loai_noidung_pdg->TEN_LOAI_NDPDG}}</option>
         @endforeach
       </select>
     </div>
   </div>

   <div class="form-group">
    <label for="tennoidung_pdg">Tên nội dung phiếu đánh giá</label>
    <input class="form-control" id="tennoidung_pdg" name="tennoidung_pdg" placeholder="Nhập tên nội dung phiếu đánh giá" type="text"  required>
  </div>
  <div class="form-group">
    <label for="noidung_ndpdg">Nội dung phiếu đánh giá</label>
    <input class="form-control" id="noidung_ndpdg" name="noidung_ndpdg" placeholder="Nhập nội dung phiếu đánh giá" type="text"  required>
  </div>

   <div class="form-group">
    <label for="tendiemtoida_ndpdg">Điểm tối đa</label>
    <input class="form-control" id="tendiemtoida_ndpdg" name="tendiemtoida_ndpdg" placeholder="Nhập điểm tối đa" type="text"  required>
  </div>

</div>
<!-- /.card-body -->

<div class="box-footer">
  <button  class="btn btn-success"><a href="{{ route('noidung_pdg.index') }}" style="color: white;"> Trở về </a></button>
  <button type="submit" class="btn btn-primary"> Lưu </button>
</div>
</form>
</div>


@endsection