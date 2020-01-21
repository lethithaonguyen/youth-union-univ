
@extends('layout.app')

@section('head_content')
DANH SÁCH PHIẾU ĐÁNH GIÁ 

@endsection
@section('link_content')
<h1>
  PHIẾU ĐÁNH GIÁ CỦA ĐOÀN KHOA: <b> {{$dk->TEN_DK}} </b>
 ( gồm <?php
$x = $dk->ID;
                  // dd($x);
$countcd = DB::table('phieudanhgia_doankhoa')->where('DOANKHOA_ID' ,'=',$x)->where('TRANGTHAI_DUYET','=', null)->count();
                  // dd($countnam);
echo "<span style='color:red;font-weight:bold'>$countcd</span>" ;
?><span style="color: red;"> chưa duyệt </span>và
<?php
$x = $dk->ID;
$countdd = DB::table('phieudanhgia_doankhoa')->where('DOANKHOA_ID' ,'=',$x)->where('TRANGTHAI_DUYET','=', '1')->count();
                  //dd($countnu);
echo "<span style='color:teal;font-weight: bold;''>$countdd</span>" ;
?> <span style="color:teal">đã duyệt</span> trong tổng
<?php
$x = $dk->ID;
$countphieu = DB::table('phieudanhgia_doankhoa')->where('DOANKHOA_ID' ,'=',$x)->count();

echo "<span style='font-weight:bold'>$countphieu</span>" ;
?> phiếu )
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách phiếu đánh giá </li>
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
  <span class="glyphicon glyphicon-remove"></span>
  {!! session('error_message') !!}

  <button type="button" class="close" data-dismiss="alert" aria-label="close">
    <span aria-hidden="true">&times;</span>
  </button>

</div>
@endif

<div class="panel panel-default">

  <br>
  <div class="panel-body panel-body-with-table">
    <form method="" action="" >
      {!! csrf_field() !!}

      <table id="example1" class="table table-striped table-bordered table-hover" style="text-align: center">

        <thead >
          <th style="text-align: center" >Stt</th>
          {{--   <th style="text-align: center" >Id</th> --}}
          <th style="text-align: center" >Đoàn khoa</th>
          <th style="text-align: center" >Mẫu phiếu</th>
          <th style="text-align: center" >Năm học</th>
          <th style="text-align: center" >Đoàn khoa tự xếp loại</th>
          <th style="text-align: center" >Cán bộ xếp loại</th>
          <th style="text-align: center" >Trạng thái</th>
          <th style="text-align: center" >Thao tác</th>


        </thead>
        <?php
        $stt=1;
        ?>
        <tbody>
          @foreach($pdg_dk as $phieudanhgia_doankhoa)

          <tr>
            <td>{{$stt++}}</td>
{{--             <td>
              {{$phieudanhgia_doankhoa->ID}}
            </td> --}}
            <td>
              {{$phieudanhgia_doankhoa->TEN_DK}}
            </td>
            <td>
              {{$phieudanhgia_doankhoa->TEN_MP}}
            </td>
            <td>         
              {{$phieudanhgia_doankhoa->TEN_NH}}          
            </td>
            <td>         
              {{$phieudanhgia_doankhoa->TEN_XLDK}}          
            </td>

            @if($phieudanhgia_doankhoa->CB_XEPLOAI_DK_ID == "1")
            <td style="text-align: center;"><span class="label label-success">Xuất sắc</span></td>

            @elseif($phieudanhgia_doankhoa->CB_XEPLOAI_DK_ID == "2")
            <td style="text-align: center;"><span class="label label-success">Khá</span></td>
            @elseif($phieudanhgia_doankhoa->CB_XEPLOAI_DK_ID == "3")
            <td style="text-align: center;"><span class="label label-success">Trung bình</span></td>
            @elseif($phieudanhgia_doankhoa->CB_XEPLOAI_DK_ID == "4")
            <td style="text-align: center;"><span class="label label-success">Yếu - kém</span></td>
            @else
            <td style="text-align: center;"><span class="label label-danger">Chưa xếp loại</span></td>
            @endif

            @if($phieudanhgia_doankhoa->TRANGTHAI_DUYET == "1")
            <td style="text-align: center;"><span class="label label-info">Đã đánh giá</span></td>

            @else
            <td style="text-align: center;"><span class="label label-danger">Chưa đánh giá</span></td>
            @endif
            <td>
             <div style="align:center" class="btn-group">
              <a href="{{route('duyet_pdg_dk', $phieudanhgia_doankhoa->ID)}}">
                <button type="button"  class="btn active" style="background: purple; color: white" role="button" >Duyệt <span class=" glyphicon glyphicon-pencil"></span>  
                </button>
              </a>
            </div>
          </td>

        </tr>

        @endforeach
      </tbody>
    </table>


  </form>
  <div class="panel panel-info">

    <div class="panel-heading clearfix">

      <div class="pull-left">
        <h4 class="mt-5 mb-5">Danh sách đã đánh giá</h4>
      </div>
    </div>
    <br>
    <div class="panel-body panel-body-with-table">
      <table id="example1" class="table table-striped table-bordered table-hover" style="text-align: center">

        <thead >
          <th style="text-align: center" >Stt</th>
          {{-- <th style="text-align: center" >Id</th> --}}
          <th style="text-align: center" >Đoàn khoa</th>
          <th style="text-align: center" >Mẫu phiếu</th>
          <th style="text-align: center" >Năm học</th>
          <th style="text-align: center" >Đoàn khoa tự xếp loại</th>
          <th style="text-align: center" >Cán bộ xếp loại</th>
          <th style="text-align: center" >Trạng thái</th>
          <th style="text-align: center" >Thao tác</th>


        </thead>
        <?php
        $stt=1;
        ?>
        <tbody>
          @foreach($pdg_dk1 as $phieudanhgia_doankhoa1)

          <tr>
            <td>{{$stt++}}</td>
{{--             <td>
              {{$phieudanhgia_doankhoa1->ID}}
            </td>
            --}}            <td>
              {{$phieudanhgia_doankhoa1->TEN_DK}}
            </td>
            <td>
              {{$phieudanhgia_doankhoa1->TEN_MP}}
            </td>
            <td>         
              {{$phieudanhgia_doankhoa1->TEN_NH}}          
            </td>
            <td>         
              {{$phieudanhgia_doankhoa1->TEN_XLDK}}          
            </td>

            @if($phieudanhgia_doankhoa1->CB_XEPLOAI_DK_ID == "1")
            <td style="text-align: center;"><span class="label label-success">Xuất sắc</span></td>

            @elseif($phieudanhgia_doankhoa1->CB_XEPLOAI_DK_ID == "2")
            <td style="text-align: center;"><span class="label label-success">Khá</span></td>
            @elseif($phieudanhgia_doankhoa1->CB_XEPLOAI_DK_ID == "3")
            <td style="text-align: center;"><span class="label label-success">Trung bình</span></td>
            @elseif($phieudanhgia_doankhoa1->CB_XEPLOAI_DK_ID == "4")
            <td style="text-align: center;"><span class="label label-success">Yếu - kém</span></td>
            @else
            <td style="text-align: center;"><span class="label label-danger">Chưa xếp loại</span></td>
            @endif

            @if($phieudanhgia_doankhoa1->TRANGTHAI_DUYET == "1")
            <td style="text-align: center;"><span class="label label-info">Đã đánh giá</span></td>

            @else
            <td style="text-align: center;"><span class="label label-danger">Chưa đánh giá</span></td>
            @endif
            <td>
             <div style="align:center" class="btn-group">
              <a href="{{route('duyet_pdg_dk', $phieudanhgia_doankhoa1->ID)}}">
               <button type="button"  class="btn active" style="background: red; color: white" role="button" >Sửa<span class=" glyphicon glyphicon-pencil"></span>       
               </button>
             </a>
           </div>
         </td>

       </tr>

       @endforeach
     </tbody>
   </table>
 </div>
</div>
</div>
</div>


@endsection 