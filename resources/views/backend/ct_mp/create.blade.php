@extends('layout.app')

@section('head_content')
THÊM MỚI CHI TIẾT MẪU PHIẾU

@endsection
@section('link_content')
<h1>
  QUẢN LÝ CHI TIẾT MẪU PHIẾU
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách chi tiết mẫu phiếu</li>
  <li class="active">Thêm chi tiết mẫu phiếu</li>
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
  <form role="form" method="POST" action="{{ route('ct_mp.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="box-body">

      <div class="form-group">
        <label for="mauphieu">Tên mẫu phiếu</label>
        <div class="col-3">
          <select class="form-control" id="mauphieu" name="mauphieu">
           <option value="">--Chọn mẫu phiếu--</option>
           @foreach($mp as $mauphieu)
           <option value="{{$mauphieu->ID}}">{{$mauphieu->TEN_MP}}</option>
           @endforeach
         </select>
       </div>
     </div>

     <div class="form-group">
      <br><br>

      <table id="" class="table table-striped table-bordered table-hover">
        <thead>
          <th style="text-align: center;">Stt</th>
          <th style="text-align: center;">Tên nội dung</th>
          <th style="text-align: center;">Nội dung</th>
          <th style="text-align: center;"><input type="checkbox"  id="selectall" class="checked" />Chọn</th>
        </thead>
        <tbody>
          @foreach($nd_pdg as $noidung_pdg)

          <tr>
            <td>{{$noidung_pdg->ID}}</td>
            <td id="c1" headers="blank">{{$noidung_pdg->TEN_NDPDG}}</td>
            <td id="c1" headers="blank">{{$noidung_pdg->NOIDUNG_PDG}}</td>
            <td><input type="checkbox" name="noidung_pdg[]" value="{{ $noidung_pdg->ID }}"></td>

          </tr>
          @endforeach
        </tbody>

      </table>
    </div>

  </div>
  <!-- /.card-body -->

  <div class="box-footer" style=" text-align: center;">
    <button  class="btn btn-success"><a href="{{ route('ct_mp.index') }}" style="color: white;"> Trở về </a></button>
    <button type="submit" class="btn btn-primary"> Lưu </button>
  </div>
</form>
</div>


@endsection