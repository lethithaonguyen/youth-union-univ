@extends('layout.app')

@section('head_content')
CẬP NHẬT KHEN THƯỞNG KỶ LUẬT

@endsection
@section('link_content')
<h1>
  QUẢN LÝ KHEN THƯỞNG KỶ LUẬT
  <small>                
    <a href="{{route('khenthuong_kyluat.create')}}" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách khen thưởng  kỷ luật</li>
  <li class="active">Cập nhật khen thưởng  kỷ luật</li>
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
  <form role="form" method="post" action="{{route('khenthuong_kyluat.update',['khenthuong_kyluat'=>$khenthuong_kyluat->ID])}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field("PATCH") }}
    <div class="box-body">

     <div class="form-group">
      <label for="tenloai_ktkl">Tên loại khen thưởng  kỷ luật</label>
      <div class="col-3">
        <select class="form-control" id="tenloai_ktkl" name="tenloai_ktkl">
         <option value="">--Chọn loại khen thưởng  kỷ luật-</option>
         @foreach($lktkl as $loai_ktkl)
         <option value="{{ $loai_ktkl->ID }}" <?php echo ($loai_ktkl->ID == $khenthuong_kyluat->LOAI_KTKL_ID) ? 'selected' : '' ?>>{{ $loai_ktkl->TEN_LOAIKTKL }}</option>
         @endforeach
       </select>
     </div>
   </div>

   <div class="form-group">
    <label for="tenhinhthuc_ktkl">Tên hình thức khen thưởng  kỷ luật</label>
    <div class="col-3">
      <select class="form-control" id="tenhinhthuc_ktkl" name="tenhinhthuc_ktkl">
       <option value="">--Chọn Tên hình thức khen thưởng  kỷ luật-</option>
       @foreach($ht_ktkl as $hinhthuc_ktkl)
       <option value="{{ $hinhthuc_ktkl->ID }}" <?php echo ($hinhthuc_ktkl->ID == $khenthuong_kyluat->HINHTHUC_KTKL_ID) ? 'selected' : '' ?>>{{ $hinhthuc_ktkl->TEN_HT }}</option>
       @endforeach
     </select>
   </div>
 </div>

      <div class="form-group">
      <label for="tendoanvien_thanhnien">Tên đoàn viên lập</label>
      <div class="col-3">
        <select class="form-control" id="tendoanvien_thanhnien" name="tendoanvien_thanhnien">
         <option value="">--Chọn đoàn viên lập--</option>
         @foreach($dv_tn as $doanvien_thanhnien)
         <option value="{{ $doanvien_thanhnien->ID }}" <?php echo ($doanvien_thanhnien->ID == $khenthuong_kyluat->DOANVIEN_THANHNIEN_ID) ? 'selected' : '' ?>>{{ $doanvien_thanhnien->TEN_SV }}</option>
         @endforeach
       </select>
     </div>
   </div>

 <div class="form-group">
  <label for="tenkhenthuong_kyluat">Tên khen thưởng  kỷ luật</label>
  <input class="form-control" id="tenkhenthuong_kyluat" name="tenkhenthuong_kyluat" placeholder="Nhập tên khen thưởng  kỷ luật" type="text" value="{{$khenthuong_kyluat->TEN_KTKL}}"  required>
</div>

</div>
<!-- /.card-body -->

<div class="box-footer">
  <button  class="btn btn-success"><a href="{{ route('khenthuong_kyluat.index') }}" style="color: white;"> Trở về </a></button>
  <button type="submit" class="btn btn-primary"> Cập nhật </button>
</div>
</form>
</div>


@endsection