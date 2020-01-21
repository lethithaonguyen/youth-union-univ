@extends('layout.app')

@section('head_content')
THÊM MỚI NGÀY KẾT NẠP ĐOÀN VIÊN

@endsection
@section('link_content')
<h1>
  QUẢN LÝ NGÀY KẾT NẠP ĐOÀN VIÊN
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách ngày kết nạp đoàn viên</li>
  <li class="active">Thêm ngày kết nạp đoàn viên</li>
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
  <form role="form" method="POST" action="{{ route('dv_ketnap.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="box-body">

      <div class="form-group">
        <label for="tendoanvien_thanhnien">Tên người lập</label>
        <div class="col-3">
          <select class="form-control" id="tendoanvien_thanhnien" name="tendoanvien_thanhnien">
            <option value="">--Chọn người lập--</option>
            @foreach($dv_c as $doanvien_chon)
            <option value="{{$doanvien_chon->ID}}">{{$doanvien_chon->TEN_SV}}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group">
        <label for="ngaydv_ketnap">Ngày kết nạp đoàn viên</label>
        <input class="form-control" id="ngaydv_ketnap" name="ngaydv_ketnap" placeholder="Nhập ngày kết nạp đoàn viên" type="date"  required>
      </div>

    </div>
    <!-- /.card-body -->

    <div class="box-footer">
      <button  class="btn btn-success"><a href="{{ route('dv_ketnap.index') }}" style="color: white;"> Trở về</a></button>
      <button type="submit" class="btn btn-primary"> Lưu </button>
    </div>
  </form>
</div>


@endsection