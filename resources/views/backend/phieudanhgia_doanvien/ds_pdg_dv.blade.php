 
@extends('layout.app')

@section('head_content')

DANH SÁCH PHIẾU ĐÁNH GIÁ
@endsection
@section('link_content')
<h1>

 QUẢN LÝ PHIẾU ĐÁNH GIÁ CỦA ĐOÀN VIÊN: {{ Session::get('session_ten_sv') }} ({{ Session::get('session_mssv_sv') }})
  <small>                
    <a href="{{route('phieudanhgia_doanvien.create', Session::get('session_id_sv'))}}" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách phiếu đánh giá đoàn viên </li>
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

<div class="panel panel-default">

  <div class="panel-heading clearfix">

    <div class="pull-left">
      <h4 class="mt-5 mb-5"></h4>
    </div>
  </div>
  <br>

  <div class="panel-body panel-body-with-table">
    <form method="" action="" >
      {!! csrf_field() !!}
      
      <table id="example1" class="table table-striped table-bordered table-hover">

        <thead>
          <th>Stt</th>
          {{-- <th>Id</th> --}}
          <th>Mẫu phiếu đánh giá</th>
          <th>năm học</th>
          <th>Đoàn viên tự xếp loại</th>
          <th>Cán bộ xếp loại</th>
          <th>Trạng thái đánh giá</th>
          <th>Thao tác</th>


        </thead>
        <?php
        $stt=1;
        ?> 
        <tbody>
          @foreach($pdg_dv as $phieudanhgia_doanvien)

          <tr>
            <td>
              {{$stt++}}
            </td>
            {{-- <td>
              {{$phieudanhgia_doanvien->ID}}
            </td> --}}
            <td>
              {{$phieudanhgia_doanvien->TEN_MP}}
            </td>
            <td>         
              {{$phieudanhgia_doanvien->TEN_NH}}          
            </td>
            <td>         
              {{$phieudanhgia_doanvien->TEN_XLDV}}          
            </td>

            @if($phieudanhgia_doanvien->CD_XEPLOAI_DV_ID == "1")
            <td style="text-align: center;"><span class="label label-success">Xuất sắc</span></td>

            @elseif($phieudanhgia_doanvien->CD_XEPLOAI_DV_ID == "2")
            <td style="text-align: center;"><span class="label label-success">Giỏi</span></td>
            @elseif($phieudanhgia_doanvien->CD_XEPLOAI_DV_ID == "3")
            <td style="text-align: center;"><span class="label label-success">Khá</span></td>
            @elseif($phieudanhgia_doanvien->CD_XEPLOAI_DV_ID == "4")
            <td style="text-align: center;"><span class="label label-success">Trung bình</span></td>
            @else
            <td style="text-align: center;"><span class="label label-danger">Chưa xếp loại</span></td>
            @endif
            @if($phieudanhgia_doanvien->TRANGTHAI_DUYET == "1")
            <td style="text-align: center;"><span class="label label-info">Đã đánh giá</span></td>

            @else
            <td style="text-align: center;"><span class="label label-danger">Chưa đánh giá</span></td>
            @endif
            <td>
             <div style="align:center" class="btn-group">
              <a href="{{route('ketqua_duyet_pdg_dv', $phieudanhgia_doanvien->ID)}}">
                 
                <button type="button" style="background: teal; color: white;"  class="btn active" role="button" ><i class="fa fa-eye" aria-hidden="true"></i> Xem kết quả        
                </button>
              
              </a>
            </div>
          </td>

        </tr>
        @endforeach
      </tbody>
    </table>
  </form>
</div>
</div>
</div>
@endsection 