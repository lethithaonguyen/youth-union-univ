@extends('layout.app')

@section('head_content')
CẬP NHẬT THÀNH TÍCH THAM GIA

@endsection
@section('link_content')
<h1>
  QUẢN LÝ THÀNH TÍCH THAM GIA
  <small>                
    <a href="{{route('thanhtich_thamgia.create')}}" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách thành tích tham gia</li>
  <li class="active">Cập nhật thành tích tham gia</li>
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
  <form role="form" method="post" action="{{route('thanhtich_thamgia.update',$thanhtich_thamgia->ID)}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field("PATCH") }}
    <div class="box-body">

     <div class="form-group">
      <label for="tenthanhtich">Tên thành tích</label>
      <div class="col-3">
        <select class="form-control" id="tenthanhtich" name="tenthanhtich">
          <option value="">--Chọn Tên thành tích--</option>
          @foreach($tt as $thanhtich)
          <option value="{{ $thanhtich->ID }}" <?php echo ($thanhtich->ID == $thanhtich_thamgia->THANHTICH_ID) ? 'selected' : '' ?>>{{ $thanhtich->TEN_TT }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="tenpt_doankhoa">Tên phong trào đoàn khoa</label>
      <div class="col-3">
        <select class="form-control" id="tenpt_doankhoa" name="tenpt_doankhoa">
          <option value="">--Chọn Tên phong trào đoàn khoa--</option>
          @foreach($pt_dk as $pt_doankhoa)
          <option value="{{ $pt_doankhoa->ID }}" <?php echo ($pt_doankhoa->ID == $thanhtich_thamgia->PT_DOANKHOA_ID) ? 'selected' : '' ?>>{{ $pt_doankhoa->TEN_PT_DK }}</option>
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
         <option value="{{ $doanvien_thanhnien->ID }}" <?php echo ($doanvien_thanhnien->ID == $thanhtich_thamgia->DOANVIEN_THANHNIEN_ID) ? 'selected' : '' ?>>{{ $doanvien_thanhnien->TEN_SV }}</option>
         @endforeach
       </select>
     </div>
   </div>

   <div class="form-group">
    <label for="tendiengiai">Diễn giải thành tích tham gia</label>
    <input class="form-control" id="tendiengiai" name="tendiengiai" placeholder="Nhập diễn giải thành tích tham gia" type="text" value="{{$thanhtich_thamgia->DIENGIAI}}"  >
  </div>

</div>
<!-- /.card-body -->

<div class="box-footer">
  <button  class="btn btn-success"><a href="{{ route('thanhtich_thamgia.index') }}" style="color: white;"> Trở về </a></button>
  <button type="submit" class="btn btn-primary"> Cập nhật </button>
</div>
</form>
</div>


@endsection