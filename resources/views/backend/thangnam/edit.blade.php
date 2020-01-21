@extends('layout.app')

@section('head_content')
CẬP NHẬT THÁNG NĂM

@endsection
@section('link_content')
<h1>
  QUẢN LÝ THÁNG NĂM
  <small>                
    <a href="{{route('thangnam.create')}}" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách tháng năm</li>
  <li class="active">Cập nhật tháng năm</li>
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
  <form role="form" method="post" action="{{route('thangnam.update',['thangnam'=>$tn->ID])}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field("PATCH") }}
    <div class="box-body">

     <div class="form-group">
      <label for="namhoc">Năm học</label>
      <div class="col-3">
        <select class="form-control" id="namhoc" name="namhoc">
         <option value="">--Chọn Năm Học--</option>
         @foreach($nh as $namhoc)
         <option value="{{ $namhoc->ID }}" <?php echo ($namhoc->ID == $tn->NAMHOC_ID) ? 'selected' : '' ?>>{{ $namhoc->TEN_NH }}</option>
         @endforeach
       </select>
     </div>
   </div>
   <div class="form-group">
    <label for="tenthangnam">Tên tháng năm</label>
    <input class="form-control" id="tenthangnam" name="tenthangnam" placeholder="Nhập tên tháng năm" type="text" value="{{$tn->THANGNAM}}"  required>
  </div>

  <div class="form-group">
    <label for="tenthangnam">Số tiền đoàn phí</label>
    <input class="form-control" id="sotiendoanphi" name="sotiendoanphi" placeholder="Nhập số tiền đoàn phí" type="text" value="{{$tn->SOTIEN_DOANPHI}}"  required>
  </div>

  <!-- /.card-body -->

  <div class="box-footer">
    <button  class="btn btn-success"><a href="{{ route('thangnam.index') }}" style="color: white;"> Trở về </a></button>
    <button type="submit" class="btn btn-primary"> Cập nhật </button>
  </div>
</form>
</div>


@endsection