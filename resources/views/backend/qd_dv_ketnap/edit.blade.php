@extends('layout.app')

@section('head_content')
CẬP NHẬT QUYẾT ĐỊNH KẾT NẠP

@endsection
@section('link_content')
<h1>
  QUẢN LÝ QUYẾT ĐỊNH KẾT NẠP
  <small>                
    <a href="" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách quyết định kết nạp</li>
  <li class="active">Cập nhật quyết định kết nạp</li>
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
  <form role="form" method="post" action="{{route('qd_dv_ketnap.update',['qd_dv_ketnap'=>$qd_dv_ketnap->ID])}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field("PATCH") }}
    <div class="box-body">

     <div class="form-group">
      <label for="tendoanvien_thanhnien">Tên đoàn viên kết nạp</label>
      <div class="col-3">
        <select class="form-control" id="tendoanvien_thanhnien" name="tendoanvien_thanhnien">
         <option value="">--Chọn đoàn viên kết nạp-</option>
         @foreach($dv_tn as $doanvien_thanhnien)
         <option value="{{ $doanvien_thanhnien->ID }}" <?php echo ($doanvien_thanhnien->ID == $qd_dv_ketnap->DOANVIEN_THANHNIEN_ID) ? 'selected' : '' ?>>{{ $doanvien_thanhnien->TEN_SV }}</option>
         @endforeach
       </select>
     </div>
   </div>

   <div class="form-group">
    <label for="tendv_ketnap">Ngày kết nap</label>
    <div class="col-3">
      <select class="form-control" id="tendv_ketnap" name="tendv_ketnap">
       <option value="">--Chọn ngày kết nap--</option>
       @foreach($dv_kn as $dv_ketnap)
       <option value="{{ $dv_ketnap->ID }}" <?php echo ($dv_ketnap->ID == $qd_dv_ketnap->DV_KETNAP_ID) ? 'selected' : '' ?>>{{ $dv_ketnap->NGAYKETNAP }}</option>
       @endforeach
     </select>
   </div>
 </div>
</div>
<!-- /.card-body -->

<div class="box-footer">
  <button  class="btn btn-success"><a href="{{ route('qd_dv_ketnap.index') }}" style="color: white;"> Trở về </a></button>
  <button type="submit" class="btn btn-primary"> Cập nhật </button>
</div>
</form>
</div>


@endsection