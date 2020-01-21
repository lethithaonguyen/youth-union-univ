 
@extends('layout.app')

@section('head_content')
DANH SÁCH ĐOÀN VIÊN - THANH NIÊN @if(Session::get('session_vt') == 3) 
THUỘC CHI ĐOÀN :{{ Session::get('session_ten_chidoan_sv') }} 
@endif

@endsection
@section('link_content')
<h1>
  QUẢN LÝ ĐOÀN VIÊN - THANH NIÊN @if(Session::get('session_vt') == 3) 
  THUỘC CHI ĐOÀN :{{ Session::get('session_ten_chidoan_sv') }}-{{Session::get('session_ten_khoa_sv')}}@endif
  <small> 
    @if(Session::get('session_vt') == 2)                
    <a href="{{route('index_get_quanhuyen')}}" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
    @endif
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách đoàn viên - thanh niên</li>
</ol>

@endsection


@section('content')

<!-- import-export -->
@if(Session::get('session_vt') == 2)  
<div class="card-body">
  <form action="{{ route('importdv')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" class="form-control">
    <br>
    <button class="btn btn-success">Nhập file excel</button>
@endif
    <a class="btn btn-warning" href="{{ route('exportdv') }}">Xuất file excel</a>

  </form>
</div>

<!--end import-export -->
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


  <div class="row" id="noidung">
    <div class="col-sm-12" >
      <form action="@if(Session::get('session_vt') == 2) {{ route('doanvien_thanhnien.bulkDeleteDVTN') }}@endif" method="POST" id="xoanhieuForm" class="table">
        {!! csrf_field() !!}

        <table class="table table-bordered table-striped dataTable" id="example1" role="grid" aria-describedby="example1_info">
          <thead>
            <tr role="row">
              @if(Session::get('session_vt') == 2) 
              <th><input type="checkbox"  id="selectall" class="checked" />Chọn</th>
              @endif
              <th style="text-align: center;">STT</th>
              <th style="text-align: center;">MSSV</th>
              <th style="text-align: center;">Họ tên</th>
              <th style="text-align: center;">Đia chỉ</th>
              <th style="text-align: center;">Số điện thoại</th>
              <th style="text-align: center;">Ngày sinh</th>
              <th style="text-align: center;">Phái</th>
              <th style="text-align: center;">Email</th>
              <th style="text-align: center;">Ngày vào đoàn</th>
              <th style="text-align: center;">Nơi vào đoàn</th>
              <th style="text-align: center;">Quê quán</th>
              <th style="text-align: center;">Chi đoàn</th>
              <th style="text-align: center;">Tôn giáo</th>
              <th style="text-align: center;">Nơi sinh</th>
              <th style="text-align: center;">Dân tộc</th>
              <th style="text-align: center;">Ngày chuyển sinh hoạt đoàn</th>
              @if(Session::get('session_vt') == 2) 
              <th style="text-align: center;">Thao tác</th>
              @endif
            </tr>
          </thead>
          <?php
          $stt=1;
          ?> 
          <tbody >  
            @foreach($dvtn as $doanvien_thanhnien)          
            <tr class="odd" role="row">
              @if(Session::get('session_vt') == 2) 
              <td><input type="checkbox" onClick="checkbox_is_checked()" name="id[]" value="{{$doanvien_thanhnien->ID}}" class="check-all"></td>
              @endif
              <td class="sorting_1">{{$stt++}}</td>
              <td>{{$doanvien_thanhnien->MSSV}}</td>
              <td>{{$doanvien_thanhnien->TEN_SV}}</td>
              <td>{{$doanvien_thanhnien->DIACHI_SV}}</td>
              <td>{{$doanvien_thanhnien->SDT_SV}}</td>
              <td>
                @if($doanvien_thanhnien->NGAYSINH_SV == Null)
                {{$doanvien_thanhnien->NGAYSINH_SV}}
                @else
                {{\Carbon\Carbon::parse($doanvien_thanhnien->NGAYSINH_SV)->format('d/m/Y')}}
                @endif
              </td>
              <td>  @if ($doanvien_thanhnien->PHAI_SV == 1)
                Nam
                @else
                Nữ
              @endif</td>
              <td>{{$doanvien_thanhnien->EMAIL_SV}}</td>
              <td>
                {{-- @if($doanvien_thanhnien->NGAYVAODOAN_SV == Null) --}}
                {{$doanvien_thanhnien->NGAYVAODOAN_SV}}
               {{--  @else
                {{\Carbon\Carbon::parse($doanvien_thanhnien->NGAYVAODOAN_SV)->format('d/m/Y')}}
                @endif --}}
              </td>
              <td>{{$doanvien_thanhnien->NOIVAODOAN_SV}}</td>
              <td>{{$doanvien_thanhnien->qq_phuong}}-{{$doanvien_thanhnien->qq_quan}}-{{$doanvien_thanhnien->qq_tp}}</td>
              
              <td>{{$doanvien_thanhnien->TEN_CD}}-{{$doanvien_thanhnien->TEN_KHOA}}</td>
              <td>{{$doanvien_thanhnien->TEN_TG}}</td>
              <td>{{$doanvien_thanhnien->ns_phuong}}-{{$doanvien_thanhnien->ns_quan}}-{{$doanvien_thanhnien->ns_tp}}</td>

              <td>{{$doanvien_thanhnien->TEN_DT}}</td>
              <td>
              {{--   @if($doanvien_thanhnien->NGAYVAODOAN_SV == Null)
                {{$doanvien_thanhnien->NGAYVAODOAN_SV}}
                @else --}}
               {{--  {{\Carbon\Carbon::parse($doanvien_thanhnien->NGAYCHUYENSH_SV)->format('d/m/Y')}}
                @endif --}}
                {{$doanvien_thanhnien->NGAYCHUYENSH_SV}}
              </td>
              @if(Session::get('session_vt') == 2) 
              <td>
                <div  class="btn-group">
                  <a href="{{ route('doanvien_thanhnien.edit',['doanvien_thanhnien'=>$doanvien_thanhnien->ID])}}">
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
      </form>
    </div>
  </div>
</div>
<!-- /.box-body -->

@endsection