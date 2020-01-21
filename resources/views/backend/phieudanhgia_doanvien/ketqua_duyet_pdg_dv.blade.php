@extends('layout.app')

@section('head_content')
PHIẾU ĐÁNH GIÁ ĐOÀN VIÊN
{{ Session::get('pdg_dv') }}
@endsection
@section('link_content')
<h1>
  KẾT QUẢ PHIẾU ĐÁNH GIÁ ĐOÀN VIÊN
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách phiếu đánh giá đoàn viên</li>
  <li class="active">Xem kết quả phiếu đánh giá đoàn viên</li>
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


<div class="box box-primary">

  {!! csrf_field() !!}
  <div class="box-body">
    <div class="form-group">
      @foreach($pdg_dv as $phieudanhgia_doanvien)
      <label for="namhoc">Năm học</label>
      <input type="text" class="form-control" id="namhoc" value="{{$phieudanhgia_doanvien->TEN_NH}}" disabled>
    </div>

    <div class="form-group">
      <label for="hoten">Họ tên</label>
      <input type="text" class="form-control" id="hoten" value="{{$phieudanhgia_doanvien->TEN_SV}}" disabled>
    </div>

    <div class="col-lg-6">
      <div class="input-group">
        <span class="input-group-addon">
          <label for="dtb1">Điểm trung bình học kỳ 1</label>
        </span>
        <input type="text" class="form-control" id="dtb1" value="{{$phieudanhgia_doanvien->DIEMTRUNGBINH_HK1}}" disabled>
      </div>
      <!-- /input-group -->
    </div>
    <!-- /.col-lg-6 -->
    <div class="col-lg-6">
      <div class="input-group">
        <span class="input-group-addon">
          <label for="dtb2">Điểm trung bình học kỳ 2</label>
        </span>
        <input type="text" class="form-control" id="dtb2" value="{{$phieudanhgia_doanvien->DIEMTRUNGBINH_HK2}}" disabled>
      </div>
      <!-- /input-group -->
    </div>
    <!-- /.col-lg-6 -->
    <br><br><br>
    <div class="col-lg-6">
      <div class="input-group">
        <span class="input-group-addon">
          <label for="drl1">Điểm rèn luyện học kỳ 1</label>
        </span>
        <input type="text" class="form-control" id="drl1" value="{{$phieudanhgia_doanvien->DIEMRENLUYEN_HK1}}" disabled>
      </div>
      <!-- /input-group -->
    </div>
    <!-- /.col-lg-6 -->
    <div class="col-lg-6">
      <div class="input-group">
        <span class="input-group-addon">
          <label for="drl2">Điểm rèn luyện học kỳ 2</label>
        </span>
        <input type="text" class="form-control" id="drl2" value="{{$phieudanhgia_doanvien->DIEMRENLUYEN_HK2}}" disabled>
      </div>
      <!-- /input-group -->
    </div>
    <br><br>
    <div class="form-group">
      <label for="xeploai_dv">Đoàn viên tự đánh giá</label>
      <div class="col-3">
        <select class="form-control" id="xeploai_dv" name="xeploai_dv" disabled>
         <option value="">--Chọn xếp loại--</option>
         @foreach($xl_dv as $xeploai_dv)
         <option value="{{ $xeploai_dv->ID }}" <?php echo ($xeploai_dv->ID == $phieudanhgia_doanvien->XEPLOAI_DV_ID) ? 'selected' : '' ?>>{{ $xeploai_dv->TEN_XLDV }}</option>
         @endforeach
       </select>
     </div>
   </div>

   <div class="form-group">
    <label for="cb_xeploai">Cán bộ đánh giá</label>
    <div class="col-3">
      <select class="form-control" id="cb_xeploai" name="cb_xeploai" disabled>
       <option value="">--Chọn xếp loại--</option>
       @foreach($cd_xl as $cd_xeploai)
       <option value="{{ $cd_xeploai->ID }}" <?php echo ($cd_xeploai->ID == $phieudanhgia_doanvien->CD_XEPLOAI_DV_ID) ? 'selected' : '' ?>>{{ $cd_xeploai->TEN_XLDV }}</option>
       @endforeach
     </select>
   </div>
 </div>
 @endforeach 
 <form role="form" method="POST" action="" enctype="multipart/form-data" >

  <input type="hidden" name="id" value="">
  <!-- /.col-lg-6 -->

  {{ csrf_field() }}
  <table id="example1" class="table table-striped table-bordered table-hover">
    <thead>
      {{--       <th>ID</th> --}}
      <th style="text-align: center;">Stt</th>
      <th style="text-align: center;">Nội dung</th>
      <th style="text-align: center;">Thành tích</th>
      <th style="text-align: center;">Trạng thái duyệt</th>
      <th style="text-align: center;">Ghi chú</th>




    </thead>
    <tbody>
      @foreach($ct_pdg_dv as $chitiet_pdg_dv)

      <tr >
        {{--           <td>{{$chitiet_pdg_dv->ID}}</td> --}}
        <td>{{$chitiet_pdg_dv->THUTU_NOIDUNG}}</td>
        <td id="c1" headers="blank" >         
          {{$chitiet_pdg_dv->TEN_NDPDG}}          
        </td>

        <td>
          <div>
            {{$chitiet_pdg_dv->NOIDUNG_TU_DANHGIA}}
          </div>

        </td>

        <input type="hidden" name="duyet_pdgdv[]" value="{{$chitiet_pdg_dv->ID}}">

        @if($chitiet_pdg_dv->DUYET_PDG_DV == NULL)
        <td style="text-align: center;"><span class="label label-warning">Chưa duyệt</span></td>
        @elseif($chitiet_pdg_dv->DUYET_PDG_DV == 1)
        <td style="text-align: center;"><span class="label label-success">Đã duyệt</span></td>
        @else
        <td style="text-align: center;"><span class="label label-danger">Không duyệt</span></td>

        @endif
        <td>{{$chitiet_pdg_dv->GHICHU_PDGDV}}</td>
      </tr>

    </tbody>
    @endforeach
  </table>
  <br> <br>
{{--   <div class="form-group">
    <div class="col-md-offset-6 col-md-6">
      <input class="btn btn-primary" type="submit" value="Lưu lại">
    </div>
  </div> --}}
</div>
</form>
</div>
@endsection
