@extends('layout.app')

@section('head_content')
THÊM MỚI ĐOÀN VIÊN - THANH NIÊN

@endsection
@section('link_content')
<h1>
  QUẢN LÝ ĐOÀN VIÊN - THANH NIÊN
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách đoàn viên - thanh niên</li>
  <li class="active">Thêm đoàn viên - thanh niên</li>
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
  <form role="form" method="POST" action="{{ route('doanvien_thanhnien.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="box-body">

      <div class="form-group">
        <label for="tenphuong_xa_qq">Quê quán</label>
        <div class="col-3">
          <select class="form-control" id="tenphuong_xa_qq" name="tenphuong_xa_qq">
           <option value="">--Chọn quê quán--</option>
           @foreach($pxqq as $phuong_xa_qq)
           <option value="{{$phuong_xa_qq->ID}}">{{$phuong_xa_qq->TEN_PX}}--quận/huyện {{$phuong_xa_qq->TEN_QH}}--tỉnh/tp {{$phuong_xa_qq->TEN_TP}}</option>
           @endforeach
         </select>
       </div>
     </div>

     <div class="form-group">
      <label for="tenchidoan">Chi đoàn</label>
      <div class="col-3">
        <select class="form-control" id="tenchidoan" name="tenchidoan">
         <option value="">--Chọn chi đoàn--</option>
         @foreach($cd as $chidoan)
         <option value="{{$chidoan->ID}}">{{$chidoan->TEN_CD}}-{{$chidoan->TEN_KHOA}}</option>
         @endforeach
       </select>
     </div>
   </div>

   <div class="form-group">
    <label for="tentongiao">Tôn giáo</label>
    <div class="col-3">
      <select class="form-control" id="tentongiao" name="tentongiao">
       <option value="">--Chọn tôn giáo--</option>
       @foreach($tg as $tongiao)
       <option value="{{$tongiao->ID}}">{{$tongiao->TEN_TG}}</option>
       @endforeach
     </select>
   </div>
 </div>

 <div class="form-group">
  <label for="tenphuong_xa_ns">Nơi sinh</label>
  <div class="col-3">
    <select class="form-control" id="tenphuong_xa_ns" name="tenphuong_xa_ns">
     <option value="">--Chọn nơi sinh--</option>
     @foreach($pxns as $phuong_xa_ns)
     <option value="{{$phuong_xa_ns->ID}}">{{$phuong_xa_ns->TEN_PX}} -- quận/huyện {{$phuong_xa_ns->TEN_QH}} --tỉnh/tp {{$phuong_xa_ns->TEN_TP}}</option>
     @endforeach
   </select>
 </div>
</div>

<div class="form-group">
  <label for="tendantoc">Dân tộc</label>
  <div class="col-3">
    <select class="form-control" id="tendantoc" name="tendantoc">
     <option value="">--Chọn dân tộc--</option>
     @foreach($dt as $dantoc)
     <option value="{{$dantoc->ID}}">{{$dantoc->TEN_DT}}</option>
     @endforeach
   </select>
 </div>
</div>

<div class="form-group">
  <label for="tenmssv">MSSV</label>
  <input class="form-control" id="tenmssv" name="tenmssv" placeholder="Nhập mssv" type="text"  required>
</div>

<div class="form-group">
  <label for="tendoanvien_thanhnien">Tên đoàn viên thanh niên</label>
  <input class="form-control" id="tendoanvien_thanhnien" name="tendoanvien_thanhnien" placeholder="Nhập tên đoàn viên thanh niên" type="text"  required>
</div>

<div class="form-group">
  <label for="tendiachi">Địa chỉ</label>
  <input class="form-control" id="tendiachi" name="tendiachi" placeholder="Nhập địa chỉ" type="text"  required>
</div>

<div class="form-group">
  <label for="tensdt">Số điện thoại</label>
  <input class="form-control" id="tensdt" name="tensdt" placeholder="Nhập số điện thoại" type="text"  required maxlength="10" >
</div>

<div class="form-group">
  <label for="tenngaysinh">Ngày sinh</label>
  <input class="form-control" id="tenngaysinh" name="tenngaysinh" placeholder="Nhập ngày sinh" type="date"  required>
</div>

<div class="form-group">
  <label for="tenphai">Phái</label>
  <div class="col-3">
    <select class="form-control" id="tenphai" name="tenphai">
      <option value="" >--Chọn giới tính--</option>
      <option value="1">Nam</option>
      <option value="2">Nữ</option>
    </select>
  </div>
</div>



<div class="form-group">
  <label for="tenemail">Email</label>
  <input class="form-control" id="tenemail" name="tenemail" placeholder="Nhập email" type="email"  required title="Ví dụ nguyen@gmail.com">
</div>

<div class="form-group">
  <label for="tenngayvaodoan">Ngày vào đoàn</label>
  <input class="form-control" id="tenngayvaodoan" name="tenngayvaodoan" placeholder="Nhập ngày vào đoàn" type="date">
</div>

<div class="form-group">
  <label for="tennoivaodoan">Nơi vào đoàn</label>
  <input class="form-control" id="tennoivaodoan" name="tennoivaodoan" placeholder="Nhập nơi vào đoàn" type="text" >
</div>

<div class="form-group">
  <label for="ngaychuyensh">Ngày chuyển sinh hoạt đoàn</label>
  <input class="form-control" id="ngaychuyensh" name="ngaychuyensh" placeholder="Nhập ngày chuyển sinh hoạt đoàn" type="date">
</div>
</div>
<!-- /.card-body -->

<div class="box-footer">
  <button  class="btn btn-success"><a href="{{ route('doanvien_thanhnien.index') }}" style="color: white;"> Trở về </a></button>
  <button type="submit" class="btn btn-primary"> Lưu </button>
</div>
</form>
</div>


@endsection