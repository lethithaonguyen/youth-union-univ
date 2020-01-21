@extends('layout.app')

@section('head_content')
LỌC HỌC KỲ THEO NĂM

@endsection
@section('link_content')
<h1>
 QUẢN LÝ PHONG TRÀO CHI ĐOÀN
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Quản lý phong trào chi đoàn</li>
  <li class="active">Lọc học kỳ theo năm</li>
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

        <form method="get" action="{{route('pt_chidoan.get_hocky_ptcd')}}" required >
          <div class="form-group">
            <label for="namhoc">Năm học</label>
            <div class="col-3">
              <select class="form-control" id="namhoc" name="namhoc">
                <option value="">--Chọn năm học--</option>
                @foreach($nh as $namhoc)
                <option value="{{$namhoc->ID}}">{{$namhoc->TEN_NH}}</option>
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