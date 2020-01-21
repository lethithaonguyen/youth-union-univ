@extends('layout.app')

@section('head_content')
DANH SÁCH ĐOÀN VIÊN - THANH NIÊN

@endsection
@section('link_content')
<h1>
 QUẢN LÝ ĐOÀN VIÊN - THANH NIÊN
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

        <form method="get" action="{{route('get_noidung')}}" >
          <div class="form-group">
            <label for="loai">Loại nội dung</label>
            <div class="col-3">
              <select class="form-control" id="loai" name="loai">
                <option value="">--Chọn loại nội dung--</option>
                @foreach($l_nd_pdg as $loai_noidung_pdg)
                <option value="{{$loai_noidung_pdg->ID}}">{{$loai_noidung_pdg->TEN_LOAI_NDPDG}}</option>
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