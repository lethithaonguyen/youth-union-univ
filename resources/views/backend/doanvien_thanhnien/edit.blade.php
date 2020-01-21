@extends('layout.app')

@section('head_content')
CẬP NHẬT ĐOÀN VIÊN - THANH NIÊN

@endsection
@section('link_content')
<h1>
  QUẢN LÝ ĐOÀN VIÊN - THANH NIÊN
  <small>                
    <a href="{{route('index_get_quanhuyen')}}" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách đoàn viên - thanh niên</li>
  <li class="active">Cập nhật đoàn viên - thanh niên</li>
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
  <form role="form" method="post" action="{{route('doanvien_thanhnien.update',['doanvien_thanhnien'=>$doanvien_thanhnien->ID])}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field("PATCH") }}
    <div class="box-body">

     <div class="form-group">
      <label for="tenphuong_xa_qq">Tên quê quán</label>
      <div class="col-3">
        <select class="form-control" id="tenphuong_xa_qq" name="tenphuong_xa_qq">
         <option value="">--Chọn quê quán--</option>
         @foreach($pxqq as $phuong_xa_qq)
         <option value="{{ $phuong_xa_qq->ID }}" <?php echo ($phuong_xa_qq->ID == $doanvien_thanhnien->PHUONG_XA_ID_QQ) ? 'selected' : '' ?>>{{$phuong_xa_qq->TEN_PX}}--quận/huyện {{$phuong_xa_qq->TEN_QH}}--tỉnh/tp {{$phuong_xa_qq->TEN_TP}}</option>
         @endforeach
       </select>
     </div>
   </div>

   <div class="form-group">
    <label for="tenchidoan">Tên chi đoàn-</label>
    <div class="col-3">
      <select class="form-control" id="tenchidoan" name="tenchidoan">
       <option value="">--Chọn chi đoàn--</option>
       @foreach($cd as $chidoan)
       <option value="{{ $chidoan->ID }}" <?php echo ($chidoan->ID == $doanvien_thanhnien->CHIDOAN_ID) ? 'selected' : '' ?>>{{ $chidoan->TEN_CD }}</option>
       @endforeach
     </select>
   </div>
 </div>

 <div class="form-group">
  <label for="tentongiao">Tên tôn giáo</label>
  <div class="col-3">
    <select class="form-control" id="tentongiao" name="tentongiao">
     <option value="">--Chọn tôn giáo--</option>
     @foreach($tg as $tongiao)
     <option value="{{ $tongiao->ID }}" <?php echo ($tongiao->ID == $doanvien_thanhnien->TONGIAO_ID) ? 'selected' : '' ?>>{{ $tongiao->TEN_TG }}</option>
     @endforeach
   </select>
 </div>
</div>

<div class="form-group">
  <label for="tenphuong_xa_ns">Tên nơi sinh</label>
  <div class="col-3">
    <select class="form-control" id="tenphuong_xa_ns" name="tenphuong_xa_ns">
     <option value="">--Chọn quê quán--</option>
     @foreach($pxns as $phuong_xa_ns)
     <option value="{{ $phuong_xa_ns->ID }}" <?php echo ($phuong_xa_ns->ID == $doanvien_thanhnien->PHUONG_XA_ID_NS) ? 'selected' : '' ?>>{{$phuong_xa_ns->TEN_PX}} -- quận/huyện {{$phuong_xa_ns->TEN_QH}} --tỉnh/tp {{$phuong_xa_ns->TEN_TP}}</option>
     @endforeach
   </select>
 </div>
</div>

<div class="form-group">
  <label for="tendantoc">Tên dân tộc</label>
  <div class="col-3">
    <select class="form-control" id="tendantoc" name="tendantoc">
     <option value="">--Chọn dân tộc--</option>
     @foreach($dt as $dantoc)
     <option value="{{ $dantoc->ID }}" <?php echo ($dantoc->ID == $doanvien_thanhnien->DANTOC_ID) ? 'selected' : '' ?>>{{ $dantoc->TEN_DT }}</option>
     @endforeach
   </select>
 </div>
</div>
<div class="form-group">
  <label for="tenmssv">MSSV</label>
  <input class="form-control" id="tenmssv" name="tenmssv" placeholder="Nhập mssv sinh viên" type="text" value="{{$doanvien_thanhnien->MSSV}}"  required>
</div>

<div class="form-group">
  <label for="tendoanvien_thanhnien">Tên sinh viên</label>
  <input class="form-control" id="tendoanvien_thanhnien" name="tendoanvien_thanhnien" placeholder="Nhập tên sinh viên" type="text" value="{{$doanvien_thanhnien->TEN_SV}}"  required>
</div>

<div class="form-group">
  <label for="tendiachi">Địa chỉ</label>
  <input class="form-control" id="tendiachi" name="tendiachi" placeholder="Nhập địa chỉ" type="text" value="{{$doanvien_thanhnien->DIACHI_SV}}"  required>
</div>

<div class="form-group">
  <label for="tensdt">Số điện thoại</label>
  <input class="form-control" id="tensdt" name="tensdt" placeholder="Nhập số điện thoại" type="text" value="{{$doanvien_thanhnien->SDT_SV}}"  required>
</div>

<div class="form-group">
  <label for="tenngaysinh">Ngày sinh</label>
  <input class="form-control" id="tenngaysinh" name="tenngaysinh" placeholder="Nhập ngày sinh" type="date" value="{{$doanvien_thanhnien->NGAYSINH_SV}}"  required>
</div>

 <div class="form-group">
  <label for="tenphai">Phái</label>
  <div class="col-3">
    <select class="form-control" id="tenphai" name="tenphai">
<!--       <option value="" >--Chọn giới tính--</option> -->
      <option value="1" {{old ('PHAI_SV',$doanvien_thanhnien->PHAI_SV)== "Nam" ? 'selected' : ''}}>Nam</option>
      <option value="2" {{old ('PHAI_SV',$doanvien_thanhnien->PHAI_SV)== "Nữ" ? 'selected' : ''}}>Nữ</option>
    </select>
  </div>
</div>

<div class="form-group">
  <label for="tenemail">Email</label>
  <input class="form-control" id="tenemail" name="tenemail" placeholder="Nhập email" type="text" value="{{$doanvien_thanhnien->EMAIL_SV}}"  required>
</div>

<div class="form-group">
  <label for="tenngayvaodoan">Ngày vào đoàn</label>
  <input class="form-control" id="tenngayvaodoan" name="tenngayvaodoan" placeholder="Nhập ngày vào đoàn" type="date" value="{{$doanvien_thanhnien->NGAYVAODOAN_SV}}"  required>
</div>

<div class="form-group">
  <label for="tennoivaodoan">Nơi vào đoàn</label>
  <input class="form-control" id="tennoivaodoan" name="tennoivaodoan" placeholder="Nhập nơi vào đoàn " type="text" value="{{$doanvien_thanhnien->NOIVAODOAN_SV}}"  required>
</div>

<div class="form-group">
  <label for="ngaychuyensh">Ngày chuyển sinh hoạt đoàn</label>
  <input class="form-control" id="ngaychuyensh" name="ngaychuyensh" placeholder="Nhập ngày chuyển sinh hoạt đoàn" type="date" value="{{$doanvien_thanhnien->NGAYCHUYENSH_SV}}">
</div>
</div>
<!-- /.card-body -->

<div class="box-footer">
  <button  class="btn btn-success"><a href="{{ route('doanvien_thanhnien.index') }}" style="color: white;"> Trở về </a></button>
  <button type="submit" class="btn btn-primary"> Cập nhật </button>
</div>
</form>
</div>


@endsection