@extends('layout.app')

@section('head_content')
BIỂU ĐỒ THỐNG KÊ

@endsection
@section('link_content')
<h1>
  BIỂU ĐỒ THỐNG KÊ SỐ LƯỢNG CHI ĐOÀN
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Thống kê</li>
  <li class="active">Thống kê số lượng chi đoàn</li>
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

  <div class="box-body">

    
</div>
<div class="box-footer">
  <div class="col-md-12">
      <h2>Biểu Đồ Thống Kê Số lượng bộ môn của khoa</h2>
      <canvas id="bar-chart" height="100"></canvas>
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
  new Chart(document.getElementById("bar-chart"), {
    type: 'pie',
    data: {
      labels: <?php echo ("$labels"); ?>,
      datasets: [
        {
          label: <?php echo ("$labels"); ?>,
          backgroundColor: ["#008000", "#48D1CC", "#008080", "#B0E0E6", "#191970", "#FF00FF", "#4B0082", " #CD853F", " #800000", " #708090", "#FFE4E1", "#FF1493","#3e95cd", "#8e5ea2"],
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


@endsection
