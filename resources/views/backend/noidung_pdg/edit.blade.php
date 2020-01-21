@extends('layout.app')

@section('head_content')
CẬP NHẬT NỘI DUNG PHIẾU ĐÁNH GIÁ

@endsection
@section('link_content')
<h1>
  QUẢN LÝ NỘI DUNG PHIẾU ĐÁNH GIÁ
  <small>                
    <a href="{{route('noidung_pdg.create')}}" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách nội dung phiếu đánh giá</li>
  <li class="active">Cập nhật nội dung phiếu đánh giá</li>
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
  <form role="form" method="post" action="{{route('noidung_pdg.update',['noidung_pdg'=>$noidung_pdg->ID])}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field("PATCH") }}
    <div class="box-body">

     <div class="form-group">
      <label for="tennoidung_pdg_cha">Tên nội dung cha</label>
      <div class="col-3">
        <select class="form-control" id="tennoidung_pdg_cha" name="tennoidung_pdg_cha">
         <option value="">--Chọn nội dung cha--</option>
         @foreach($ndpdg_cha as $noidung_pdg_cha)
         <option value="{{ $noidung_pdg_cha->ID }}" <?php echo ($noidung_pdg_cha->ID == $noidung_pdg->NOIDUNG_PDG_ID_CHA) ? 'selected' : '' ?>>{{ $noidung_pdg_cha->TEN_NDPDG }}</option>
         @endforeach
       </select>
     </div>
   </div>

   <div class="form-group">
    <label for="tenkieu_dulieu">Tên kiểu dữ liệu</label>
    <div class="col-3">
      <select class="form-control" id="tenkieu_dulieu" name="tenkieu_dulieu">
       <option value="">--Chọn kiểu dữ liệu--</option>
       @foreach($kdl as $kieu_dulieu)
       <option value="{{ $kieu_dulieu->ID }}" <?php echo ($kieu_dulieu->ID == $noidung_pdg->KIEU_DULIEU_ID) ? 'selected' : '' ?>>{{ $kieu_dulieu->TEN_KIEU_DULIEU }}</option>
       @endforeach
     </select>
   </div>
 </div>

    <div class="form-group">
    <label for="tenloai_noidung_pdg">Tên loại nội dung</label>
    <div class="col-3">
      <select class="form-control" id="tenloai_noidung_pdg" name="tenloai_noidung_pdg">
       <option value="">--Chọn loại nội dung--</option>
       @foreach($lnd as $loai_noidung_pdg)
       <option value="{{ $loai_noidung_pdg->ID }}" <?php echo ($loai_noidung_pdg->ID == $noidung_pdg->LOAI_NOIDUNG_PDG_ID) ? 'selected' : '' ?>>{{ $loai_noidung_pdg->TEN_LOAI_NDPDG }}</option>
       @endforeach
     </select>
   </div>
 </div>

 <div class="form-group">
  <label for="tennoidung_pdg">Tên nội dung phiếu đánh giá</label>
  <input class="form-control" id="tennoidung_pdg" name="tennoidung_pdg" placeholder="Nhập tên nội dung phiếu đánh giá" type="text" value="{{$noidung_pdg->TEN_NDPDG}}"  required>
</div>

<div class="form-group">
  <label for="noidung_pdg">Nội dung phiếu đánh giá</label>
  <input class="form-control" id="noidung_pdg" name="noidung_pdg" placeholder="Nhập nội dung phiếu đánh giá" type="text" value="{{$noidung_pdg->NOIDUNG_PDG}}"  required>
</div>

<div class="form-group">
  <label for="tendiemtoida_ndpdg">Điểm tối đa</label>
  <input class="form-control" id="tendiemtoida_ndpdg" name="tendiemtoida_ndpdg" placeholder="Nhập nội dung phiếu đánh giá" type="text" value="{{$noidung_pdg->DIEMTOIDA_NDPDG}}"  required>
</div>
</div>
<!-- /.card-body -->

<div class="box-footer">
  <button  class="btn btn-success"><a href="{{ route('noidung_pdg.index') }}" style="color: white;"> Trở về </a></button>
  <button type="submit" class="btn btn-primary"> Cập nhật </button>
</div>
</form>
</div>


@endsection