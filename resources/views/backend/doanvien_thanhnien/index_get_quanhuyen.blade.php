@extends('layout.app')

@section('head_content')
THÊM MỚI ĐOÀN VIÊN - THANH NIÊN

@endsection
@section('link_content')
<h1>
  THÔNG TIN ĐOÀN VIÊN - THANH NIÊN
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
  <div class="row">
    <div class="col-sm-12">
      <div class="panel-body panel-body-with-table">

        <form method="get" action="{{route('get_quanhuyen')}}" >
          {!! csrf_field() !!}
          <label class="col-md-2 control-label">Chọn tỉnh - thành phố của quê quán</label>
          <div class="col-md-4">
            <select class="form-control" name="nq_tp" id="nq_tp">
              @foreach($t_tp as $tinh_thanhpho)
              <option value="{{$tinh_thanhpho->ID}}">{{$tinh_thanhpho->TEN_TP}}</option>
              @endforeach
            </select>
          </div>

          <label class="col-md-2 control-label">Chọn tỉnh - thành phố của nơi sinh </label>
          <div class="col-md-4">
            <select class="form-control" name="ns_tp" id="ns_tp">
              @foreach($t_tp as $tinh_thanhpho)
              <option value="{{$tinh_thanhpho->ID}}">{{$tinh_thanhpho->TEN_TP}}</option>
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