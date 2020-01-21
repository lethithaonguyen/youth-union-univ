 
@extends('layout.app')

@section('head_content')
DANH SÁCH PHONG TRÀO ĐOÀN KHOA <b>{{Session::get('session_ten_doankhoa')}}</b>

@endsection
@section('link_content')
<h1>
  QUẢN LÝ PHONG TRÀO ĐOÀN KHOA
  <small>                
    <a href="{{route('index_get_hocky_ptdk')}}" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách phong trào đoàn khoa</li>
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
      <form action="{{ route('pt_doankhoa.bulkDeletePTDK') }}" method="POST" id="xoanhieuForm">
        {!! csrf_field() !!}

        <table class="table table-bordered table-striped dataTable" id="example1" role="grid" aria-describedby="example1_info">
          <thead>
            <tr role="row">
              <th><input type="checkbox"  id="selectall" class="checked" />Chọn</th>
              <th style="text-align: center;">STT</th>
              <th style="text-align: center;">Tên phong trào đoàn khoa</th>
              <th style="text-align: center;">Tên loại phong trào đoàn khoa</th>
              <th style="text-align: center;">Tên học kỳ</th>
              <th style="text-align: center;">Năm học</th>
              <th style="text-align: center;">Tên đoàn khoa</th>
              <th style="text-align: center;">Ngày bắt đầu</th>
              <th style="text-align: center;">Ngày kết thúc</th>
              <th style="text-align: center;">Ghi chú</th>
              <th style="text-align: center;">Thao tác</th>

            </tr>
          </thead>
          <?php
          $stt=1;
          ?> 
          <tbody>  
            @foreach($ptdk as $pt_doankhoa)          
            <tr class="odd" role="row">
              <td><input type="checkbox" onClick="checkbox_is_checked()" name="id[]" value="{{$pt_doankhoa->ID}}" class="check-all"></td>
              <td class="sorting_1">{{$stt++}}</td>
              <td>{{$pt_doankhoa->TEN_PT_DK}}</td>
              <td>{{$pt_doankhoa->TEN_LOAI_PT}}</td>
              <td>{{$pt_doankhoa->TEN_HK}}</td>
              <td>{{$pt_doankhoa->TEN_NH}}</td>
              <td>{{$pt_doankhoa->TEN_DK}}</td>
              <td>{{\Carbon\Carbon::parse($pt_doankhoa->NGAY_BD_PT_DK)->format('d/m/Y')}}</td>
              <td>{{\Carbon\Carbon::parse($pt_doankhoa->NGAY_KT_PT_DK)->format('d/m/Y')}}</td>
              <td>{{$pt_doankhoa->GHICHU_PT_DK}}</td>
              <td>
                <div  class="btn-group">
                  <a href="{{ route('pt_doankhoa.edit',['pt_doankhoa'=>$pt_doankhoa->ID])}}">
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