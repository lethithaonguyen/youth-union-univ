@extends('layout.app')

@section('head_content')
THÊM MỚI ĐOÀN VIÊN THANH NIÊN

@endsection
@section('link_content')
<h1>
  QUẢN LÝ ĐOÀN VIÊN THANH NIÊN
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách đoàn viên thanh niên</li>
  <li class="active">Thêm đoàn viên thanh niên</li>
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

@if(Session::has('capquyensuccess'))
<div class="alert alert-success" id="success-alert">
  <span class="glyphicon glyphicon-ok"></span>
  {!! session('capquyensuccess') !!}

  <button type="button" class="close" data-dismiss="alert" aria-label="close">
    <span aria-hidden="true">&times;</span>
  </button>

</div>
@endif
@if(Session::has('deletesuccess'))
<div class="alert alert-danger" id="success-alert">
  <span class="glyphicon glyphicon-remove"></span>
  {!! session('deletesuccess') !!}

  <button type="button" class="close" data-dismiss="alert" aria-label="close">
    <span aria-hidden="true">&times;</span>
  </button>

</div>
@endif

<div class="box box-primary">
  <form method="post" action="" >
    {!! csrf_field() !!}
    <div class="box-body">
      <div class="form-group">
        <label for="namhoc">Năm học</label>
        <input type="text" class="form-control" id="namhoc" value="{{$pdg_dv->TEN_NH}}">
      </div>
      <div class="form-group">
        <label for="hoten">Họ tên</label>
        <input type="text" class="form-control" id="hoten" value="{{$pdg_dv->TEN_SV}}">
      </div>
      <div class="form-group">
        <label for="xeploai">Xếp loại</label>
        <input type="text" class="form-control" id="xeploai" value="{{$pdg_dv->TEN_XLDV}}">
      </div>
      <table id="example1" class="table table-striped table-bordered table-hover">
        <div class="col-lg-6">
          <div class="input-group">
            <span class="input-group-addon">
              <label for="dtb1">Điểm trung bình hk1</label>
            </span>
            <input type="text" class="form-control" id="dtb1" value="{{$pdg_dv->DIEMTRUNGBINH_HK1}}">
          </div>
          <!-- /input-group -->
        </div>
        <!-- /.col-lg-6 -->
        <div class="col-lg-6">
          <div class="input-group">
            <span class="input-group-addon">
              <label for="dtb2">Điểm trung bình hk2</label>
            </span>
            <input type="text" class="form-control" id="dtb2" value="{{$pdg_dv->DIEMTRUNGBINH_HK2}}">
          </div>
          <!-- /input-group -->
        </div>
        <!-- /.col-lg-6 -->
        <br><br><br>
        <div class="col-lg-6">
          <div class="input-group">
            <span class="input-group-addon">
              <label for="drl1">Điểm rèn luyện hk1</label>
            </span>
            <input type="text" class="form-control" id="drl1" value="{{$pdg_dv->DIEMRENLUYEN_HK1}}">
          </div>
          <!-- /input-group -->
        </div>
        <!-- /.col-lg-6 -->
        <div class="col-lg-6">
          <div class="input-group">
            <span class="input-group-addon">
              <label for="drl2">Điểm rèn luyện hk2</label>
            </span>
            <input type="text" class="form-control" id="drl2" value="{{$pdg_dv->DIEMRENLUYEN_HK2}}">
          </div>
          <!-- /input-group -->
        </div>
        <!-- /.col-lg-6 -->
        <br><br><br>

        <thead>
          <th>Stt</th>
          <th>Nội dung</th>
          <th>Thành tích</th>
          <th>Duyệt</th>


        </thead>
        <tbody>
          <?php// dd($ct_mp)?>
          @foreach($ct_mp as $chitiet_mauphieu)

          <tr>

            <td>{{$chitiet_mauphieu->THUTU_NOIDUNG}}</td>
            <td id="c1" headers="blank">         
              {{$chitiet_mauphieu->TEN_NDPDG}}          
            </td>
            <td><input type="{{$chitiet_mauphieu->TEN_KIEU_DULIEU}}" name="noidung" class="form-control"></td>
            <td></td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <div class="col-lg-6">
        <div class="input-group">
          <span class="input-group-addon">
            <label for="tu_danhgia">Đoàn viên tự đánh giá </label>
          </span>
          <input type="text" class="form-control" id="tu_danhgia" name="tu_danhgia" value="">
        </div>
        <!-- /input-group -->
      </div>


        <div class="col-lg-6">
          <div class="input-group">
            <span class="input-group-addon">
              <label for="cb_danhgia">Kết quả đánh giá của cán bộ</label>
            </span>
            <input type="text" class="form-control" id="cb_danhgia" name="cb_danhgia" value="">
          </div>
          <!-- /input-group -->
        </div>
        <br> <br>
      <div class="form-group">
        <div class="col-md-offset-6 col-md-6">
          <input class="btn btn-primary" type="submit" value="Lưu lại">
        </div>
      </div>
    </div>
  </form>
</div>


@endsection