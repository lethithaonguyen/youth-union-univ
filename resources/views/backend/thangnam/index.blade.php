 
@extends('layout.app')

@section('head_content')
DANH SÁCH ĐOÀN PHÍ THEO THÁNG NĂM

@endsection
@section('link_content')
<h1>
  QUẢN LÝ ĐOÀN PHÍ THEO THÁNG NĂM
  <small>                
    <a href="{{route('thangnam.create')}}" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách đoàn phí theo tháng năm</li>
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
      <form action="{{ route('thangnam.bulkDeleteTN') }}" method="POST" id="xoanhieuForm">
        {!! csrf_field() !!}
        <table class="table table-bordered table-striped dataTable" id="example1" role="grid" aria-describedby="example1_info">
          <thead>
            <tr role="row">
              <th><input type="checkbox"  id="selectall" class="checked" />Chọn</th>
              <th style="text-align: center;">STT</th>
              <th style="text-align: center;">Tháng</th>
              <th style="text-align: center;">Năm học</th>
              <th style="text-align: center;">Số tiền đoàn phí</th>
              <th style="text-align: center;">Thao tác</th>

            </tr>
          </thead>
          <?php
          $stt=1;
          ?> 
          <tbody>  
            @foreach($tn as $thangnam)          
            <tr class="odd" role="row">
              <td><input type="checkbox" onClick="checkbox_is_checked()" name="id[]" value="{{$thangnam->ID}}" class="check-all"></td>
              <td class="sorting_1">{{$stt++}}</td>
              <td>{{$thangnam->THANGNAM}}</td>
              <td>{{$thangnam->TEN_NH}}</td>
              <td>{{number_format($thangnam->SOTIEN_DOANPHI)}}</td>
              <td>
                <div class="btn-group">
                  <a href="{{ route('thangnam.edit',['thangnam'=>$thangnam->ID])}}">
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