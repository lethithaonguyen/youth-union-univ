@extends('layout.app')

@section('head_content')
LỌC ĐOÀN VIÊN THANH NIÊN THEO CHI ĐOÀN

@endsection
@section('link_content')
<h1>
  THÊM ĐOÀN VIÊN THANH NIÊN
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Thêm đoàn viên thanh niên</li>
  <li class="active">Lọc đoàn viên thanh niên theo chi đoàn</li>
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

        <form method="get" action="{{route('doanvien_thanhnien.doankhoa_getdoanvien')}}" >
          <div class="form-group">
            <label for="chidoan">Tên chi đoàn</label>
            <div class="col-3">
              <select class="form-control" id="chidoan" name="chidoan" required>
                <option value="">--Chọn chi đoàn--</option>
                @foreach($cd as $chidoan)
                <option value="{{$chidoan->ID}}">{{$chidoan->TEN_CD}}</option>
                @endforeach
              </select>
            </div>
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