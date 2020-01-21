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

        <form method="get" action="{{route('get_phuongxa')}}" >
          {!! csrf_field() !!}
          <label class="col-md-2 control-label">Chọn quận - huyện của quê quán</label>
          <div class="col-md-4">
            <select class="form-control" name="qq_qh" id="qq_qh">
              @foreach($nq_qh as $nq_quanhuyen)
              <option value="{{$nq_quanhuyen->ID}}">{{$nq_quanhuyen->TEN_QH}}</option>
              @endforeach
            </select>
          </div>

          <label class="col-md-2 control-label">Chọn quận - huyện của nơi sinh </label>
          <div class="col-md-4">
            <select class="form-control" name="ns_qh" id="ns_qh">
              @foreach($ns_qh as $ns_quanhuyen)
              <option value="{{$ns_quanhuyen->ID}}">{{$ns_quanhuyen->TEN_QH}}</option>
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