@extends('layout.app')

@section('head_content')
CẬP NHẬT PHIẾU CHI CHI ĐOÀN <b>{{Session::get('session_ten_chidoan_sv')}}-{{Session::get('session_ten_khoa_sv')}}</b>

@endsection
@section('link_content')
<h1>
  QUẢN LÝ PHIẾU CHI CHI ĐOÀN
  <small>                
    <a href="" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách phiếu chi chi đoàn</li>
  <li class="active">Cập nhật phiếu chi chi đoàn</li>
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
  <form role="form" method="post" action="{{route('phieuchi_chi_cd.update',['phieuchi_chi_cd'=>$phieuchi_chi_cd->ID])}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field("PATCH") }}
    <div class="box-body">

      <div class="form-group">
        <label for="tenchidoan">Tên chi đoàn</label>
        <div class="col-3">
          <select class="form-control" id="tenchidoan" name="tenchidoan">
            <option value="">--Chọn chi đoàn--</option>
           @foreach($cd as $chidoan)
           <option value="{{ $chidoan->ID }}" <?php echo ($chidoan->ID == $phieuchi_chi_cd->CHIDOAN_ID) ? 'selected' : '' ?>>{{ $chidoan->TEN_CD }}-{{$chidoan->TEN_KHOA}}</option>
           @endforeach
         </select>
       </div>
     </div>

     <div class="form-group">
      <label for="tenloai_noidung_chi">Tên loại nội dung chi</label>
      <div class="col-3">
        <select class="form-control" id="tenloai_noidung_chi" name="tenloai_noidung_chi">
         <option value="">--Chọn loại nội dung chi--</option>
         @foreach($lndc as $loai_noidung_chi)
         <option value="{{ $loai_noidung_chi->ID }}" <?php echo ($loai_noidung_chi->ID == $phieuchi_chi_cd->LOAI_NOIDUNG_CHI_ID) ? 'selected' : '' ?>>{{ $loai_noidung_chi->TEN_LOAI_DP}}</option>
         @endforeach
       </select>
     </div>
   </div>

   <div class="form-group">
    <label for="tendoanvien_thanhnien_nhan">Tên đoàn viên nhận</label>
    <div class="col-3">
      <select class="form-control" id="tendoanvien_thanhnien_nhan" name="tendoanvien_thanhnien_nhan">
       <option value="">--Chọn đoàn viên nhận--</option>
       @foreach($dv_tn_nhan as $doanvien_thanhnien_nhan)
       <option value="{{ $doanvien_thanhnien_nhan->ID }}" <?php echo ($doanvien_thanhnien_nhan->ID == $phieuchi_chi_cd->DOANVIEN_THANHNIEN_ID_NHAN) ? 'selected' : '' ?>>{{ $doanvien_thanhnien_nhan->TEN_SV }}</option>
       @endforeach
     </select>
   </div>
 </div>

 
 <div class="form-group">
    <label for="tendoanvien_thanhnien_tao">Tên đoàn viên tạo</label>
    <div class="col-3">
      <select class="form-control" id="tendoanvien_thanhnien_tao" name="tendoanvien_thanhnien_tao">
       <option value="">--Chọn đoàn viên tạo--</option>
       @foreach($dv_tn_tao as $doanvien_thanhnien_tao)
       <option value="{{ $doanvien_thanhnien_tao->ID }}" <?php echo ($doanvien_thanhnien_tao->ID == $phieuchi_chi_cd->DOANVIEN_THANHNIEN_ID_TAO) ? 'selected' : '' ?>>{{ $doanvien_thanhnien_tao->TEN_SV }}</option>
       @endforeach
     </select>
   </div>
 </div>

 <div class="form-group">
  <label for="tenpt_chidoan">Tên phong trào chi đoàn</label>
  <div class="col-3">
    <select class="form-control" id="tenpt_chidoan" name="tenpt_chidoan">
     <option value="">--Chọn phong trào chi đoàn--</option>
     @foreach($pt_cd as $pt_chidoan)
     <option value="{{ $pt_chidoan->ID }}" <?php echo ($pt_chidoan->ID == $phieuchi_chi_cd->PT_CHIDOAN_ID) ? 'selected' : '' ?>>{{ $pt_chidoan->TEN_PT_CD }}</option>
     @endforeach
   </select>
 </div>
</div>

<div class="form-group">
  <label for="tennoidung">Nội dung phiếu chi</label>
  <input class="form-control" id="tennoidung" name="tennoidung" placeholder="Nhập nội dung phiếu chi" type="text" value="{{$phieuchi_chi_cd->NOIDUNG_PC_CD}}"  required>
</div>

<div class="form-group">
  <label for="tensotien">Số tiền chi</label>
  <input class="form-control" id="tensotien" name="tensotien" placeholder="Nhập số tiền chi" type="text" value="{{$phieuchi_chi_cd->SOTIEN_CHI_CD}}"  required>
</div>

<div class="form-group">
  <label for="tenngay">Ngày chi</label>
  <input class="form-control" id="tenngay" name="tenngay" placeholder="Nhập ngày chi" type="date" value="{{$phieuchi_chi_cd->NGAY_CHI_CD}}"  required>
</div>

</div>
<!-- /.card-body -->

<div class="box-footer">
  <button  class="btn btn-success"><a href="{{ route('phieuchi_chi_cd.index') }}" style="color: white;"> Trở về </a></button>
  <button type="submit" class="btn btn-primary"> Cập nhật </button>
</div>
</form>
</div>


@endsection