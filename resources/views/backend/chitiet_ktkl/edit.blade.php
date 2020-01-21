@extends('layout.app')

@section('head_content')
CẬP NHẬT QUYẾT ĐỊNH KHEN THƯỞNG - KỶ LUẬT

@endsection
@section('link_content')
<h1>
  QUẢN LÝ QUYẾT ĐỊNH KHEN THƯỞNG - KỶ LUẬT
  <small>                
    <a href="" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách quyết định khen thưởng - kỷ luật</li>
  <li class="active">Cập nhật quyết định khen thưởng - kỷ luật</li>
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
  <form role="form" method="post" action="{{route('chitiet_ktkl.update',['chitiet_ktkl'=>$chitiet_ktkl->ID])}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field("PATCH") }}
    <div class="box-body">

     <div class="form-group">
      <label for="tenkhenthuong_kyluat">Tên khen thưởng - kỷ luật</label>
      <div class="col-3">
        <select class="form-control" id="tenkhenthuong_kyluat" name="tenkhenthuong_kyluat">
          <option value="">--Chọn khen thưởng - kỷ luật--</option>
          @foreach($kt_kl as $khenthuong_kyluat)
          <option value="{{ $khenthuong_kyluat->ID }}" <?php echo ($khenthuong_kyluat->ID == $chitiet_ktkl->KHENTHUONG_KYLUAT_ID) ? 'selected' : '' ?>>{{ $khenthuong_kyluat->TEN_KTKL }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="tendoanvien_thanhnien">Tên đoàn viên khen thưởng - kỷ luật</label>
      <div class="col-3">
        <select class="form-control" id="tendoanvien_thanhnien" name="tendoanvien_thanhnien">
         <option value="">--Chọn đoàn viên khen thưởng - kỷ luật-</option>
         @foreach($dv_tn as $doanvien_thanhnien)
         <option value="{{ $doanvien_thanhnien->ID }}" <?php echo ($doanvien_thanhnien->ID == $chitiet_ktkl->DOANVIEN_THANHNIEN_ID) ? 'selected' : '' ?>>{{ $doanvien_thanhnien->TEN_SV }}</option>
         @endforeach
       </select>
     </div>
   </div>

   <div class="form-group">
    <label for="tennoidung">Nội dung khen thưởng kỷ luật</label>
    <input class="form-control" id="tennoidung" name="tennoidung" placeholder="Nhập nội dung khen thưởng kỷ luật" type="text" value="{{$chitiet_ktkl->NOIDUNG_KTKL}}" required>
  </div>

  <div class="form-group">
    <label for="tenngaybatdau">Ngày khen thưởng kỷ luật</label>
    <input class="form-control" id="tenngaybatdau" name="tenngaybatdau" placeholder="Nhập tên dân tộc" type="date" value="{{$chitiet_ktkl->NGAYBATDAU}}" required>
  </div>
</div>
<!-- /.card-body -->

<div class="box-footer">
  <button  class="btn btn-success"><a href="{{ route('chitiet_ktkl.index') }}" style="color: white;"> Trở về </a></button>
  <button type="submit" class="btn btn-primary"> Cập nhật </button>
</div>
</form>
</div>


@endsection