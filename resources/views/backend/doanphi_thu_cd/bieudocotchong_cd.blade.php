@extends('layout.app')

@section('head_content')
BIỂU ĐỒ THỐNG KÊ

@endsection
@section('link_content')
<h1>
	BIỂU ĐỒ THỐNG KÊ SỐ TIỀN ĐÃ ĐÓNG CỦA CHI ĐOÀN {{-- {{Session::get('session_ten_chidoan_sv')}} --}}
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Thống kê</li>
	<li class="active">Thống kê số tiền đóng số tiền đóng</li>
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
			<h2 align="center" style="color: teal;" ><b>Thống Kê Đoàn Phí Đã Đóng Và Chưa Đóng Của Chi Đoàn Theo Năm</b></h2>
			<br>
			<form method="get" action="{{route('bieudocotchong_theonam_cd')}}" >
				<div class="form-group col-md-6">
					<label for="namhoc">Chọn Năm học</label>
					<div class="col-3">
						<select class="form-control" name="namhoc" id="namhoc">
							@foreach($nh as $namhoc)
							<option @if($n_dp->ID == $namhoc->ID ) selected @endif value="{{$namhoc->ID}}">{{$namhoc->TEN_NH}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group col-md-6">
					<label for="khoa">Chọn Khóa</label>
					<div class="col-3">
						<select class="form-control" name="khoa" id="khoa">
							@foreach($k as $khoa)
							<option @if($k_dp->ID == $khoa->ID ) selected @endif value="{{$khoa->ID}}">{{$khoa->TEN_KHOA}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="control-label" style="text-align: center;">
					<button type='submit' class="btn btn-info"> Liệt kê </button>
				</div>
			</form>
			
		</div>
	</div>
	<figure class="highcharts-figure">
		<div id="container" style="width: 100%"></div>
		<p class="highcharts-description">
			<h4 align="center">Biểu đồ thể hiện số tiền đoàn phí đã đóng và chưa đóng trong 1 năm của các Chi Đoàn</h4>
		</p>
	</figure>
	<div class="box-body">

		<div class="row">
			<div class="col-sm-12">
				{!! csrf_field() !!}
				<table class="table table-bordered table-hover" id="example1"  >
					<thead >
						<tr role="row" >
							<th style="text-align: center;">STT</th>
							<th style="text-align: center;">Tên chi đoàn</th>
							<th style="text-align: center;">Số lượng đoàn viên</th>
							<th style="text-align: center;">Số tiền đã đóng (VND)</th>
							<th style="text-align: center;">Số tiền chưa đóng (VND)</th>
							<th style="text-align: center;">Số tiền phải đóng (VND)</th>
							<th style="text-align: center;">Năm đóng</th>
						</tr>
					</thead>
					<?php
					$stt=1;
					?> 
					<tbody>
						@foreach($t_t as $tongtien)          
						<tr class="odd" role="row">
							<td class="sorting_1">{{$stt++}}</td>
							<td>{{$tongtien->TEN_CD}}-{{$tongtien->TEN_KHOA}}</td>
							<td>{{$tongtien->soluong_dv}}</td>
							<td>{{number_format($tongtien->so_tien_da_dong)}}</td>
							<td>{{number_format($tongtien->so_tien_chua_dong)}}</td>
							<td>{{number_format($tongtien->so_tien_phai_dong)}}</td>
							<td>{{$tongtien->TEN_NH}}</td>
						</tr>
						@endforeach



					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- /.box-body -->

</div>
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
			text: ''
		},
		xAxis: {
			categories: <?php echo ("$labels");?>
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Tổng tiền đóng đoàn phí'
			},
			stackLabels: {
				enabled: true,
				style: {
					fontWeight: 'bold',
                color: ( // theme
                	Highcharts.defaultOptions.title.style &&
                	Highcharts.defaultOptions.title.style.color
                	) 
                || 'red'
            }
        }
    },
    legend: {
    	align: 'right',
    	x: -30,
    	verticalAlign: 'top',
    	y: 25,
    	floating: true,
    	backgroundColor:
    	Highcharts.defaultOptions.legend.backgroundColor || 'white',
    	borderColor: '#CCC',
    	borderWidth: 1,
    	shadow: false
    },
    tooltip: {
    	headerFormat: '<b>{point.x}</b><br/>',
    	pointFormat: '{series.name}: {point.y}<br/>Tổng tiền: {point.stackTotal}'
    },
    plotOptions: {
    	column: {
    		stacking: 'normal',
    		dataLabels: {
    			enabled: true
    		}
    	}
    },
    series: [{
    	name: 'Đã đóng',
    	data: <?php echo ("$values");?>
    }, {
    	name: 'Chưa đóng',
    	data: <?php echo ("$values1");?>
    }, 
    ]
});
</script>
@endsection