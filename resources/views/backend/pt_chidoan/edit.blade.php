@extends('layout.app')

@section('head_content')
CẬP NHẬT PHONG TRÀO CHI ĐOÀN <b>{{Session::get('session_ten_chidoan_sv')}}</b>

@endsection
@section('link_content')
<h1>
  QUẢN LÝ PHONG TRÀO CHI ĐOÀN
  <small>                
    <a href="{{route('pt_chidoan.create')}}" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách phong trào chi đoàn</li>
  <li class="active">Cập nhật phong trào chi đoàn</li>
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
  <form role="form" method="post" action="{{route('pt_chidoan.update',['pt_chidoan'=>$pt_chidoan->ID])}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field("PATCH") }}
    <div class="box-body">

     <div class="form-group">
      <label for="tenchidoan">Tên chi đoàn</label>
      <div class="col-3">
        <select class="form-control" id="tenchidoan" name="tenchidoan">
         <option value="">--Chọn chi đoàn-</option>
         @foreach($cd as $chidoan)
         <option value="{{ $chidoan->ID }}" <?php echo ($chidoan->ID == $pt_chidoan->CHIDOAN_ID) ? 'selected' : '' ?>>{{ $chidoan->TEN_CD }}</option>
         @endforeach
       </select>
     </div>
   </div>

   <div class="form-group">
    <label for="tenloai_pt">Tên loại phong trào</label>
    <div class="col-3">
      <select class="form-control" id="tenloai_pt" name="tenloai_pt">
       <option value="">--Chọn loại phong trào-</option>
       @foreach($lpt as $loai_pt)
       <option value="{{ $loai_pt->ID }}" <?php echo ($loai_pt->ID == $pt_chidoan->LOAI_PT_ID) ? 'selected' : '' ?>>{{ $loai_pt->TEN_LOAI_PT }}</option>
       @endforeach
     </select>
   </div>
 </div>

    <div class="form-group">
    <label for="tenhocky">Tên học kỳ</label>
    <div class="col-3">
      <select class="form-control" id="tenhocky" name="tenhocky">
       <option value="">--Chọn học kỳ-</option>
       @foreach($hk as $hocky)
       <option value="{{ $hocky->ID }}" <?php echo ($hocky->ID == $pt_chidoan->HOCKY_ID) ? 'selected' : '' ?>>{{ $hocky->TEN_HK }}</option>
       @endforeach
     </select>
   </div>
 </div>

 <div class="form-group">
  <label for="tenpt_chidoan">Tên phong trào</label>
  <input class="form-control" id="tenpt_chidoan" name="tenpt_chidoan" placeholder="Nhập tên phong trào chi đoàn" type="text" value="{{$pt_chidoan->TEN_PT_CD}}"  required>
</div>

<div class="form-group">
  <label for="ngaybd">Ngày bắt đầu</label>
  <input class="form-control" id="ngaybd" name="ngaybd" placeholder="Nhập ngày bắt đầu phong trào" type="date" value="{{$pt_chidoan->NGAY_BD_PT_CD}}"  required>
</div>

<div class="form-group">
  <label for="ngaykt">Ngày kết thúc</label>
  <input class="form-control" id="ngaykt" name="ngaykt" placeholder="Nhập ngày kết thúc phong trào" type="date" value="{{$pt_chidoan->NGAY_KT_PT_CD}}"  required>
</div>

<div class="form-group">
  <label for="ghichu">Ghi chú</label>
  <input class="form-control" id="ghichu" name="ghichu" placeholder="Nhập ghi chú" type="text" value="{{$pt_chidoan->GHICHU_PT_CD}}" >
</div>
</div>
<!-- /.card-body -->

<div class="box-footer">
  <button  class="btn btn-success"><a href="{{ route('pt_chidoan.index') }}" style="color: white;"> Trở về </a></button>
  <button type="submit" class="btn btn-primary"> Cập nhật </button>
</div>
</form>
</div>


@endsection