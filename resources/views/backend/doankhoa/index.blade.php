 
@extends('layout.app')

@section('head_content')
DANH SÁCH ĐOÀN KHOA

@endsection
@section('link_content')
<h1>
  QUẢN LÝ ĐOÀN KHOA
  @if(Session::get('session_vt') == 1)
  <small>                
    <a href="{{route('doankhoa.create')}}" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
    <a href="{{route('tk_sinhvien_doankhoa')}}" class="btn btn-warning">
      <span aria-hidden="true" style="font-family: Arial;">Thống kê số lượng sinh viên khoa</span>
    </a>
    <a href="{{route('tk_doanvien_doankhoa')}}" class="btn btn-warning">
      <span aria-hidden="true" style="font-family: Arial;">Thống kê số lượng đoàn viên khoa</span>
    </a>
    <div class="dropdown">
      <button onclick="myFunction()" class="dropbtn btn btn-info">Thống kê số lượng chi đoàn</button>
      <div id="myDropdown" class="dropdown-content">
        <a class="dropdown-item"  href=" {{route('thongkechidoan.index')}}" class="btn btn-success">
          <span aria-hidden="true" style="font-family: Arial;">Biểu đồ tròn</span>
        </a>
        <a class="dropdown-item"  href=" {{route('bieudocot')}}" class="btn btn-success">
          <span aria-hidden="true" style="font-family: Arial;">Biểu đồ cột</span>
        </a>
        <a class="dropdown-item"  href="{{route('bieudoduong')}}" class="btn btn-success">
          <span aria-hidden="true" style="font-family: Arial;">Biểu đồ miền</span>
        </a>

      </div>
    </div>
  </small>
  @endif
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách đoàn khoa</li>
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
      <form action="{{ route('doankhoa.bulkDeleteDK') }}" method="POST" id="xoanhieuForm">
        {!! csrf_field() !!}

        <table class="table table-bordered table-striped dataTable" id="example1" role="grid" aria-describedby="example1_info">
          <thead>
            <tr role="row">
             @if(Session::get('session_vt') == 1)
             <th style="text-align: center;"><input type="checkbox"  id="selectall" class="checked" />Chọn</th>
             @endif
             <th style="text-align: center;">STT</th>
             <th style="text-align: center;">Tên đoàn khoa</th>
             @if(Session::get('session_vt') == 1)
             <th tabindex="0" class="sorting" aria-controls="example1" style="width: 232.48px;" aria-label="Platform(s): activate to sort column ascending" rowspan="1" colspan="1">Thao tác</th>
             @endif
           </tr>
         </thead>
         <?php
         $stt=1;
         ?> 
         <tbody>  
          @foreach($dk as $doankhoa)          
          <tr class="odd" role="row">
           @if(Session::get('session_vt') == 1)
           <td><input type="checkbox" onClick="checkbox_is_checked()" name="id[]" value="{{$doankhoa->ID}}" class="check-all"></td>
           @endif
           <td class="sorting_1">{{$stt++}}</td>
           <td>{{$doankhoa->TEN_DK}}
            <span  style=" float:right">(Có
              <?php
              $x = $doankhoa->ID;
              $countdoankhoa = DB::table('chidoan')->where('DOANKHOA_ID' ,'=',$x)-> where('DUYET_CD','=',NULL)->count();

              echo "<span style='color:red;font-weight:bold'>$countdoankhoa</span>" ;
              ?> Chi đoàn
            )</span>

          </td>
          @if(Session::get('session_vt') == 1)
          <td>
            <div class="btn-group">
              <a href="{{ route('doankhoa.edit',['doankhoa'=>$doankhoa->ID])}}">
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