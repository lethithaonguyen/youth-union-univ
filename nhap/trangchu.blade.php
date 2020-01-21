@extends('layout.app')

@section('head_content')
BIỂU ĐỒ THỐNG KÊ

@endsection
@section('link_content')
@if(Session::get('session_vt') == 2 )
<h1>
	BIỂU ĐỒ THỐNG KÊ SỐ LƯỢNG PHONG TRÀO CHI ĐOÀN
</h1>
@endif
@if(Session::get('session_vt') == 1 )
<h1>
	BIỂU ĐỒ THỐNG KÊ SỐ LƯỢNG PHONG TRÀO ĐOÀN KHOA
</h1>
@endif
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

<div class="box" >


	<div class="box-header">
		<!-- <h3 class="box-title">Danh Sách Hãng Sản Xuất</h3> -->
	</div>
	<!-- /.box-header -->
	<div class="box-footer" >
		<div class="col-md-12" >
			@if(Session::get('session_vt') == 2 )
			<h2 align="center" style="color: teal;" ><b>Biểu Đồ Thống Kê Các Phong Trào Của Chi Đoàn</b></h2>
			@endif
			@if(Session::get('session_vt') == 1 )
			<h2 align="center" style="color: teal;" ><b>Biểu Đồ Thống Kê Các Phong Trào Của Đoàn Khoa</b></h2>
			@endif
			<br>
			<form method="get" @if(Session::get('session_vt') == 2) action="{{route('thongke_ptcd_loc_theonam')}}" @elseif (Session::get('session_vt') == 1) action="{{route('thongke_ptdk_loc_theonam')}}" @endif  >
				
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
				@if(Session::get('session_vt') ==2)

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
				@endif
				<div class="col-md-6 control-label">
					<button type='submit' class="btn btn-info"> Liệt kê </button>
				</div>
			</form>
			<canvas id="line-chart" height="80"></canvas>
		</div>
	</div>
</div>

	<!-- Modal -->
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	<script src="{{ asset ('theme/admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset ('theme/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

	<script type="text/javascript">
		new Chart(document.getElementById("line-chart"), {
			type: 'line',
			data: {
				labels: <?php echo ("$labels"); ?>,
				datasets: [
				{
					label: <?php echo ("$labels"); ?>,
					backgroundColor: 'rgb(205,0,205, 0.2)',
					borderColor: 'rgb(205,0,205,1)',
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
