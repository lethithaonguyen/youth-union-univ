 
@extends('layout.app')

@section('head_content')
DANH SÁCH PHIẾU CHI ĐOÀN KHOA <b>{{Session::get('session_ten_doankhoa')}}</b>

@endsection
@section('link_content')

<h1>
  QUẢN LÝ PHIẾU CHI ĐOÀN KHOA
  <small>                
    <a href="{{route('phieuchi_dk.index_gethocky_pcdk')}}" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách phiếu chi Đoàn khoa</li>
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


<!-- /.box-header -->
<div class="box-body">
  <form method="get" action="{{route('loc_phieuchi_dk')}}" >
   <label class="col-md-2 control-label">Chọn Năm học</label>
   <div class="col-md-4">
    <select class="form-control" name="namhoc" id="namhoc">
      @foreach($nh as $namhoc)
      <option @if($n_dp->ID == $namhoc->ID ) selected @endif value="{{$namhoc->ID}}">{{$namhoc->TEN_NH}}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-2 control-label">
    <button type='submit' class="btn btn-info"> Liệt kê </button>
  </div>
</form>
<div class="row">
  <div class="col-sm-12">
    {!! csrf_field() !!}

    <table class="table table-bordered table-striped dataTable" id="example1" role="grid" aria-describedby="example1_info" >
      <thead>
        <tr role="row" >
          <th style="text-align: center;">STT</th>
          <!-- <th style="text-align: center;">Đoàn viên lập danh sách</th> -->
          <th style="text-align: center;">Đoàn khoa</th>
          <th style="text-align: center;">Loại nội dung chi</th>
          <th style="text-align: center;">Đoàn viên nhận</th>
          <th style="text-align: center;">Đoàn viên tạo</th>
          <th style="text-align: center;">Tên phong trào</th>
          <th style="text-align: center;">Nội dung phiếu chi</th>
          <th style="text-align: center;">Số tiền (VND)</th>
          <th style="text-align: center;">Ngày chi</th>
          <th style="text-align: center;">Thao tác</th>
          <th style="text-align: center;" >Thao tác</th>
        </thead>
        <?php
        $stt=1;
        ?> 
        <tbody>  
          @foreach($pc_dk as $phieuchi_dk)          
          <tr class="odd" role="row">
            <td class="sorting_1">{{$stt++}}</td>
            <td>{{$phieuchi_dk->TEN_DK}}</td>
            <td>{{$phieuchi_dk->TEN_LOAI_DP}}</td>
            <td>{{$phieuchi_dk->TEN_SV}}</td>
            <td>{{$phieuchi_dk->TEN_LAP}}</td>
            <td>{{$phieuchi_dk->TEN_PT_DK}}</td>
            <td>{{$phieuchi_dk->NOIDUNG_PC_DK}}</td>
            <td>{{number_format($phieuchi_dk->SOTIEN_CHI_DK)}}</td>
            <td>{{\Carbon\Carbon::parse($phieuchi_dk->NGAY_CHI_DK)->format('d/m/Y')}}</td>
            <td>
              <button class="btn btn-danger" data-catid="{{$phieuchi_dk->ID}}" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> Xóa</button>
            </td>
            <td>
              <a href="{{ route('phieuchi_dk.edit',['phieuchi_dk'=>$phieuchi_dk->ID])}}">
                <button style="width:100%" type="button" class="btn btn-block btn-info">Sửa <span class=" glyphicon glyphicon-pencil"></span>            
                </button>
              </a>

            </td>

           <!--  <td>
              <div style="width:100%" class="btn-group">
                <a href="{{ route('phieuchi_dk.edit',['phieuchi_dk'=>$phieuchi_dk->ID])}}">
                  <button type="button" class="btn btn-block btn-info">Sửa <span class=" glyphicon glyphicon-pencil"></span>            
                  </button>
                </a>
              </div> 

            </td> -->
          </tr>
          @endforeach
        </tbody>
      </table>



      <table class="table table-bordered table-striped dataTable" id="example1" role="grid" aria-describedby="example1_info" >
        <thead>
          <tr role="row" >
            <th style="text-align: center;">STT</th>
            <!-- <th style="text-align: center;">Đoàn viên lập danh sách</th> -->
            <th style="text-align: center;">Năm học</th>
            <th style="text-align: center;">Tổng chi (VND)</th>
            <th style="text-align: center;">Tổng tiền quỹ còn lại (VND)</th>
            <th style="text-align: center;">Tổng tiền quỹ (VND)</th>
          </thead>
          <?php
          $stt=1;
          ?> 
          <tbody>  
            @foreach($st as $sotien)          
            <tr class="odd" role="row">
              <td class="sorting_1">{{$stt++}}</td>
              <td>{{$sotien->TEN_NH}}</td>
              <td>{{number_format($sotien->tongchi_doankhoa)}}</td>
              <td>{{number_format($sotien->tong_tien_quy_conlai)}}</td>
              <td>{{number_format($sotien->tong_quy_hienco)}}</td>

            </tr>
            @endforeach
          </tbody>
        </table>



      </div>
    </div>
  </div>
  <!-- /.box-body -->


  <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title text-center" id="myModalLabel">Xác Nhận Xóa</h4>
        </div>
        <form action="{{route('huyduyet_pcdk.destroy','test')}}" method="post">
          {{method_field('delete')}}
          {{csrf_field()}}
          <div class="modal-body">
            <input type="hidden" name="id" id="id" value="">
            <p class="text-center">
              Bạn Có Chắc Chắn Xóa?
            </p>
            <input type="hidden" name="id" id="id" value="">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">Không</button>
            <button type="submit" class="btn btn-warning">Có</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  @endsection

  @section('script')
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
  <script type="text/javascript">
    $('#delete').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 
      var id = button.data('catid') 
      var modal = $(this)
      modal.find('.modal-body #id').val(id);
    })
  </script>


  @endsection