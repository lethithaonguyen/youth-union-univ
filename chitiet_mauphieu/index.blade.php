 
@extends('layout.app')

@section('head_content')
DANH SÁCH CHI TIẾT MẪU PHIẾU

@endsection
@section('link_content')
<h1>
  QUẢN LÝ CHI TIẾT MẪU PHIẾU
  <small>                
    <a href="{{route('index_get_noidung')}}" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách chi tiết mẫu phiếu</li>
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
      <form action="{{ route('chitiet_mauphieu.bulkDeleteCTMP') }}" method="POST" id="xoanhieuForm">
        {!! csrf_field() !!}

        <table class="table table-bordered table-striped dataTable" id="example1" role="grid" aria-describedby="example1_info">
          <thead>
            <tr role="row">
              <th><input type="checkbox"  id="selectall" class="checked" />Chọn</th>
              <th tabindex="0" class="sorting_asc" aria-controls="example1" style="width: 213.8px;" aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending" rowspan="1" colspan="1">STT</th>
              <th tabindex="0" class="sorting" aria-controls="example1" style="width: 262.33px;" aria-label="Browser: activate to sort column ascending" rowspan="1" colspan="1">Tên mẫu phiếu</th>
              <th tabindex="0" class="sorting" aria-controls="example1" style="width: 262.33px;" aria-label="Browser: activate to sort column ascending" rowspan="1" colspan="1">Tên nội dung phiếu đánh giá</th>
              <th tabindex="0" class="sorting" aria-controls="example1" style="width: 262.33px;" aria-label="Browser: activate to sort column ascending" rowspan="1" colspan="1">Tên thứ tự nội dung phiếu đánh giá</th>
              <th tabindex="0" class="sorting" aria-controls="example1" style="width: 232.48px;" aria-label="Platform(s): activate to sort column ascending" rowspan="1" colspan="1">Thao tác</th>

            </tr>
          </thead>
          <?php
          $stt=1;
          ?> 
          <tbody>  
            @foreach($ct_mp as $chitiet_mauphieu)          
            <tr class="odd" role="row">
              <td><input type="checkbox" onClick="checkbox_is_checked()" name="id[]" value="{{$chitiet_mauphieu->ID}}" class="check-all"></td>
              <td class="sorting_1">{{$stt++}}</td>
              <td>{{$chitiet_mauphieu->TEN_MP}}</td>
              <td>{{$chitiet_mauphieu->TEN_NDPDG}}</td>
              <td>{{$chitiet_mauphieu->THUTU_NOIDUNG}}</td>
              <td>
                <div style="width:50%" class="btn-group">
                  <a href="{{ route('chitiet_mauphieu.edit',$chitiet_mauphieu->ID)}}">
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