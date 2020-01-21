@extends('layout.app')

@section('head_content')
CẬP NHẬT CHI TIẾT MẪU PHIẾU

@endsection
@section('link_content')
<h1>
  QUẢN LÝ CHI TIẾT MẪU PHIẾU
  <small>                
    <a href="{{route('chitiet_mauphieu.create')}}" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách chi tiết mẫu phiếu</li>
  <li class="active">Cập nhật chi tiết mẫu phiếu</li>
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
  <form role="form" method="post" action="{{route('chitiet_mauphieu.update',$ct_mp->ID)}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field("PATCH") }}
    <div class="box-body">

     <div class="form-group">
      <label for="tenmauphieu">Tên mẫu phiếu</label>
      <div class="col-3">
        <select class="form-control" id="tenmauphieu" name="tenmauphieu" disabled="disabled">
         <option value="">--Chọn mẫu phiếu--</option>
         @foreach($mp as $mauphieu)
         <option value="{{ $mauphieu->ID }}" <?php echo ($mauphieu->ID == $ct_mp->MAUPHIEU_ID) ? 'selected' : '' ?>>{{ $mauphieu->TEN_MP }}</option>
         @endforeach
       </select>
     </div>
   </div>

   <div class="form-group">
    <label for="tennoidung_pdg">Tên nội dung phiếu đánh giá</label>
    <div class="col-3">
      <select class="form-control" id="tennoidung_pdg" name="tennoidung_pdg" disabled="disabled">
       <option value="">--Chọn nội dung phiếu đánh giá--</option>
       @foreach($nd_pdg as $noidung_pdg)
       <option value="{{ $noidung_pdg->ID }}" <?php echo ($noidung_pdg->ID == $ct_mp->NOIDUNG_PDG_ID) ? 'selected' : '' ?>>{{ $noidung_pdg->TEN_NDPDG }}</option>
       @endforeach
     </select>
   </div>
 </div>


<div class="form-group">
  <label for="tenthutu_noidung">Thứ tự nội dung</label>
  <input class="form-control" id="tenthutu_noidung" name="tenthutu_noidung" placeholder="Nhập thứ tự nội dung" type="text" value="{{$ct_mp->THUTU_NOIDUNG}}"  required>
</div>



</div>
<!-- /.card-body -->

<div class="box-footer">
  <button  class="btn btn-success"><a href="{{ route('chitiet_mauphieu.index') }}" style="color: white;"> Trở về </a></button>
  <button type="submit" class="btn btn-primary"> Cập nhật </button>
</div>
</form>
</div>


@endsection