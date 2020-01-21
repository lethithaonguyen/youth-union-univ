@extends('layout.app')

@section('head_content')
CẬP NHẬT XẾP LOẠI CHI ĐOÀN

@endsection
@section('link_content')
<h1>
  QUẢN LÝ XẾP LOẠI CHI ĐOÀN
  <small>                
    <a href="" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách xếp loại chi đoàn</li>
  <li class="active">Cập nhật xếp loại chi đoàn</li>
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
  <form role="form" method="post" action="{{route('xeploai_cd.update',['xeploai_cd'=>$xeploai_cd->ID])}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field("PATCH") }}
    <div class="box-body">

      <div class="form-group">
        <label for="tenxeploai_cd">Tên xếp loại chi đoàn</label>
        <input class="form-control" id="tenxeploai_cd" name="tenxeploai_cd" placeholder="Nhập tên xếp loại chi đoàn" type="text" value="{{$xeploai_cd->TEN_XLCD}}" required>
        
        <label for="diemdat_cd">Điểm đạt chi đoàn</label>
        <input class="form-control" id="diemdat_cd" name="diemdat_cd" placeholder="Nhập điểm đạt chi đoàn" type="text" value="{{$xeploai_cd->DIEMDAT_CD}}" >
      </div>

    </div>
    <!-- /.card-body -->

    <div class="box-footer">
      <button  class="btn btn-success"><a href="{{ route('xeploai_cd.index') }}" style="color: white;"> Trở về </a></button>
      <button type="submit" class="btn btn-primary"> Cập nhật </button>
    </div>
  </form>
</div>


@endsection