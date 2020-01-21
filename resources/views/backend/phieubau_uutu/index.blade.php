 
@extends('layout.app')

@section('head_content')
DANH SÁCH PHIẾU BẦU ƯU TÚ @if(Session::get('session_vt')==3) CỦA CHI ĐOÀN <b>{{Session::get('session_ten_chidoan_sv')}}-{{Session::get('session_ten_khoa_sv')}}</b>
@elseif(Session::get('session_vt')==2) CỦA ĐOÀN KHOA <b>{{Session::get('session_ten_doankhoa')}}</b> @endif

@endsection
@section('link_content')
<h1>
  QUẢN LÝ PHIẾU BẦU ƯU TÚ
  @if(Session::get('session_vt')==3)
  <small>                
    <a href="{{route('phieubau_uutu.create')}}" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
   &nbsp;
  <small>                
    <a href="{{route('chitiet_bau_ut.index')}}" class="btn" style="background-color: purple; color: white;">
      <span aria-hidden="true" style="font-family: Arial;">Danh sách bầu ưu tú</span>
    </a>
  </small>
  @endif
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách phiếu bầu ưu tú</li>
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
      <form action="{{ route('phieubau_uutu.bulkDeletePBUT') }}" method="POST" id="xoanhieuForm">
        {!! csrf_field() !!}

        <table class="table table-bordered table-striped dataTable" id="example1" role="grid" aria-describedby="example1_info">
          <thead>
            <tr role="row">
              <th><input type="checkbox"  id="selectall" class="checked" />Chọn</th>
              <th style="text-align: center;">STT</th>
              <th style="text-align: center;">Số phiếu bầu ưu tú</th>
              <th style="text-align: center;">Chi đoàn - khóa</th>
              <th style="text-align: center;">Đoàn viên lập phiếu</th>
              <th style="text-align: center;">Ngày bầu</th>
              @if(Session::get('session_vt')==3)
              <th style="text-align: center;">Thao tác</th>
              @endif
            </tr>
          </thead>
          <?php
          $stt=1;
          ?> 
          <tbody>  
            @foreach($pbut as $phieubau_uutu)          
            <tr class="odd" role="row">
              <td><input type="checkbox" onClick="checkbox_is_checked()" name="id[]" value="{{$phieubau_uutu->ID}}" class="check-all"></td>
              <td class="sorting_1">{{$stt++}}</td>
              <td>{{$phieubau_uutu->SOPHIEU_TONG}}</td>
              <td>{{$phieubau_uutu->TEN_CD}}-{{$phieubau_uutu->TEN_KHOA}}</td>
              <td>{{$phieubau_uutu->TEN_SV}}</td>
              <td>{{\Carbon\Carbon::parse($phieubau_uutu->NGAY_BAU)->format('d/m/Y')}}</td>
              @if(Session::get('session_vt')==3)
              <td>
                <div class="btn-group">
                  <a href="{{ route('phieubau_uutu.edit',['phieubau_uutu'=>$phieubau_uutu->ID])}}">
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