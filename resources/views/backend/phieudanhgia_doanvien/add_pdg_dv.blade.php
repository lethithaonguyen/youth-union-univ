 
@extends('layout.app')

@section('head_content')
ĐÁNH GIÁ CỦA ĐOÀN VIÊN: <b>{{ Session::get('session_ten_sv') }} ({{ Session::get('session_mssv_sv') }})</b>

@endsection
@section('link_content')
<h1>
TẠO PHIẾU ĐÁNH GIÁ ĐOÀN VIÊN
{{--   <small>                
    <a href="" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small> --}}
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Tạo phiếu đánh giá đoàn viên </li>
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
       {{--    <th style="text-align: center;">Id</th> --}}
          <th style="text-align: center;">Mssv</th>
          <th style="text-align: center;">Họ Tên </th>
          <th style="text-align: center;">Năm sinh</th>
          <th style="text-align: center;">Khóa</th>
          <th style="text-align: center;">Chi đoàn</th>
          <th style="text-align: center;">Đoàn khoa</th>
          <th></th>
          <th style="text-align: center;">Thao tác</th>


        </thead>
        <?php
        $stt=1;
        ?> 
        <tbody>
          @foreach($dv_tn as $doanvien_thanhnien)

          <tr>
            <td>
              {{$stt++}}
            </td>
         {{--    <td>
              {{$doanvien_thanhnien->ID}}
            </td> --}}
            <td>
              {{$doanvien_thanhnien->MSSV}}
            </td>
            <td>         
              {{$doanvien_thanhnien->TEN_SV}}          
            </td>
            <td>
              {{\Carbon\Carbon::parse($doanvien_thanhnien->NGAYSINH_SV)->format('d/m/Y')}}
            </td>
            <td>
              {{$doanvien_thanhnien->TEN_KHOA}}
            </td>
            <td>
              {{$doanvien_thanhnien->TEN_CD}}
            </td>
            <td>
              {{$doanvien_thanhnien->TEN_DK}}
            </td>
            <td>
              <span  style=" float:center;">(Có
                  <?php
                  $x = $doanvien_thanhnien->ID;
                  // dd($x);
                  $countcd = DB::table('phieudanhgia_doanvien')->where('DOANVIEN_THANHNIEN_ID' ,'=',$x)->where('TRANGTHAI_DUYET','=', null)->count();
                  // dd($countnam);
                  echo "<span style='color:red;;font-weight:bold'>$countcd</span>" ;
                  ?> chưa duyệt và
                  <?php
                  $x = $doanvien_thanhnien->ID;
                  $countdd = DB::table('phieudanhgia_doanvien')->where('DOANVIEN_THANHNIEN_ID' ,'=',$x)->where('TRANGTHAI_DUYET','=', '1')->count();
                  //dd($countnu);
                  echo "<span style='color:red;;font-weight:bold'>$countdd</span>" ;
                  ?>đã duyệt trong tổng gồm
                  <?php
                  $x = $doanvien_thanhnien->ID;
                  $countphieu = DB::table('phieudanhgia_doanvien')->where('DOANVIEN_THANHNIEN_ID' ,'=',$x)->count();

                  echo "<span style='color:red;font-weight:bold'>$countphieu</span>" ;
                  ?> phiếu )</span>
            </td>
            <td>
             <div style="align:center" class="btn-group">
              <a href="{{route('ds_pdg_dv')}}">
                <button type="button"  class="btn btn-success active" role="button" >Đánh giá <span class=" glyphicon glyphicon-pencil"></span>            
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