@extends('layout.app')

@section('head_content')
CHI TIẾT PHIẾU ĐÁNH GIÁ ĐOÀN VIÊN <b>{{ Session::get('session_ten_sv') }} ({{ Session::get('session_mssv_sv') }})</b>

@endsection
@section('link_content')
<h1>
 THÊM CHI TIẾT PHIẾU ĐÁNH GIÁ ĐOÀN VIÊN <b>{{ Session::get('session_ten_sv') }} ({{ Session::get('session_mssv_sv') }})</b>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active"> Quản lý phiếu đánh giá đoàn viên</li>
  <li class="active">Thêm chi tiết phiếu đánh giá đoàn viên </li>
</ol>
@endsection

@section('content')

@if(Session::has('success_message'))
<div class="alert alert-success"id="success-alert">
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

<div class="box box-primary">
  <form method="post" action="{{route('chitiet_pdg_dv.store',$pdg_dv->ID)}}" >
    {!! csrf_field() !!}
    <div class="box-body">
      <div class="form-group">
        <label for="namhoc">Năm học</label>
        <input type="text" class="form-control" id="namhoc" value="{{$pdg_dv->TEN_NH}}" disabled>
      </div>
      <div class="form-group">
        <label for="hoten">Họ tên</label>
        <input type="text" class="form-control" id="hoten" value="{{$pdg_dv->TEN_SV}}" disabled>
      </div>
      <table id="example1" class="table table-striped table-bordered table-hover">
        <div class="col-lg-6">
          <div class="input-group">
            <span class="input-group-addon">
              <label for="dtb1">Điểm trung bình học kỳ 1</label>
            </span>
            <input type="text" class="form-control" id="dtb1" value="{{$pdg_dv->DIEMTRUNGBINH_HK1}}" disabled>
          </div>
          <!-- /input-group -->
        </div>
        <!-- /.col-lg-6 -->
        <div class="col-lg-6">
          <div class="input-group">
            <span class="input-group-addon">
              <label for="dtb2">Điểm trung bình học kỳ 2</label>
            </span>
            <input type="text" class="form-control" id="dtb2" value="{{$pdg_dv->DIEMTRUNGBINH_HK2}}" disabled>
          </div>
          <!-- /input-group -->
        </div>
        <!-- /.col-lg-6 -->
        <br><br>
        <div class="col-lg-6">
          <div class="input-group">
            <span class="input-group-addon">
              <label for="drl1">Điểm rèn luyện học kỳ 1</label>
            </span>
            <input type="text" class="form-control" id="drl1" value="{{$pdg_dv->DIEMRENLUYEN_HK1}}" disabled>
          </div>
          <!-- /input-group -->
        </div>
        <!-- /.col-lg-6 -->
        <div class="col-lg-6">
          <div class="input-group">
            <span class="input-group-addon">
              <label for="drl2">Điểm rèn luyện học kỳ 2</label>
            </span>
            <input type="text" class="form-control" id="drl2" value="{{$pdg_dv->DIEMRENLUYEN_HK2}}" disabled>
          </div>
          <!-- /input-group -->
        </div>
        <!-- /.col-lg-6 -->
        <div class="form-group">
          <label for="xeploai">Đoàn viên tự xếp loại</label>
          <input type="text" class="form-control" id="xeploai" value="{{$pdg_dv->TEN_XLDV}}" disabled>
        </div>
        <br>

        <thead>
          <th>Stt</th>
          <th>Nội dung</th>
          <th>Thành tích</th>
        {{--   <th>Chọn nội dung lưu</th> --}}



        </thead>
        <tbody>
          <?php// dd($ct_mp)?>
          @foreach($ct_mp as $chitiet_mauphieu)

          <tr >

            <td>{{$chitiet_mauphieu->THUTU_NOIDUNG}}</td>
            <td id="c1" headers="blank">         
              {{$chitiet_mauphieu->TEN_NDPDG}}          
            </td>

            <td ><input type="{{$chitiet_mauphieu->TEN_KIEU_DULIEU}}" class ="noidung" name="noidung"></td>

            <input type="hidden" name="chitiet_mauphieu[]" value="{{$chitiet_mauphieu->NOIDUNG_PDG_ID}}">

          </tr>
          @endforeach
        </tbody>
      </table>
      <br>
      <div class="form-group">
        <div class="col-md-offset-5 col-md-6">
          <input class="btn btn-primary" type="submit" value="Lưu lại">
        </div>
      </div>
    </div>
  </form>
</div>


@endsection