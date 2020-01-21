@extends('layout.app')

@section('head_content')
CẬP NHẬT CHI ĐOÀN

@endsection
@section('link_content')
<h1>
  QUẢN LÝ CHI ĐOÀN
  <small>                
    <a href="" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách chi đoàn</li>
  <li class="active">Cập nhật chi đoàn</li>
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
  <form role="form" method="post" action="{{route('chidoan.update',['chidoan'=>$chidoan->ID])}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field("PATCH") }}
    <div class="box-body">

     <div class="form-group">
      <label for="tendoankhoa">Tên đoàn khoa</label>
      <div class="col-3">
        <select class="form-control" id="tendoankhoa" name="tendoankhoa">
         <option value="">--Chọn Đoàn Khoa-</option>
         @foreach($dk as $doankhoa)
         <option value="{{ $doankhoa->ID }}" <?php echo ($doankhoa->ID == $chidoan->DOANKHOA_ID) ? 'selected' : '' ?>>{{ $doankhoa->TEN_DK }}</option>
         @endforeach
       </select>
     </div>
   </div>

   <div class="form-group">
    <label for="tenkhoa">Tên khóa</label>
    <div class="col-3">
      <select class="form-control" id="tenkhoa" name="tenkhoa">
       <option value="">--Chọn Khóa-</option>
       @foreach($k as $khoa)
       <option value="{{ $khoa->ID }}" <?php echo ($khoa->ID == $chidoan->KHOA_ID) ? 'selected' : '' ?>>{{ $khoa->TEN_KHOA }}</option>
       @endforeach
     </select>
   </div>
 </div>

 <div class="form-group">
  <label for="tenchidoan">Tên chi đoàn</label>
  <input class="form-control" id="tenchidoan" name="tenchidoan" placeholder="Nhập tên chi đoàn" type="text" value="{{$chidoan->TEN_CD}}"  required>
</div>

<div class="form-group">
  <label for="ngaythanhlap">Ngày thành lập</label>
  <input class="form-control" id="ngaythanhlap" name="ngaythanhlap" placeholder="Nhập tên ngày thành lập" type="date" value="{{$chidoan->NGAY_THANHLAP}}"  required>
</div>
</div>
<!-- /.card-body -->

<div class="box-footer">
  <button  class="btn btn-success"><a href="{{ route('chidoan.index') }}" style="color: white;"> Trở về </a></button>
  <button type="submit" class="btn btn-primary"> Cập nhật </button>
</div>
</form>
</div>


@endsection