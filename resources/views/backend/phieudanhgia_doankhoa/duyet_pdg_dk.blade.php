@extends('layout.app')

@section('head_content')
PHIẾU ĐÁNH GIÁ ĐOÀN KHOA
{{ Session::get('pdg_dk') }}
@endsection
@section('link_content')
<h1>
  DUYỆT PHIẾU ĐÁNH GIÁ ĐOÀN KHOA 
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách phiếu đánh giá đoàn khoa</li>
  <li class="active">Duyệt phiếu đoàn khoa</li>
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
      @foreach($pdg_dk as $phieudanhgia_doankhoa)
      <label for="namhoc">Năm học</label>
      <input type="text" class="form-control" id="namhoc" value="{{$phieudanhgia_doankhoa->TEN_NH}}" disabled>
    </div>
    <div class="form-group">
      <label for="doankhoa">Tên đoàn khoa</label>
      <input type="text" class="form-control" id="doankhoa" value="{{$phieudanhgia_doankhoa->TEN_DK}}" disabled>
    </div>
    <!-- /.col-lg-6 -->
    <div class="form-group">
      <label for="xeploai">Đoàn khoa tự xếp loại</label>
      <input type="text" class="form-control" id="xeploai" value="{{$phieudanhgia_doankhoa->TEN_XLDK}}" disabled>
    </div>
    <form role="form" method="POST" action="{{ route('update_duyet_pdg_dk') }}" enctype="multipart/form-data" >
      <div class="form-group">
        <label for="cb_xeploai">Cán bộ xếp loại</label>
        <div class="col-3">
          <select class="form-control" id="cb_xeploai" name="cb_xeploai" required>
            <option value="">--Chọn xếp loại--</option>
            @foreach($xl_dk as $xeploai_dk)
            <option value="{{$xeploai_dk->ID}}">{{$xeploai_dk->TEN_XLDK}}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group">
        <label for="nguoiduyet">Cán bộ duyệt</label>
        <div class="col-3">
          <select class="form-control" id="nguoiduyet" name="nguoiduyet" required>
           <option value="">--Chọn tên cán bộ--</option>
           @foreach($nd as $nguoiduyet)
           <option value="{{$nguoiduyet->ID}}">{{$nguoiduyet->TEN_SV}}</option>
           @endforeach
         </select>
       </div>
     </div>

     @endforeach
     <input type="hidden" name="id" value="{{  Request()->id }}">
     <!-- /.col-lg-6 -->
     <br><br><br>

     {{ csrf_field() }}
     <table id="example1" class="table table-striped table-bordered table-hover">
      <thead>
        {{--       <th>ID</th> --}}
        <th style="text-align: center;">Stt</th>
        <th style="text-align: center;">Id</th>
        <th style="text-align: center;">Tên nội dung</th>
       {{--  <th style="text-align: center;">Nội dung</th> --}}
        <th style="text-align: center;">Trạng thái duyệt</th>
        <th style="text-align: center;">Duyệt</th>
        <th style="text-align: center;">Ghi chú</th>




      </thead>
      <?php
      $stt=1;
      ?>
      <tbody>
        @foreach($ct_pdg_dk as $chitiet_pdg_dk)

        <tr >
          <td>{{$stt++}}</td>
          <td>{{$chitiet_pdg_dk->ID}}</td>
          <td title="{{$chitiet_pdg_dk->NOIDUNG_PDG}} ">
            {{$chitiet_pdg_dk->TEN_NDPDG}}
          </td>
          {{-- <td id="c1" headers="blank">         
            {{$chitiet_pdg_dk->NOIDUNG_PDG}}          
          </td> --}}
          <input type="hidden" name="duyet_pdgdk[]" value="{{$chitiet_pdg_dk->ID}}">

          @if($chitiet_pdg_dk->DUYET_PDG_DK == NULL)
          <td style="text-align: center;"><span class="label label-warning">Chưa duyệt</span></td>

          @elseif($chitiet_pdg_dk->DUYET_PDG_DK == 1)
          <td style="text-align: center;"><span class="label label-success">Đã duyệt</span></td>
          @else
          <td style="text-align: center;"><span class="label label-danger">Không duyệt</span></td>

          @endif

          <td style="text-align: center;">
           <div class="form-group">
            <div class="col-3">
              <select class="form-control" class="duyet" name="duyet[]" required>
                <option value="">Chưa duyệt</option>
                <option value="1">Đã duyệt</option>
                <option value="2">Không duyệt</option>
              </select>
            </div>
          </div>
        </td>
        <td align="center"><input type="text" class="ghichu" name="ghichu[]" value="{{$chitiet_pdg_dk->GHICHU_PDGDK}}"></td>
      </tr>

    </tbody>
    @endforeach
  </table>

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
