@extends('layout.app')

@section('head_content')
CẬP NHẬT PHIẾU BẦU ƯU TÚ

@endsection
@section('link_content')
<h1>
  QUẢN LÝ PHIẾU BẦU ƯU TÚ
  <small>                
    <a href="{{route('phieubau_uutu.create')}}" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách phiếu bầu ưu tú</li>
  <li class="active">Cập nhật phiếu bầu ưu tú</li>
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
  <span class="glyphicon glyphicon-remove" ></span>
  {!! session('error_message') !!}

  <button type="button" class="close" data-dismiss="alert" aria-label="close">
    <span aria-hidden="true">&times;</span>
  </button>

</div>
@endif

<div class="box box-primary">
  <form role="form" method="post" action="{{route('phieubau_uutu.update',['phieubau_uutu'=>$phieubau_uutu->ID])}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field("PATCH") }}
    <div class="box-body">

     <div class="form-group">
      <label for="tenchidoan">Tên chi đoàn</label>
      <div class="col-3">
        <select class="form-control" id="tenchidoan" name="tenchidoan">
          <option value="">--Chọn Tên chi đoàn-</option>
          @foreach($cd as $chidoan)
          <option value="{{ $chidoan->ID }}" <?php echo ($chidoan->ID == $phieubau_uutu->CHIDOAN_ID) ? 'selected' : '' ?>>{{ $chidoan->TEN_CD }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="tendoanvien_thanhnien">Tên đoàn viên</label>
      <div class="col-3">
        <select class="form-control" id="tendoanvien_thanhnien" name="tendoanvien_thanhnien">
         <option value="">--Chọn Tên đoàn viên--</option>
         @foreach($dvtn as $doanvien_thanhnien)
         <option value="{{ $doanvien_thanhnien->ID }}" <?php echo ($doanvien_thanhnien->ID == $phieubau_uutu->DOANVIEN_THANHNIEN_ID) ? 'selected' : '' ?>>{{ $doanvien_thanhnien->TEN_SV }}</option>
         @endforeach
       </select>
     </div>
   </div>

   <div class="form-group">
    <label for="tenphieubau_uutu">Số phiếu bầu ưu tú</label>
    <input class="form-control" id="tenphieubau_uutu" name="tenphieubau_uutu" placeholder="Nhập số phiếu bầu ưu tú" type="text" value="{{$phieubau_uutu->SOPHIEU_TONG}}"  required>
  </div>

  <div class="form-group">
    <label for="tenngay_bau">Ngày bầu ưu tú</label>
    <input class="form-control" id="tenngay_bau" name="tenngay_bau" placeholder="Nhập ngày bầu ưu tú" type="datetime" value="{{$phieubau_uutu->NGAY_BAU}}"  required>
  </div>

</div>
<!-- /.card-body -->

<div class="box-footer">
  <button  class="btn btn-success"><a href="{{ route('phieubau_uutu.index') }}" style="color: white;"> Trở về </a></button>
  <button type="submit" class="btn btn-primary"> Cập nhật </button>
</div>
</form>
</div>


@endsection