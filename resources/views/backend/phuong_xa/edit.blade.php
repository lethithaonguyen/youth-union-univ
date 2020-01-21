@extends('layout.app')

@section('head_content')
CẬP NHẬT PHƯỜNG-XÃ

@endsection
@section('link_content')
<h1>
  QUẢN LÝ PHƯỜNG-XÃ
  <small>                
    <a href="" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách phường-xã</li>
  <li class="active">Cập nhật phường-xã</li>
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
  <form role="form" method="post" action="{{route('phuong_xa.update',['phuong_xa'=>$p_x->ID])}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field("PATCH") }}
    <div class="box-body">

     <div class="form-group">
      <label for="tenquanhuyen">Tên quận-huyện</label>
      <div class="col-3">
        <select class="form-control" id="tenquanhuyen" name="tenquanhuyen">
         <option value="">--Chọn Quận-Huyện-</option>
         @foreach($q_h as $quan_huyen)
         <option value="{{ $quan_huyen->ID }}" <?php echo ($quan_huyen->ID == $p_x->QUAN_HUYEN_ID) ? 'selected' : '' ?>>{{ $quan_huyen->TEN_QH }}</option>
         @endforeach
       </select>
     </div>
   </div>


 <div class="form-group">
  <label for="tenphuongxa">Tên phường-xã</label>
  <input class="form-control" id="tenphuongxa" name="tenphuongxa" placeholder="Nhập tên phường-xã" type="text" value="{{$p_x->TEN_PX}}"  required>
</div>

<!-- /.card-body -->

<div class="box-footer">
  <button  class="btn btn-success"><a href="{{ route('phuong_xa.index') }}" style="color: white;"> Trở về </a></button>
  <button type="submit" class="btn btn-primary"> Cập nhật </button>
</div>
</form>
</div>


@endsection