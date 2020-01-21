 
@extends('layout.app')

@section('head_content')
DANH SÁCH ĐOÀN VIÊN TRƯỞNG THÀNH ĐOÀN

@endsection
@section('link_content')
<h1>
  QUẢN LÝ ĐOÀN VIÊN TRƯỞNG THÀNH ĐOÀN
  <small>                
    <a href="{{route('dv_tt_doan.create')}}" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
     &nbsp;
    <a href="{{route('qd_dv_ttdoan.index')}}"class="btn" style="background-color: purple; color: white;">
      <span aria-hidden="true" style="font-family: Arial;">Danh sách trưởng thành đoàn</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách đoàn viên trưởng thành đoàn</li>
</ol>
@endsection

@section('content')

@if(Session::has('success_message'))
<div class="alert alert-success" id="success-alert">
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

<!-- /.box-header -->
<div class="box-body">


  <div class="row">
    <div class="col-sm-12">
      <form action="{{ route('dv_tt_doan.bulkDeleteDV_TT') }}" method="POST" id="xoanhieuForm">
        {!! csrf_field() !!}

        <table class="table table-bordered table-striped dataTable" id="example1" role="grid" aria-describedby="example1_info">
          <thead>
            <tr role="row">
              <th><input type="checkbox"  id="selectall" class="checked" />Chọn</th>
              <th style="text-align: center;">STT</th>
              <th style="text-align: center;">Ngày trưởng thành đoàn</th>
              <th style="text-align: center;">Người lập</th>
              <th style="text-align: center;">Thao tác</th>
            </tr>
          </thead>
          <?php
          $stt=1;
          ?> 
          <tbody>  
            @foreach($dv_tt as $dv_tt_doan)          
            <tr class="odd" role="row">
              <td><input type="checkbox" onClick="checkbox_is_checked()" name="id[]" value="{{$dv_tt_doan->ID}}" class="check-all"></td>
              <td class="sorting_1">{{$stt++}}</td>
              <td>{{\Carbon\Carbon::parse($dv_tt_doan->NGAYTTDOAN)->format('d/m/Y')}}</td>
              <td>{{$dv_tt_doan->TEN_SV}}</td>
              <td>
                <div class="btn-group">
                  <a href="{{ route('dv_tt_doan.edit',['dv_tt_doan'=>$dv_tt_doan->ID])}}">
                    <button type="button" class="btn btn-block btn-info">Sửa <span class=" glyphicon glyphicon-pencil"></span>            
                    </button>
                  </a>
                </div> 

              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <button type="button" class="btn btn-danger" name="bulk-delete" id="bulk-delete" style="display:none">Xóa mục chọn</button>
      </form></div></div>
    </div>
    <!-- /.box-body -->

    @endsection