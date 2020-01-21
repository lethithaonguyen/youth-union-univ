@extends('layout.app')

@section('head_content')
THÊM MỚI QUẬN-HUYỆN

@endsection
@section('link_content')
<h1>
  QUẢN LÝ QUẬN-HUYỆN
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách quận-huyện</li>
  <li class="active">Thêm quận-huyện</li>
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

<div class="box box-primary">
  <form role="form" method="POST" action="{{ route('quan_huyen.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="box-body">

      <div class="form-group">
        <label for="tentinhthanhpho" class="col-sm-2">Tên tỉnh-thành phố</label>
        <div class="col-sm-9">
          <select class="form-control" id="tentinhthanhpho" name="tentinhthanhpho">
           <option value="">--Chọn Tỉnh-Thành Phố-</option>
           @foreach($t_tp ?? '' as $tinh_thanhpho)
           <option value="{{$tinh_thanhpho->ID}}">{{$tinh_thanhpho->TEN_TP}}</option>
           @endforeach
         </select>
       </div>
              <div class="col-2">
        <a href="{{route('tinh_thanhpho.index')}}">
          <button type="button" style="background: teal; color: white;"  class="btn active" role="button" >Thêm            
          </button>
        </a>
      </div>
     </div>

   <div class="form-group">
    <label for="tenquanhuyen">Tên quận huyện</label>
    <input class="form-control" id="tenquanhuyen" name="tenquanhuyen" placeholder="Nhập tên quận huyện" type="text"  required>
  </div>

</div>
<!-- /.card-body -->

<div class="box-footer">
  <button  class="btn btn-success"><a href="{{ route('quan_huyen.index') }}" style="color: white;"> Trở về </a></button>
  <button type="submit" class="btn btn-primary"> Lưu </button>
</div>
</form>
</div>


@endsection