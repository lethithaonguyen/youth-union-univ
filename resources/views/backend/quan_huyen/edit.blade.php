@extends('layout.app')

@section('head_content')
CẬP NHẬT QUẬN-HUYỆN

@endsection
@section('link_content')
<h1>
  QUẢN LÝ QUẬN-HUYỆN
  <small>                
    <a href="" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách quận-huyện</li>
  <li class="active">Cập nhật quận-huyện</li>
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
  <form role="form" method="post" action="{{route('quan_huyen.update',['quan_huyen'=>$q_h->ID])}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field("PATCH") }}
    <div class="box-body">

     <div class="form-group">
      <label for="tentinhthanhpho">Tên tỉnh-thành phố</label>
      <div class="col-3">
        <select class="form-control" id="tentinhthanhpho" name="tentinhthanhpho">
         <option value="">--Chọn Tỉnh-Thành Phố-</option>
         @foreach($t_tp as $tinh_thanhpho)
         <option value="{{ $tinh_thanhpho->ID }}" <?php echo ($tinh_thanhpho->ID == $q_h->TINH_THANHPHO_ID) ? 'selected' : '' ?>>{{ $tinh_thanhpho->TEN_TP }}</option>
         @endforeach
       </select>
     </div>
   </div>


 <div class="form-group">
  <label for="tenquanhuyen">Tên quận-huyện</label>
  <input class="form-control" id="tenquanhuyen" name="tenquanhuyen" placeholder="Nhập tên quận-huyện" type="text" value="{{$q_h->TEN_QH}}"  required>
</div>

<!-- /.card-body -->

<div class="box-footer">
  <button  class="btn btn-success"><a href="{{ route('quan_huyen.index') }}" style="color: white;"> Trở về </a></button>
  <button type="submit" class="btn btn-primary"> Cập nhật </button>
</div>
</form>
</div>


@endsection