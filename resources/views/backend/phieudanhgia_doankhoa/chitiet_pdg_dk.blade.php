@extends('layout.app')

@section('head_content')
CHI TIẾT PHIẾU ĐÁNH GIÁ ĐOÀN KHOA 

@endsection
@section('link_content')
<h1>
 THÊM CHI TIẾT PHIẾU ĐÁNH GIÁ ĐOÀN KHOA: <b>{{ Session::get('session_ten_doankhoa') }}</b>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> home</a></li>
  <li class="active"> Quản lý phiếu đánh giá chi đoàn</li>
  <li class="active">Thêm chi tiết phiếu đánh giá chi đoàn </li>
</ol>
@endsection

@section('content')

<div class="box box-primary">
  <form method="post" action="{{route('chitiet_pdg_dk.store',$pdg_dk->ID)}}" >
    {!! csrf_field() !!}
    <div class="box-body">
      <div class="form-group">
        <label for="namhoc">Năm học</label>
        <input type="text" class="form-control" id="namhoc" value="{{$pdg_dk->TEN_NH}}" disabled>
      </div>
      <div class="form-group">
        <label for="chidoan">Tên đoàn khoa</label>
        <input type="text" class="form-control" id="chidoan" value="{{$pdg_dk->TEN_DK}}" disabled>
      </div>

      <!-- /.col-lg-6 -->
      <div class="form-group">
        <label for="xeploai">Đoàn khoa tự xếp loại</label>
        <input type="text" class="form-control" id="xeploai" value="{{$pdg_dk->TEN_XLDK}}" disabled>
      </div>
      <br><br><br>
      <table id="" class="table table-striped table-bordered table-hover">
        <thead>
          <th>Stt</th>
          <th>Tên nội dung</th>
         {{--  <th>Nội dung</th> --}}
          <th>Đã thực hiện</th>

        </thead>
        <tbody>
          <?php// dd($ct_mp)?>
          @foreach($ct_mp as $chitiet_mauphieu)

          <tr >

            <td>{{$chitiet_mauphieu->THUTU_NOIDUNG}}</td>
            <td id="c1" headers="blank" title="{{$chitiet_mauphieu->NOIDUNG_PDG}}">         
              {{$chitiet_mauphieu->TEN_NDPDG}}          
            </td>
       {{--      <td id="c1" headers="blank">         
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