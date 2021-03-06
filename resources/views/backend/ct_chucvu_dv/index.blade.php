 
@extends('layout.app')

@section('head_content')
DANH SÁCH CHI TIẾT CHỨC VỤ ĐOÀN VIÊN @if(Session::get('session_vt') == 2) CỦA ĐOÀN KHOA {{Session::get('session_ten_doankhoa')}}
                                    @elseif(Session::get('session_vt') == 3) CỦA CHI ĐOÀN {{Session::get('session_ten_chidoan_sv')}}
                                    @endif

@endsection
@section('link_content')
<h1>
  QUẢN LÝ CHI TIẾT CHỨC VỤ ĐOÀN VIÊN
  @if(Session::get('session_vt') == 2)
  <small>                
    <a href="{{route('ct_chucvu_dv.index_getchidoan_cv')}}" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
  @endif
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách chi tiết chức vụ đoàn viên</li>
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
      <form action="{{ route('ct_chucvu_dv.bulkDeleteCT_CV_DV') }}" method="POST" id="xoanhieuForm">
        {!! csrf_field() !!}

        <table class="table table-bordered table-striped dataTable" id="example1" role="grid" aria-describedby="example1_info">
          <thead>
            <tr role="row">
              @if(Session::get('session_vt') == 2)
              <th style="text-align: center;"><input type="checkbox"  id="selectall" class="checked" />Chọn</th>@endif
              <th style="text-align: center;">STT</th>
              <th style="text-align: center;">Tên đoàn viên</th>
              <th style="text-align: center;">Tên chức vụ</th>
              <th style="text-align: center;">Đoàn khoa</th>
              <th style="text-align: center;">Chi đoàn</th>
              <th style="text-align: center;">Ngày bắt đầu</th>
              <th style="text-align: center;">Ngày kết thúc</th>
              @if(Session::get('session_vt') == 2)
              <th style="text-align: center;">Thao tác</th>
              @endif
            </tr>
          </thead>
          <?php
          $stt=1;
          ?> 
          <tbody>  
            @foreach($ct_cv_dv as $ct_chucvu_dv)          
            <tr class="odd" role="row">
              @if(Session::get('session_vt') == 2)
              <td><input type="checkbox" onClick="checkbox_is_checked()" name="id[]" value="{{$ct_chucvu_dv->ID}}" class="check-all"></td>@endif
              <td class="sorting_1">{{$stt++}}</td>
              <td>{{$ct_chucvu_dv->TEN_SV}}</td>
              <td>{{$ct_chucvu_dv->TEN_CHUCVU}}</td>
              <td>{{$ct_chucvu_dv->TEN_DK}}</td>
              <td>{{$ct_chucvu_dv->TEN_CD}}-{{$ct_chucvu_dv->TEN_KHOA}}</td>
              <td>{{\Carbon\Carbon::parse($ct_chucvu_dv->NGAYBD_CV)->format('d/m/Y')}}</td>
              <td>{{\Carbon\Carbon::parse($ct_chucvu_dv->NGAYKT_CV)->format('d/m/Y')}}</td>
              @if(Session::get('session_vt') == 2)
              <td>
                <div class="btn-group">
                  <a href="{{ route('ct_chucvu_dv.edit',['ct_chucvu_dv'=>$ct_chucvu_dv->ID])}}">
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