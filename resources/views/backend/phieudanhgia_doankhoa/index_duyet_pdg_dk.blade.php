 
@extends('layout.app')

@section('head_content')

DANH SÁCH ĐOÀN TRƯỜNG ĐÁNH GIÁ 


@endsection
@section('link_content')
<h1>
  DANH SÁCH ĐOÀN TRƯỜNG ĐÁNH GIÁ ĐOÀN CỦA ĐOÀN KHOA {{-- <b>{{ Session::get('session_ten_doankhoa') }}</b> --}}

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

  <div class="panel-heading clearfix">

    <div class="pull-left">
      <h4 class="mt-5 mb-5"></h4>
    </div>
  </div>
  <br>

  <div class="panel-body panel-body-with-table">
    <form method="" action="" >
      {!! csrf_field() !!}
      
      <table id="example1" class="table table-striped table-bordered table-hover">

        <thead>
          <th style="text-align: center;">Stt</th>
      {{--     <th style="text-align: center;">id</th> --}}
          <th style="text-align: center;">Đoàn khoa</th>
          <th style="text-align: center;"></th>
          <th style="text-align: center;">Thao tác</th>


        </thead>
        <?php
        $stt=1;
        ?>
        <tbody>
          @foreach($dk as $doankhoa)

          <tr>
            <td>{{$stt++}}</td>
     {{--        <td>
              {{$doankhoa->ID}}
            </td> --}}
            <td>         
              {{$doankhoa->TEN_DK}}          
            </td>
            <td><span  style=" float:center;">(Có
                  <?php
                  $x = $doankhoa->ID;
                  // dd($x);
                  $countcd = DB::table('phieudanhgia_doankhoa')->where('DOANKHOA_ID' ,'=',$x)->where('TRANGTHAI_DUYET','=', null)->count();
                  // dd($countnam);
                  echo "<span style='color:red;font-weight:bold'>$countcd</span>" ;
                  ?> chưa duyệt và
                  <?php
                  $x = $doankhoa->ID;
                  $countdd = DB::table('phieudanhgia_doankhoa')->where('DOANKHOA_ID' ,'=',$x)->where('TRANGTHAI_DUYET','=', '1')->count();
                  //dd($countnu);
                  echo "<span style='color:red;font-weight: bold;''>$countdd</span>" ;
                  ?> duyệt trong tổng gồm
                  <?php
                  $x = $doankhoa->ID;
                  $countphieu = DB::table('phieudanhgia_doankhoa')->where('DOANKHOA_ID' ,'=',$x)->count();

                  echo "<span style='color:red;font-weight:bold'>$countphieu</span>" ;
                  ?> phiếu )</span></td>
            <td style="text-align: center;">
             <div class="btn-group">
              <a href="{{route('ds_duyet_pdg_dk', $doankhoa->ID)}}">
                <button type="button"  class="btn btn-success active" role="button" >Đánh giá <span class=" glyphicon glyphicon-pencil"></span>            
                </button>
              </a>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </form>
</div>
</div>
</div>
@endsection 