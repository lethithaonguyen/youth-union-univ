@extends('layout.app')

@section('head_content')
CẬP NHẬT ĐOÀN VIÊN KẾT NẠP

@endsection
@section('link_content')
<h1>
  QUẢN LÝ ĐOÀN VIÊN KẾT NẠP
  <small>                
    <a href="{{route('dv_tt_doan.create')}}" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách ngày trưởng thành đoàn</li>
  <li class="active">Cập nhật ngày trưởng thành đoàn</li>
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
  <form role="form" method="post" action="{{route('dv_tt_doan.update',['dv_tt_doan'=>$dv_tt_doan->ID])}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field("PATCH") }}
    <div class="box-body">

      <div class="form-group">
        <label for="tendoanvien_thanhnien">Tên người lập</label>
        <div class="col-3">
          <select class="form-control" id="tendoanvien_thanhnien" name="tendoanvien_thanhnien">
            <option value="">--Chọn người lập--</option>
           @foreach($dv_tn as $doanvien_thanhnien)
           <option value="{{ $doanvien_thanhnien->ID }}" <?php echo ($doanvien_thanhnien->ID == $dv_tt_doan->DOANVIEN_THANHNIEN_ID) ? 'selected' : '' ?>>{{ $doanvien_thanhnien->TEN_SV }}</option>
           @endforeach
         </select>
       </div>
     </div>

     <div class="form-group">
      <label for="ngaydv_tt_doan">Ngày trưởng thành đoàn</label>
      <input class="form-control" id="ngaydv_tt_doan" name="ngaydv_tt_doan" placeholder="Nhập ngày trưởng thành đoàn" type="date" value="{{$dv_tt_doan->NGAYTTDOAN}}" required>
    </div>

  </div>
  <!-- /.card-body -->

  <div class="box-footer">
    <button  class="btn btn-success"><a href="{{ route('dv_tt_doan.index') }}" style="color: white;"> Trở về </a></button>
    <button type="submit" class="btn btn-primary"> Cập nhật </button>
  </div>
</form>
</div>


@endsection