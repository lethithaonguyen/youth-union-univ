@extends('layout.app')

@section('head_content')
CẬP NHẬT HÌNH THỨC KHEN THƯỞNG KỶ LUẬT

@endsection
@section('link_content')
<h1>
  QUẢN LÝ HÌNH THỨC KHEN THƯỞNG KỶ LUẬT
  <small>                
    <a href="" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách hình thức khen thưởng kỷ luật</li>
  <li class="active">Cập nhật hình thức khen thưởng kỷ luật</li>
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
  <form role="form" method="post" action="{{route('hinhthuc_ktkl.update',['hinhthuc_ktkl'=>$hinhthuc_ktkl->ID])}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field("PATCH") }}
    <div class="box-body">

      <div class="form-group">
        <label for="tenhinhthuc_ktkl">Tên hình thức khen thưởng kỷ luật</label>
        <input class="form-control" id="tenhinhthuc_ktkl" name="tenhinhthuc_ktkl" placeholder="Nhập tên hình thức khen thưởng kỷ luật" type="text" value="{{$hinhthuc_ktkl->TEN_HT}}" required>
      </div>

    </div>
    <!-- /.card-body -->

    <div class="box-footer">
      <button  class="btn btn-success"><a href="{{ route('hinhthuc_ktkl.index') }}" style="color: white;"> Trở về </a></button>
      <button type="submit" class="btn btn-primary"> Cập nhật </button>
    </div>
  </form>
</div>


@endsection