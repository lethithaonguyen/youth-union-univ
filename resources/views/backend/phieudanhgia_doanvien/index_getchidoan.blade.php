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
  <div class="row">
    <div class="col-sm-12">
      <div class="panel-body panel-body-with-table">

        <form method="get" action="{{route('phieudanhgia_doanvien.getchidoan')}}" >
          {!! csrf_field() !!}
          <label class="col-md-2 control-label">Chọn đoàn khoa</label>
          <div class="col-md-4">
            <select class="form-control" name="doankhoa" id="doankhoa">
              @foreach($dk  as $doankhoa)
              <option value="{{$doankhoa->ID}}">{{$doankhoa->TEN_DK}}</option>
              @endforeach
            </select>
          </div>

          <label class="col-md-2 control-label">Chọn khóa</label>
          <div class="col-md-4">
            <select class="form-control" name="khoa" id="khoa"required>
              @foreach($k as $khoa)
              <option value="{{$khoa->ID}}">{{$khoa->TEN_KHOA}}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-2 control-label">
            <button type='submit' class="btn btn-info"> Liệt kê </button>
          </div>
        </form>
        <br><br>

      </div>
    </div>
  </div>


  @endsection