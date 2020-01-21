@extends('layout.app')

@section('head_content')
LỌC ĐOÀN VIÊN THEO CHI ĐOÀN VÀ PHONG TRÀO THEO HỌC KỲ

@endsection
@section('link_content')
<h1>
 QUẢN LÝ THÀNH TÍCH THAM GIA
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Quản lý thành tích tham gia</li>
  <li class="active">Lọc đoàn viên theo chi đoàn và phong trào theo học kỳ</li>
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

        <form method="get" action="{{route('thanhtich_thamgia.getdoanvien_tttg')}}" >
          <div class="form-group">
            <label for="chidoan">Chi đoàn</label>
            <div class="col-3">
              <select class="form-control" id="chidoan" name="chidoan" required>
                <option value="">--Chọn chi đoàn--</option>
                @foreach($cd as $chidoan)
                <option value="{{$chidoan->ID}}">{{$chidoan->TEN_CD}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="hocky">Học kỳ</label>
            <div class="col-3">
              <select class="form-control" id="hocky" name="hocky" required>
                <option value="">--Chọn học kỳ--</option>
                @foreach($hk as $hocky)
                <option value="{{$hocky->ID}}">{{$hocky->TEN_HK}}</option>
                @endforeach
              </select>
            </div>
          </div>
{{--           <div class="form-group">
            <label for="mssv">MSSV</label>
            <input type="text" class="form-control" id="mssv" name="mssv">
          </div> --}}
          <div class="col-md-2 control-label">
            <button type='submit' class="btn btn-info"> Liệt kê </button>
          </div>
        </form>
        <br><br>

      </div>
    </div>
  </div>


  @endsection