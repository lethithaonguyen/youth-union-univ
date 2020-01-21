 
@extends('layout.app')

@section('head_content')
DANH SÁCH PHONG TRÀO CHI ĐOÀN <b>{{Session::get('session_ten_chidoan_sv')}}</b>

@endsection
@section('link_content')
<h1>
  QUẢN LÝ PHONG TRÀO CHI ĐOÀN
  <small> 
    @if(Session::get('session_vt') == 3)               
    <a href="{{route('index_get_hocky_ptcd')}}" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
    @endif
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách phong trào chi đoàn</li>
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
      <form action="{{ route('pt_chidoan.bulkDeletePTCD') }}" method="POST" id="xoanhieuForm">
        {!! csrf_field() !!}

        <table class="table table-bordered table-striped dataTable" id="example1" role="grid" aria-describedby="example1_info">
          <thead>
            <tr role="row">
              <th><input type="checkbox"  id="selectall" class="checked" />Chọn</th>
              <th style="text-align: center;">STT</th>
              <th style="text-align: center;">Tên phong trào chi đoàn</th>
              <th style="text-align: center;">Tên loại phong trào chi đoàn</th>
              <th style="text-align: center;">Tên học kỳ</th>
              <th style="text-align: center;">Tên chi đoàn</th>
              <th style="text-align: center;">Ngày bắt đầu</th>
              <th style="text-align: center;">Ngày kết thúc</th>
              <th style="text-align: center;">Ghi chú</th>
              @if(Session::get('session_vt') == 3)
              <th style="text-align: center;">Thao tác</th>
              @endif

            </tr>
          </thead>
          <?php
          $stt=1;
          ?> 
          <tbody>  
            @foreach($ptcd as $pt_chidoan)          
            <tr class="odd" role="row">
              <td><input type="checkbox" onClick="checkbox_is_checked()" name="id[]" value="{{$pt_chidoan->ID}}" class="check-all"></td>
              <td class="sorting_1">{{$stt++}}</td>
              <td>{{$pt_chidoan->TEN_PT_CD}}</td>
              <td>{{$pt_chidoan->TEN_LOAI_PT}}</td>
              <td>{{$pt_chidoan->TEN_HK}}</td>
              <td>{{$pt_chidoan->TEN_CD}}</td>
              <td>{{\Carbon\Carbon::parse($pt_chidoan->NGAY_BD_PT_CD)->format('d/m/Y')}}</td>
              <td>{{\Carbon\Carbon::parse($pt_chidoan->NGAY_KT_PT_CD)->format('d/m/Y')}}</td>
              <td>{{$pt_chidoan->GHICHU_PT_CD}}</td>
               @if(Session::get('session_vt') == 3)
              <td>
                <div class="btn-group">
                  <a href="{{ route('pt_chidoan.edit',['pt_chidoan'=>$pt_chidoan->ID])}}">
                    <button type="button" class="btn btn-block btn-info">Sửa <span class=" glyphicon glyphicon-pencil"></span>            
                    </button>
                  </a>
                </div> 

              </td>
              @endif
            </tr>
            @endforeach
          </tbody>
        </table>
        <button type="button" class="btn btn-danger" name="bulk-delete" id="bulk-delete" style="display:none">Xóa mục chọn</button>
      </form></div></div>
    </div>
    <!-- /.box-body -->

    @endsection