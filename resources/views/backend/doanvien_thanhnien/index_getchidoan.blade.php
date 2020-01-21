@extends('layout.app')

@section('head_content')
DANH SÁCH ĐOÀN VIÊN - THANH NIÊN

@endsection
@section('link_content')
<h1>
QUẢN LÝ ĐOÀN VIÊN - THANH NIÊN
<small> 
    @if(Session::get('session_vt') == 1)                
    <div class="dropdown">
      <button onclick="myFunction()" class="dropbtn btn btn-info">Thống kê sinh viên</button>
      <div id="myDropdown" class="dropdown-content">
        <a class="dropdown-item"  href=" {{route('thongke_quequan')}}" class="btn btn-success">
          <span aria-hidden="true" style="font-family: Arial;">Theo quê quán</span>
        </a>
        <a class="dropdown-item"  href=" {{route('thongke_noisinh')}}" class="btn btn-success">
          <span aria-hidden="true" style="font-family: Arial;">Theo nơi sinh</span>
        </a>
        <a class="dropdown-item"  href="{{route('thongke_dantoc')}}" class="btn btn-success">
          <span aria-hidden="true" style="font-family: Arial;">Theo dân tộc</span>
        </a>
        <a class="dropdown-item"  href="{{route('thongke_tongiao')}}" class="btn btn-success">
          <span aria-hidden="true" style="font-family: Arial;">Theo tôn giáo</span>
        </a>

      </div>
    </div>

    <div class="dropdown">
      <button onclick="Function()" class="dropbtn btn btn-info">Thống kê đoàn viên</button>
      <div id="Dropdown" class="dropdown-content">
        <a class="dropdown-item"  href=" {{route('thongke_quequan_dv')}}" class="btn btn-success">
          <span aria-hidden="true" style="font-family: Arial;">Theo quê quán</span>
        </a>
        <a class="dropdown-item"  href=" {{route('thongke_noisinh_dv')}}" class="btn btn-success">
          <span aria-hidden="true" style="font-family: Arial;">Theo nơi sinh</span>
        </a>
        <a class="dropdown-item"  href="{{route('thongke_dantoc_dv')}}" class="btn btn-success">
          <span aria-hidden="true" style="font-family: Arial;">Theo dân tộc</span>
        </a>
        <a class="dropdown-item"  href="{{route('thongke_tongiao_dv')}}" class="btn btn-success">
          <span aria-hidden="true" style="font-family: Arial;">Theo tôn giáo</span>
        </a>

      </div>
    </div>
    @endif
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Quản lý đoàn viên - thanh niên</li>
  <li class="active">Danh sách đoàn viên - thanh niên</li>
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

        <form method="get" action="{{route('doanvien_thanhnien.getchidoan')}}" >
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
            <select class="form-control" name="khoa" id="khoa">
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