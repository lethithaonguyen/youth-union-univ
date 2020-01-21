@extends('layout.app')

@section('head_content')
BIỂU ĐỒ THỐNG KÊ

@endsection
@section('link_content')
<h1>
	BIỂU ĐỒ THỐNG KÊ THU - CHI CHI ĐOÀN CỦA KHOA
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Thống kê</li>
	<li class="active">Thống kê thu chi đoàn phí</li>
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
	<div class="box-header">
		<!-- <h3 class="box-title">Danh Sách Hãng Sản Xuất</h3> -->
	</div>
	<!-- /.box-header -->
<div class="box-footer" >
  <div class="col-md-12" >

    <h2 align="center" style="color: teal;" ><b>Biểu Đồ Thống Kê Thu - Chi Đoàn Phí Chi Đoàn</b></h2>
<br>
     <form method="get" action="{{route('thongke_thuchi_theonam_cd')}}" >
				<div class="form-group">
					<label class="col-md-2 control-label">Chọn Năm học</label>
					<div class="col-md-4">
						<select class="form-control" name="namhoc" id="namhoc">
							@foreach($nh as $namhoc)
							<option @if($n_dp->ID == $namhoc->ID ) selected @endif value="{{$namhoc->ID}}">{{$namhoc->TEN_NH}}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-2 control-label">Chọn Khóa</label>
					<div class="col-md-4">
						<select class="form-control" name="khoa" id="khoa">
							@foreach($k as $khoa)
							<option @if($k_dp->ID == $khoa->ID ) selected @endif value="{{$khoa->ID}}">{{$khoa->TEN_KHOA}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-6 control-label">
					<button type='submit' class="btn btn-info"> Liệt kê </button>
				</div>
			</form>
  </div>
</div>

<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
        <h4 align="center">Biểu đồ thể hiện đoàn phí đã thu và chi trong 1 năm của các Chi Đoàn</h4>
    </p>
</figure>
<div class="box-body">

	<div class="row">
		<div class="col-sm-12">
			{!! csrf_field() !!}
			<table class="table table-bordered table-hover" id="example1"  >
				<thead >
					<tr role="row" >
						<th tabindex="0" class="sorting_asc" aria-controls="example1" style="width: 213.8px; text-align: center;" aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending" rowspan="1" colspan="1">STT</th>
						<th tabindex="0" class="sorting" aria-controls="example1" style="width: 262.33px;text-align: center;" aria-label="Browser: activate to sort column ascending" rowspan="1" colspan="1">Tên chi đoàn</th>
						<th tabindex="0" class="sorting" aria-controls="example1" style="width: 262.33px;text-align: center;" aria-label="Browser: activate to sort column ascending" rowspan="1" colspan="1">Năm học</th>
						<th tabindex="0" class="sorting" aria-controls="example1" style="width: 262.33px;text-align: center;" aria-label="Browser: activate to sort column ascending" rowspan="1" colspan="1">Số tiền đã thu</th>
					</tr>
				</thead>
				<?php
				$stt=1;
				?> 
				<tbody>  
					@foreach($t_t as $tongtien)          
					<tr class="odd" role="row">
						<td class="sorting_1">{{$stt++}}</td>
						<td>{{$tongtien->TEN_CD}}</td>
						<td>{{$tongtien->TEN_NH}}</td>
						<td>{{number_format($tongtien->so_tien_da_dong)}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>

			<table class="table table-bordered table-hover" id="example1"  >
				<thead >
					<tr role="row" >
						<th tabindex="0" class="sorting_asc" aria-controls="example1" style="width: 213.8px; text-align: center;" aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending" rowspan="1" colspan="1">STT</th>
						<th tabindex="0" class="sorting" aria-controls="example1" style="width: 262.33px;text-align: center;" aria-label="Browser: activate to sort column ascending" rowspan="1" colspan="1">Tên chi đoàn</th>
						<th tabindex="0" class="sorting" aria-controls="example1" style="width: 262.33px;text-align: center;" aria-label="Browser: activate to sort column ascending" rowspan="1" colspan="1">Năm học</th>
						<th tabindex="0" class="sorting" aria-controls="example1" style="width: 262.33px;text-align: center;" aria-label="Browser: activate to sort column ascending" rowspan="1" colspan="1">Số tiền đã chi</th>
					</tr>
				</thead>
				<?php
				$stt=1;
				?> 
				<tbody>  
					@foreach($t_t1 as $tongtien1)          
					<tr class="odd" role="row">
						<td class="sorting_1">{{$stt++}}</td>
						<td>{{$tongtien1->TEN_CD}}</td>
						<td>{{$tongtien1->TEN_NH}}</td>
						<td>{{number_format($tongtien1->tongchi_chidoan)}}</td>
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
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script type="text/javascript">
	Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: null
    },
    xAxis: {
        categories: <?php echo ("$labels");?>,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Đoàn phí thu - chi'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.3,
            borderWidth: 0
        }
    },

    series: [
    {
        name: 'Tổng đoàn phí thu',
        data: <?php echo ("$values"); ?>

    }, 
    {
        name: 'Tổng đoàn phí chi',
        data: <?php echo ("$values1"); ?>

    }
    ]
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

<button  class="btn btn-success"><a href="{{ route('app') }}" style="color: white;"> Trở về </a></button>
@endsection
