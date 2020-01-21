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

			<h2 align="center" style="color: teal;" ><b>Biểu Đồ Thống Kê Số Tiền Đã Đóng Của Chi Đoàn</b></h2>
			<br>
			<form method="get" action="{{route('tong_tien_loc_theonam_cd')}}" >
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
							<th style="text-align: center;">Tên chi đoàn</th>
							<th style="text-align: center;">Năm học</th>
							<th style="text-align: center;">Số tiền đã đóng (VND)</th>
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
							<td>{{$tongtien->TEN_NH}}</td>
							<td>{{number_format($tongtien->so_tien_da_dong)}}</td>
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

<button  class="btn btn-success"><a href="{{ route('doanphi_thu_cd.index') }}" style="color: white;"> Trở về </a></button>
@endsection
