@extends('layout.app')

@section('head_content')
CẬP NHẬT CHỨC VỤ ĐOÀN VIÊN

@endsection
@section('link_content')
<h1>
  QUẢN LÝ CHỨC VỤ ĐOÀN VIÊN
  <small>                
    <a href="{{route('chucvu_dv.create')}}" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách chức vụ đoàn viên</li>
  <li class="active">Cập nhật chức vụ đoàn viên</li>
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
  <form role="form" method="post" action="{{route('chucvu_dv.update',['chucvu_dv'=>$chucvu_dv->ID])}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field("PATCH") }}
    <div class="box-body">

      <div class="form-group">
        <label for="tenchucvu_dv">Tên chức vụ đoàn viên</label>
        <input class="form-control" id="tenchucvu_dv" name="tenchucvu_dv" placeholder="Nhập tên chức vụ đoàn viên" type="text" value="{{$chucvu_dv->TEN_CHUCVU}}" >
      </div>

    </div>
    <!-- /.card-body -->

    <div class="box-footer">
      <button  class="btn btn-success"><a href="{{ route('chucvu_dv.index') }}" style="color: white;"> Trở về </a></button>
      <button type="submit" class="btn btn-primary"> Cập nhật </button>
    </div>
  </form>
</div>


@endsection