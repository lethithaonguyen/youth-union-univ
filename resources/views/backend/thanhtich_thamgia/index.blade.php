 
@extends('layout.app')

@section('head_content')
DANH SÁCH THÀNH TÍCH THAM GIA CỦA @if(Session::get('session_vt')==2)ĐOÀN KHOA: <b>{{Session::get('session_ten_doankhoa')}}</b>@elseif(Session::get('session_vt')==4)ĐOÀN VIÊN: <b>{{Session::get('session_ten_sv')}}</b> @endif

@endsection
@section('link_content')
<h1>
  QUẢN LÝ THÀNH TÍCH THAM GIA
  @if(Session::get('session_vt')==2)
  <small>                
    <a href="{{route('thanhtich_thamgia.index_getchidoan_tttg')}}" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
  @endif
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách thành tích tham gia</li>
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
      <form action="{{ route('thanhtich_thamgia.bulkDeleteTTTG') }}" method="POST" id="xoanhieuForm">
        {!! csrf_field() !!}

        <table class="table table-bordered table-striped dataTable" id="example1" role="grid" aria-describedby="example1_info">
          <thead>
            <tr role="row">
              @if(Session::get('session_vt')==2)
              <th><input type="checkbox"  id="selectall" class="checked" />Chọn</th>
              @endif
              <th style="text-align: center;">STT</th>

              <th style="text-align: center;">Đoàn viên</th>
              <th style="text-align: center;">Chi đoàn</th>
              <th style="text-align: center;">Khóa</th>
              <th style="text-align: center;">Phong trào đoàn khoa</th>
              <th style="text-align: center;">Thành tích</th>
              <th style="text-align: center;">Năm học - học kỳ</th>
              <th style="text-align: center;">Diễn giải thành tích tham gia</th>
              @if(Session::get('session_vt')==2)
              <th style="text-align: center;">Thao tác</th>
              @endif
            </tr>
          </thead>
          <?php
          $stt=1;
          ?> 
          <tbody>  
            @foreach($tt_tg as $thanhtich_thamgia)          
            <tr class="odd" role="row">
              @if(Session::get('session_vt')==2)
              <td><input type="checkbox" onClick="checkbox_is_checked()" name="id[]" value="{{$thanhtich_thamgia->ID}}" class="check-all"></td>
              @endif
              <td class="sorting_1">{{$stt++}}</td>

              <td>{{$thanhtich_thamgia->TEN_SV}}</td>
              <td>{{$thanhtich_thamgia->TEN_CD}}</td>
              <td>{{$thanhtich_thamgia->TEN_KHOA}}</td>
              <td>{{$thanhtich_thamgia->TEN_PT_DK}}</td>
              <td>{{$thanhtich_thamgia->TEN_TT}}</td>
              <td>{{$thanhtich_thamgia->TEN_NH}} {{$thanhtich_thamgia->TEN_HK}}</td>
              <td>{{$thanhtich_thamgia->DIENGIAI}}</td>
              @if(Session::get('session_vt')==2)
              <td>
                <div style="" class="btn-group">
                  <a href="{{ route('thanhtich_thamgia.edit',$thanhtich_thamgia->ID)}}">
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