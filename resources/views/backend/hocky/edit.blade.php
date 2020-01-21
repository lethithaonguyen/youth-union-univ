@extends('layout.app')

@section('head_content')
CẬP NHẬT HỌC KỲ

@endsection
@section('link_content')
<h1>
  QUẢN LÝ HỌC KỲ
  <small>                
    <a href="{{route('hocky.create')}}" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách học kỳ</li>
  <li class="active">Cập nhật học kỳ</li>
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
  <form role="form" method="post" action="{{route('hocky.update',['hocky'=>$hocky->ID])}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field("PATCH") }}
    <div class="box-body">

   <div class="form-group">
    <label for="tennamhoc">Tên năm học</label>
    <div class="col-3">
      <select class="form-control" id="tennamhoc" name="tennamhoc">
       <option value="">--Chọn Tên năm học-</option>
       @foreach($nh as $namhoc)
       <option value="{{ $namhoc->ID }}" <?php echo ($namhoc->ID == $hocky->NAMHOC_ID) ? 'selected' : '' ?>>{{ $namhoc->TEN_NH }}</option>
       @endforeach
     </select>
   </div>
 </div>

 <div class="form-group">
  <label for="tenhocky">Tên học kỳ</label>
  <input class="form-control" id="tenhocky" name="tenhocky" placeholder="Nhập tên học kỳ" type="text" value="{{$hocky->TEN_HK}}"  required>
</div>

</div>
<!-- /.card-body -->

<div class="box-footer">
  <button  class="btn btn-success"><a href="{{ route('hocky.index') }}" style="color: white;"> Trở về </a></button>
  <button type="submit" class="btn btn-primary"> Cập nhật </button>
</div>
</form>
</div>


@endsection