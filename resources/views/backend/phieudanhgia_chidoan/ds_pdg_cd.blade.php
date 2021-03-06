 
@extends('layout.app')

@section('head_content')

DANH SÁCH PHIẾU ĐÁNH GIÁ
@endsection
@section('link_content')
<h1>

 QUẢN LÝ PHIẾU ĐÁNH GIÁ CỦA CHI ĐOÀN: {{ Session::get('session_ten_chidoan_sv') }}-{{ Session::get('session_ten_khoa_sv') }}
  <small>                
    <a href="{{route('phieudanhgia_chidoan.create', Session::get('session_id_chidoan_sv'))}}" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách phiếu đánh giá chi đoàn </li>
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
          <th style="text-align: center;">Stt</th>
{{--           <th style="text-align: center;">Id</th> --}}
          <th style="text-align: center;">Mẫu phiếu đánh giá</th>
          <th style="text-align: center;">năm học</th>
          <th style="text-align: center;">Chi đoàn tự xếp loại</th>
          <th style="text-align: center;">Cán bộ xếp loại</th>
          <th style="text-align: center;">Trạng thái đánh giá</th>
          <th style="text-align: center;">Thao tác</th>


        </thead>
        <?php
        $stt=1;
        ?> 
        <tbody>
          @foreach($pdg_cd as $phieudanhgia_chidoan)

          <tr>
            <td>
              {{$stt++}}
            </td>
{{--             <td>
              {{$phieudanhgia_chidoan->ID}}
            </td> --}}
            <td>
              {{$phieudanhgia_chidoan->TEN_MP}}
            </td>
            <td>         
              {{$phieudanhgia_chidoan->TEN_NH}}          
            </td>
            <td>         
              {{$phieudanhgia_chidoan->TEN_XLCD}}          
            </td>

            @if($phieudanhgia_chidoan->CB_XEPLOAI_CD_ID == "1")
            <td style="text-align: center;"><span class="label label-success">Vững mạnh</span></td>

            @elseif($phieudanhgia_chidoan->CB_XEPLOAI_CD_ID == "2")
            <td style="text-align: center;"><span class="label label-success">Khá</span></td>
            @elseif($phieudanhgia_chidoan->CB_XEPLOAI_CD_ID == "3")
            <td style="text-align: center;"><span class="label label-success">Trung bình</span></td>
            @elseif($phieudanhgia_chidoan->CB_XEPLOAI_CD_ID == "4")
            <td style="text-align: center;"><span class="label label-success">Yếu - kém</span></td>
            @else
            <td style="text-align: center;"><span class="label label-danger">Chưa xếp loại</span></td>
            @endif
            @if($phieudanhgia_chidoan->TRANGTHAI_DUYET == "1")
            <td style="text-align: center;"><span class="label label-info">Đã đánh giá</span></td>

            @else
            <td style="text-align: center;"><span class="label label-danger">Chưa đánh giá</span></td>
            @endif
            <td>
             <div style="align:center" class="btn-group">
              <a href="{{route('ketqua_duyet_pdg_cd', $phieudanhgia_chidoan->ID)}}">
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