@extends('layout.app')

@section('head_content')
DANH SÁCH ĐOÀN PHÍ THU ĐOÀN VIÊN THUỘC CHI ĐOÀN : {{ Session::get('session_ten_chidoan_sv') }}-{{Session::get('session_ten_khoa_sv')}}

@endsection
@section('link_content')
<h1>
  QUẢN LÝ ĐOÀN PHÍ THU ĐOÀN VIÊN THUỘC CHI ĐOÀN : {{ Session::get('session_ten_chidoan_sv') }}-{{Session::get('session_ten_khoa_sv')}}
  <small>                
    <div class="dropdown">
      <button onclick="myFunction()" class="dropbtn btn btn-info">Thống kê</button>
      <div id="myDropdown" class="dropdown-content">
        <a class="dropdown-item"  href=" {{route('tong_tien_theonam_dv')}}" class="btn btn-success">
          <span aria-hidden="true" style="font-family: Arial;">Cơ cấu tiền đã đóng</span>
        </a>
        <a class="dropdown-item"  href=" {{route('bieudocotchong_dv')}}" class="btn btn-success">
          <span aria-hidden="true" style="font-family: Arial;">Cơ cấu tiền đã thu</span>
        </a>
      </div>
    </div>
    </small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Danh sách đoàn phí thu đoàn viên</li>
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


  <div class="box-body">
    <div class="row">
      <div class="col-sm-12">
        <div class="panel-body panel-body-with-table">
          <form method="get" action="{{route('doanphi_thu_dv1.getnam')}}" >
           <label class="col-md-2 control-label">Chọn Năm học</label>
           <div class="col-md-4">
            <select class="form-control" name="namhoc" id="namhoc">
              @foreach($nh as $val)
              <option @if($tn_dp->NAMHOC_ID == $val->ID ) selected @endif value="{{$val->ID}}">{{$val->TEN_NH}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-2 control-label">
            <button type='submit' class="btn btn-info"> Liệt kê </button>
          </div>
        </form>
        <br><br><br><br>
        <form method="post" action="{{route('doanphi_thu_dv1.update')}}">
          {!! csrf_field() !!}
          <table class="table"  border="0" style="border-color: gray"  >
            <thead>
              <tr>
               <th id="blank">&nbsp;</th>
               <th id="blank">&nbsp;</th>
               @foreach($tn as $thangnam)
               <th id="co1" headers="blank">{{$thangnam->THANGNAM}}</th>
               @endforeach
               <th>Số tháng đã đóng</th>

             </tr>
           </thead>
           <?php
           $stt=1;
           ?> 
           <tbody>
            @foreach($dv_tn as $doanvien_thanhnien)
            <tr>
              <th headers="blank">{{$stt++}}</th>
              <th id="c1" headers="blank">{{$doanvien_thanhnien->MSSV}} - {{$doanvien_thanhnien->TEN_SV}}</th>
              <?php $dem=0;?>
              @foreach($dp as $doanphi)
              <td>

                <?php 
                $h = '<input type="checkbox" class="flat-red" '; 
                ?>

                <?php
                foreach($dp_t_dv as $doanphi_thu_dv){
                  if($doanphi_thu_dv->DOANVIEN_THANHNIEN_ID == $doanvien_thanhnien->ID && $doanphi_thu_dv->THANGNAM_ID == $doanphi->ID && $doanphi_thu_dv->DADONG == 1){
                    $h = $h. ' checked ';
                    $dem = $dem + 1; 
                    break;
                  }

                }

                ?>
                <?php $h = $h . 'name="doanphi['.$doanvien_thanhnien->ID.']['. $doanphi->ID.']">';
                echo $h;?>
                <input type="hidden" name="namhoc_dp" value="{{ $nh_dp->ID }}">
              </td>
              @endforeach
              <td style="color: red; font-weight: bold;"> <?php echo $dem;?>     </td>
            </tr>
            @endforeach
          </tbody>

        </table>

        <div class="form-group">
          <div class="col-md-offset-6 col-md-6">
            <input class="btn btn-primary" type="submit" value="Lưu lại">
          </div>
        </div>
      </form>
      <br><br>
      <div class="col-lg-12">
        <div class="box box-info">
          <div class="box-body">
            <table class="table"  border="0" style="border-color: gray"  >
              <thead>
                <tr>
                  <th style="text-align: center">Stt</th>
                  <th style="text-align: center">MSSV</th>
                  <th style="text-align: center">Đoàn viên</th>
                  <th style="text-align: center">Số tiền đã đóng (VND) </th>
                  <th style="text-align: center">Số tiền chưa đóng (VND)</th>
                  <th style="text-align: center">Số tiền phải đóng (VND)</th>
                  <th style="text-align: center">Năm đóng</th>
                </tr>
              </thead>
              <?php
              $stt=1;
              ?> 
              <tbody>
                @foreach($t_t as $tongtien)          
                <tr class="odd" role="row">
                  <td class="sorting_1">{{$stt++}}</td>
                  <td>{{$tongtien->MSSV}}</td>
                  <td>{{$tongtien->TEN_SV}}</td>
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

    </div>
  </div>
</div>
</div>

@endsection

