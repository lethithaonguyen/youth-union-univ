@extends('layout.app')

@section('head_content')
THÔNG TIN CÁ NHÂN <b>{{Session::get('session_ten_sv')}}</b>

@endsection
@section('link_content')
<h1>
  QUẢN LÝ THÔNG TIN CÁ NHÂN
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Thông tin cá nhân</li>
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
      <form action="" method="POST" id="xoanhieuForm">
        {!! csrf_field() !!}

        <table class="table table-bordered table-striped dataTable" id="example1" role="grid" aria-describedby="example1_info">
          @foreach($dv_tn as $doanvien_thanhnien)
          <tr><th colspan="4" style="text-align: center;">Thông tin sinh viên</th></tr>
          <tr><th colspan="4" style="background-color: teal;color: white; font-weight: bold;" >Lý lịch</th></tr>
          
          <tr role="row">
            <th>Mã số sinh viên</th>
            <td>{{$doanvien_thanhnien->MSSV}}</td>
            <th>Họ và tên</th>
            <td>{{$doanvien_thanhnien->TEN_SV}}</td>
          </tr> 
          <tr>
            <th>Phái</th>
            <td>
              @if ($doanvien_thanhnien->PHAI_SV == 1)
              Nam
              @else
              Nữ
              @endif
            </td>
            <th>Ngày sinh</th>
            <td>@if($doanvien_thanhnien->NGAYSINH_SV == Null)
              {{$doanvien_thanhnien->NGAYSINH_SV}}
              @else
              {{\Carbon\Carbon::parse($doanvien_thanhnien->NGAYSINH_SV)->format('d/m/Y')}}
              @endif
            </td>
          </tr>
          <tr>
            <th>Tôn giáo</th>
            <td>{{$doanvien_thanhnien->TEN_TG}}</td>
            <th>Dân tộc</th>
            <td>{{$doanvien_thanhnien->TEN_DT}}</td>
          </tr>
          <tr>
            <th>Nơi sinh</th>
            <td>{{$doanvien_thanhnien->ns_phuong}}-{{$doanvien_thanhnien->ns_quan}}-{{$doanvien_thanhnien->ns_tp}}</td>
            <th>Quê quán</th>
            <td>{{$doanvien_thanhnien->qq_phuong}}-{{$doanvien_thanhnien->qq_quan}}-{{$doanvien_thanhnien->qq_tp}}</td>
          </tr>  
          <tr>
            <th>Chi đoàn</th>
            <td>{{$doanvien_thanhnien->TEN_CD}}</td>
            <th>Khóa</th>
            <td>{{$doanvien_thanhnien->TEN_KHOA}}</td>
          </tr>  
          <tr>
            <th>Đoàn khoa</th>
            <td>{{$doanvien_thanhnien->TEN_DK}}</td>
            <th>Ngày vào đoàn</th>
            <td>
              @if($doanvien_thanhnien->NGAYVAODOAN_SV == Null)
              {{$doanvien_thanhnien->NGAYVAODOAN_SV}}
              @else
              {{\Carbon\Carbon::parse($doanvien_thanhnien->NGAYVAODOAN_SV)->format('d/m/Y')}}
              @endif
            </td>
          </tr>
          <tr>
            <th>Nơi vào đoàn</th>
            <td>{{$doanvien_thanhnien->NOIVAODOAN_SV}}</td>
            <th>Ngày chuyển sinh hoạt đoàn</th>
            <td></td>
          </tr>    
          <tr><th colspan="4" style="background-color: teal;color: white; font-weight: bold;" >Liên lạc</th></tr>
          <tr>
            <th>Địa chỉ liên lạc</th>
            <td>{{$doanvien_thanhnien->DIACHI_SV}}</td>
            <th>Số điện thoại</th>
            <td>{{$doanvien_thanhnien->SDT_SV}}</td>
          </tr>
          <tr>
            <th colspan="2">Email</th>
            <td colspan="2">{{$doanvien_thanhnien->EMAIL_SV}}</td>
          </tr>  
          @endforeach
        </table>
        <button type="button" class="btn btn-danger" name="bulk-delete" id="bulk-delete" style="display:none">Xóa mục chọn</button>
      </form></div></div>
    </div>
    <!-- /.box-body -->

    @endsection