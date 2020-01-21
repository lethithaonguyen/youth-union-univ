@extends('layout.app')

@section('head_content')
CẬP NHẬT XẾP LOẠI ĐOÀN VIÊN

@endsection
@section('link_content')
<h1>
  QUẢN LÝ XẾP LOẠI ĐOÀN VIÊN
  <small>                
    <a href="" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách xếp loại đoàn viên</li>
  <li class="active">Cập nhật xếp loại đoàn viên</li>
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
  <form role="form" method="post" action="{{route('xeploai_dv.update',['xeploai_dv'=>$xeploai_dv->ID])}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field("PATCH") }}
    <div class="box-body">

      <div class="form-group">
        <label for="tenxeploai_dv">Tên xếp loại đoàn viên</label>
        <input class="form-control" id="tenxeploai_dv" name="tenxeploai_dv" placeholder="Nhập tên xếp loại đoàn viên" type="text" value="{{$xeploai_dv->TEN_XLDV}}" required>
        
        <label for="diemdat_dv">Điểm đạt đoàn viên</label>
        <input class="form-control" id="diemdat_dv" name="diemdat_dv" placeholder="Nhập điểm đạt đoàn viên" type="text" value="{{$xeploai_dv->DIEMDAT_DV}}">
      </div>

    </div>
    <!-- /.card-body -->

    <div class="box-footer">
      <button  class="btn btn-success"><a href="{{ route('xeploai_dv.index') }}" style="color: white;"> Trở về </a></button>
      <button type="submit" class="btn btn-primary"> Cập nhật </button>
    </div>
  </form>
</div>


@endsection