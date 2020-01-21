@extends('layout.app')

@section('head_content')
BIỂU ĐỒ THỐNG KÊ

@endsection
@section('link_content')
<h1>
  BIỂU ĐỒ THỐNG KÊ QUÊ QUÁN
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Thống kê</li>
  <li class="active">Thống kê quê quán</li>
</ol>
@endsection

@section('css')
{{-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"> --}}
<link rel="stylesheet" href="{{ asset ('css/toastr.css') }}">
<link rel="stylesheet" href="{{ asset ('theme/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<style>
/*a {
  color: black !important;
  }*/
  td{
    text-align: center; !important;
  }

  th{
    text-align: center; !important;
  }
</style>
@endsection
@section('content')

<div class="box">

<div class="box-header">
  <!-- <h3 class="box-title">Danh Sách Hãng Sản Xuất</h3> -->
</div>
<!-- /.box-header -->
<div class="box-footer" >
  <div class="col-md-12" >
    <h2 align="center"><b>Biểu Đồ Thống Kê Số Lượng Đoàn viên Theo Quê Quán</b></h2>
    <canvas id="pie-chart" height="100"></canvas>
  </div>
</div>

<div class="box-body">

<div class="row">
    <div class="col-sm-12">
        {!! csrf_field() !!}
        <table class="table table-bordered table-hover" id="example1"  >
          <thead >
            <tr role="row" >
              <th style="text-align: center;">STT</th>
              <th style="text-align: center;">Tên tỉnh- thành phố</th>
              <th style="text-align: center;">Số lượng đoàn viên</th>
            </tr>
          </thead>
          <?php
          $stt=1;
          ?> 
          <tbody>  
            @foreach($t_k as $thongke)          
            <tr class="odd" role="row">
              <td class="sorting_1">{{$stt++}}</td>
              <td>{{$thongke->title}}</td>
              <td>{{$thongke->count}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- /.box-body -->

</div>

<!-- Modal -->
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{ asset ('theme/admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset ('theme/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<script type="text/javascript">
  new Chart(document.getElementById("pie-chart"), {
    type: 'pie',
    data: {
      labels: <?php echo ("$labels"); ?>,
      datasets: [
      {
        label: <?php echo ("$labels"); ?>,
        backgroundColor: ["#7B68EE","#FF6A6A", "#48D1CC", "#76EE00", "#EEEE00","#B0E0E6", "#191970", "#FF00FF", "#4B0082", " #CD853F", " #800000", " #708090", "#FFE4E1", "#FF1493","#3e95cd", "#8e5ea2"],
        data: <?php echo ("$values"); ?>
      }
      ]
    },
    options: {
      legend: { display: true },
      title: {
        display: true,
        //text: 'Biểu Đồ Thống Kê Số lượng Sinh Viên Đăng Kí Đề Tài'
      }
    }
  });

</script>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })

</script>

<button  class="btn btn-success"><a href="{{ route('doanvien_thanhnien.index_getchidoan') }}" style="color: white;"> Trở về </a></button>
@endsection
