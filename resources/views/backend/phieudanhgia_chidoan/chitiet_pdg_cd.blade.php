@extends('layout.app')

@section('head_content')
chi tiết phiếu đánh giá chi đoàn

@endsection
@section('link_content')
<h1>
 thêm chi tiết phiếu đánh giá chi đoàn : <b>{{ Session::get('session_ten_chidoan_sv') }}-{{ Session::get('session_ten_khoa_sv') }}</b>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> home</a></li>
  <li class="active"> quản lý phiếu đánh giá chi đoàn</li>
  <li class="active">thêm chi tiết phiếu đánh giá chi đoàn </li>
</ol>
@endsection

@section('content')

<div class="box box-primary">
  <form method="post" action="{{route('chitiet_pdg_cd.store',$pdg_cd->ID)}}" >
    {!! csrf_field() !!}
    <div class="box-body">
      <div class="form-group">
        <label for="namhoc">Năm học</label>
        <input type="text" class="form-control" id="namhoc" value="{{$pdg_cd->TEN_NH}}" disabled>
      </div>
      <div class="form-group">
        <label for="hoten">Tên chi đoàn</label>
        <input type="text" class="form-control" id="chidoan" value="{{$pdg_cd->TEN_CD}}-{{ Session::get('session_ten_khoa_sv') }}" disabled>
      </div>

      <!-- /.col-lg-6 -->
      <div class="form-group">
        <label for="xeploai">Đoàn viên tự xếp loại</label>
        <input type="text" class="form-control" id="xeploai" value="{{$pdg_cd->TEN_XLCD}}" disabled>
      </div>
      <br><br><br>
      <table id="" class="table table-striped table-bordered table-hover">
        <thead>
          <th style="text-align: center;">Stt</th>
          <th style="text-align: center;">Tên nội dung</th>
        {{--   <th style="text-align: center;">Nội dung</th> --}}
          <th style="text-align: center;">Đã thực hiện</th>

        </thead>
        <tbody>
          <?php// dd($ct_mp)?>
          @foreach($ct_mp as $chitiet_mauphieu)

          <tr >

            <td>{{$chitiet_mauphieu->THUTU_NOIDUNG}}</td>
            <td id="c1" headers="blank" title="{{$chitiet_mauphieu->NOIDUNG_PDG}}">         
              {{$chitiet_mauphieu->TEN_NDPDG}}          
            </td>
{{--             <td id="c1" headers="blank">         
              {{$chitiet_mauphieu->NOIDUNG_PDG}}          
            </td> --}}

        {{--     <td ><input type="" id="noidung" name="noidung"></td> --}}
            <td><input type="{{$chitiet_mauphieu->TEN_KIEU_DULIEU}}" class="flat-red" name="chitiet_mauphieu[]" value="{{$chitiet_mauphieu->NOIDUNG_PDG_ID}}"></td>

          </tr>
          @endforeach
        </tbody>
      </table>

      <br> <br>
      <div class="form-group">
        <div class="col-md-offset-5 col-md-6">
          <input class="btn btn-primary" type="submit" value="lưu lại">
        </div>
      </div>
    </div>
  </form>
</div>


@endsection