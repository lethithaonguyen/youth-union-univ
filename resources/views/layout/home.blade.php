 @extends('layout.app')

 @section('content')

 @if(Session::has('success_message'))
 <div class="alert alert-success"id="success-alert">
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

<div class="box box-primary" >
  <div class="row">
   <div class="col-sm-12">
    <form role="form" method="POST" action="" enctype="multipart/form-data">
     {{ csrf_field() }}

     <!-- /.card-body -->

     <div  style="text-align: center;">
      <a @if(session::get('session_vt')== 4)href="{{route('thongtinsinhvien')}}" @endif title="Thông tin cá nhân">
       <div class="pull-left image  col-md-1" style="margin: 10px; margin-left: 10px; ">
        <img src="{{asset('hinh_luanvan/thongtin.png')}}" width="80px" >
        <p>Thông tin cá nhân</p>
      </div>
    </a>

    @if(session::get('session_vt')== 4 || session::get('session_vt')== 2)
    <a href="{{route('thanhtich_thamgia.index')}}" title="Thành tích tham gia">
     <div class="pull-left image col-md-1" style="margin: 10px; margin-left: 10px; " >
      <img src="{{asset('hinh_luanvan/success.png')}}" width="80px" >
      <p>Thành tích tham gia</p>
    </div>
  </a>
  @endif

  @if(session::get('session_vt')== 3 || session::get('session_vt')== 2)
  <a  href="{{route('chitiet_ktkl.index')}}"  title="Khen thưởng - Kỷ luật">
   <div class="pull-left image col-md-1" style="margin: 10px; margin-left: 10px; " >
    <img src="{{asset('hinh_luanvan/khenthuong.png')}}" width="80px" >
    <p>Khen thưởng - kỷ luật</p>
  </div>
</a>
@endif
@if(Session::get('session_vt') == 3 || Session::get('session_vt') == 2)
<a @if(Session::get('session_vt') == 3) href="{{route('phieubau_uutu.index')}}" @elseif (Session::get('session_vt') == 2) href="{{route('chitiet_bau_ut.index')}}" @endif  title="Bầu ưu tú">
 <div class="pull-left image col-md-1" style="margin: 10px; margin-left: 10px; "  >
  <img src="{{asset('hinh_luanvan/bau_uutu.png')}}" width="80px" >
  <p>Bầu ưu tú</p>
</div>
</a>
@endif
{{--     <a href=""  title="Thống kê">
     <div class="pull-left image col-md-1" style="margin: 10px; margin-left: 10px; "  >
      <img src="{{asset('hinh_luanvan/thongke.png')}}" width="80px" >
    </div>
  </a> --}}
  @if(Session::get('session_vt') == 3 || Session::get('session_vt') == 2||Session::get('session_vt') == 1)
  <a @if(Session::get('session_vt') == 3) href="{{route('getdoanvien')}}" @elseif(Session::get('session_vt') == 2) href="{{route('doanphi_thu_cd.index')}}" @else href="{{route('doanphi_thu_dk.index')}}"  @endif   title="Đoàn phí thu">
   <div class="pull-left image col-md-1" style="margin: 10px; margin-left: 10px; "  >
    <img src="{{asset('hinh_luanvan/doanphi_thu.png')}}" width="80px" >
    <p>Đoàn phí thu</p>
  </div>
</a>
@endif
@if(Session::get('session_vt') == 3 || Session::get('session_vt') == 2)
<a @if(Session::get('session_vt') == 3) href="{{route('phieuchi_chi_cd.index')}}" @else href="{{route('phieuchi_dk.index')}}" @endif  title="Đoàn phí chi">
 <div class="pull-left image col-md-1" style="margin: 10px; margin-left: 10px; "  >
  <img src="{{asset('hinh_luanvan/doanphi_chi.png')}}" width="80px" >
  <p>Đoàn phí chi</p>
</div>
</a>
@endif
@if(Session::get('session_vt') == 4 || Session::get('session_vt') == 3 ||Session::get('session_vt') == 2)
<a @if(Session::get('session_vt') == 4) href="{{route('index_create_pdg_dv')}}" @elseif(Session::get('session_vt') == 3) href="{{route('index_create_pdg_cd')}}"  @else href="{{route('index_create_pdg_dk')}}" @endif  title="Đánh giá">
 <div class="pull-left image col-md-1" style="margin: 10px; margin-left: 10px; "  >
  <img src="{{asset('hinh_luanvan/danhgia.png')}}" width="80px" >
  <p>Đánh giá</p>
</div>
</a>
@endif
@if(Session::get('session_vt') == 3 ||Session::get('session_vt') == 2 ||Session::get('session_vt') == 1)
<a @if(Session::get('session_vt') == 3) href="{{route('index_duyet_pdg_dv')}}" @elseif(Session::get('session_vt') == 2) href="{{route('index_duyet_pdg_cd')}}"  @else href="{{route('index_duyet_pdg_dk')}}" @endif  title="Duyệt đánh giá">
 <div class="pull-left image col-md-1" style="margin: 10px; margin-left: 10px; "  >
  <img src="{{asset('hinh_luanvan/duyet.png')}}" width="80px" >
  <p>Duyệt đánh giá</p>
</div>
</a>
@endif
@if(Session::get('session_vt') == 3 ||Session::get('session_vt') == 2 ||Session::get('session_vt') == 1)
<a href=""  title="Mẫu phiếu">
 <div class="pull-left image col-md-1" style="margin: 10px; margin-left: 10px; "  >
  <img src="{{asset('hinh_luanvan/mauphieu.png')}}" width="80px" >
  <p>Mẫu phiếu</p>
</div>
</a>
@endif
@if(Session::get('session_vt') == 3 ||Session::get('session_vt') == 2 || Session::get('session_vt') == 4)
<a @if(Session::get('session_vt') == 3) href="{{route('pt_chidoan.index')}}" @elseif(Session::get('session_vt') == 4) href="{{route('pt_chidoan.index')}}" @else href="{{route('pt_doankhoa.index')}}"  @endif  title="Phong trào">
 <div class="pull-left image col-md-1" style="margin: 10px; margin-left: 10px; "  >
  <img src="{{asset('hinh_luanvan/phongtrao.png')}}" width="80px" >
  <p>Phong trào</p>
</div>
</a>
@endif
@if(Session::get('session_vt') == 3 ||Session::get('session_vt') == 2 || Session::get('session_vt') == 1)
<a @if(Session::get('session_vt') == 3 || Session::get('session_vt') == 1) href="{{route('qd_dv_ketnap.index')}}" @else href="{{route('dv_ketnap.index')}}" @endif  title="Kết nạp đoàn">
 <div class="pull-left image col-md-1" style="margin: 10px; margin-left: 10px; "  >
  <img src="{{asset('hinh_luanvan/ketnap.png')}}" width="80px" >
  <p>Kết nạp đoàn</p>
</div>
</a>
@endif
@if(Session::get('session_vt') == 3 ||Session::get('session_vt') == 2 || Session::get('session_vt') == 1)
<a @if(Session::get('session_vt') == 3 || Session::get('session_vt') == 1) href="{{route('qd_dv_ttdoan.index')}}" @else href="{{route('dv_tt_doan.index')}}" @endif  title="Trưởng thành đoàn">
 <div class="pull-left image col-md-1" style="margin: 10px; margin-left: 10px; "  >
  <img src="{{asset('hinh_luanvan/truongthanh.png')}}" width="80px" >
  <p>Trưởng thành đoàn</p>
</div>
</a>
@endif
</div>  
</form>
</div>
</div>
</div>
@if(Session::get('session_vt') == 1 ||Session::get('session_vt') == 2 )
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
      <br>
      <br>
      <br>
      <br>
      <canvas id="myChart" height="80"></canvas>
      <br>
      @if(Session::get('session_vt') == 2 )
      <p><button type="button" style="background: #EE0000; width: 40px; height: 15px;" ></button> : Top 3 Chi đoàn có số lượng phong trào nhiều nhất.  </p>
      <br>
      <p><button type="button" style="background: #00CED1; width: 40px; height: 15px;" ></button> : Các Chi đoàn còn lại. </p>
      @endif
      @if(Session::get('session_vt') == 1 )
      <p><button type="button" style="background: #EE0000; width: 40px; height: 15px;" ></button> : Top 3 Đoàn khoa có số lượng phong trào nhiều nhất.  </p>
      <br>
      <p><button type="button" style="background: #00CED1; width: 40px; height: 15px;" ></button> : Các Đoàn khoa còn lại. </p>
      @endif
    </div>
  </div>
</div>

  <!-- Modal -->
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script src="{{ asset ('theme/admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset ('theme/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

  <script>
  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo ("$labels"); ?>,

      datasets: [{
        label: <?php echo ("$labels"); ?>,
        data: <?php echo ("$values"); ?>,
        backgroundColor: [
        'rgba(238,0,0)',
        'rgba(238,0,0)',
        'rgba(238,0,0)',

        'rgba(0 ,206 ,209)',
        'rgba(0 ,206 ,209)',
        'rgba(0 ,206 ,209)',
        'rgba(0 ,206 ,209)',
        'rgba(0 ,206 ,209)',
        'rgba(0 ,206 ,209)',
        'rgba(0 ,206 ,209)',
        'rgba(0 ,206 ,209)',
        'rgba(0 ,206 ,209)',
        'rgba(0 ,206 ,209)',
        'rgba(0 ,206 ,209)'
                // ]
                ]
            }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
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
@endif
@endsection
