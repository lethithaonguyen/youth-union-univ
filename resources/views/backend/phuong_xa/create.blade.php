@extends('layout.app')

@section('head_content')
THÊM MỚI PHƯỜNG-XÃ

@endsection
@section('link_content')
<h1>
  QUẢN LÝ PHƯỜNG-XÃ
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách phường-xã</li>
  <li class="active">Thêm phường-xã</li>
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
  <form role="form" method="POST" action="{{ route('phuong_xa.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="box-body">
      <div class="form-group">
        <label for="tenquanhuyen" class="col-sm-2">Tên quận-huyện</label>
        <div class="col-sm-9">
          <select class="form-control" id="tenquanhuyen" name="tenquanhuyen">
           <option value="">--Chọn Quận-Huyện-</option>
           @foreach($q_h as $quan_huyen)
           <option value="{{$quan_huyen->ID}}">{{$quan_huyen->TEN_QH}}</option>
           @endforeach
         </select>
       </div>
       <div class="col-2">
        <a href="{{route('quan_huyen.index')}}">
          <button type="button" style="background: teal; color: white;"  class="btn active" role="button" >Thêm            
          </button>
        </a>
      </div>
    </div>
    <div class="form-group">
      <label for="tentp" class="col-sm-2">Tên Tinh-Thành phố</label>
      <div class="col-sm-9">
        <select class="form-control" id="tentp" name="tentp">
         <option value="">--Chọn Tỉnh-Thành phố-</option>
         @foreach($tp as $tinh_thanhpho)
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
    <label for="tenphuongxa">Tên phường xã</label>
    <input class="form-control" id="tenphuongxa" name="tenphuongxa" placeholder="Nhập tên phường xã" type="text"  required>
  </div>

</div>
<!-- /.card-body -->

<div class="box-footer">
  <button  class="btn btn-success"><a href="{{ route('phuong_xa.index') }}" style="color: white;"> Trở về </a></button>
  <button type="submit" class="btn btn-primary"> Lưu </button>
</div>
</form>
</div>


@endsection
