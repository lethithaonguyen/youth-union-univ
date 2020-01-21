 
@extends('layout.app')

@section('head_content')
DANH SÁCH PHIẾU CHI ĐOÀN KHOA

@endsection
@section('link_content')

<h1>
  QUẢN LÝ PHIẾU CHI ĐOÀN KHOA
  <small>                
    <a href="{{route('phieuchi_dk.create')}}" class="btn btn-success">
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

@if(Session::has('capquyensuccess'))
<script type="text/javascript">
 setTimeout(function () {
  toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-center",
    "preventDuplicates": true,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "100",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
  toastr.success('Cấp Quyền Thành Công', 'Successfully!!!', {timeOut: 800});
}, 500);
</script>
@endif

@if(Session::has('deletesuccess'))
<script type="text/javascript">
 setTimeout(function () {
  toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-center",
    "preventDuplicates": true,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "100",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
  toastr.success('Xóa Thành Công', 'Successfully!!!', {timeOut: 800});
}, 500);
</script>
@endif

<!-- /.box-header -->
<div class="box-body">

  <div class="row">
    <div class="col-sm-12">
      {!! csrf_field() !!}

      <table class="table table-bordered table-striped dataTable" id="example1" role="grid" aria-describedby="example1_info" >
        <thead>
          <tr role="row" >
            <th style="text-align: center;">STT</th>
            <!-- <th tabindex="0" class="sorting" aria-controls="example1" style="width: 262.33px;" aria-label="Browser: activate to sort column ascending" rowspan="1" colspan="1">Đoàn viên lập danh sách</th> -->
            <th style="text-align: center;">Đoàn khoa</th>
            <th style="text-align: center;">Loại nội dung chi</th>
            <th style="text-align: center;">Đoàn viên nhận</th>
            <th style="text-align: center;">Đoàn viên tạo</th>
            <th style="text-align: center;">Tên phong trào</th>
            <th style="text-align: center;">Nội dung phiếu chi</th>
            <th style="text-align: center;">Số tiền</th>
            <th style="text-align: center;">Ngày chi</th>
            <th style="text-align: center;">Trạng thái</th>
            <!-- <th tabindex="0" class="sorting" aria-controls="example1" style="width: 262.33px; text-align: center; " aria-label="Platform(s): activate to sort column ascending" rowspan="1" colspan="3" >Thao tác</th> -->
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
              <td>{{$phieuchi_dk->TEN_SV}}</td>
              <td>{{$phieuchi_dk->TEN_PT_DK}}</td>
              <td>{{$phieuchi_dk->NOIDUNG_PC_DK}}</td>
              <td>{{$phieuchi_dk->SOTIEN_CHI_DK}}</td>
              <td>{{\Carbon\Carbon::parse($phieuchi_dk->NGAY_CHI_DK)->format('d/m/Y')}}</td>

              @if($phieuchi_dk->DUYET_PCDK == NULL)
              <td style="text-align: center;"><span class="label label-danger">Chưa duyệt</span></td>
              <!-- <td align="center">

                <button  type="button" class="btn bg-teal btn-flat " data-catid="{{$phieuchi_dk->ID}}" data-toggle="modal" data-target="#Duyet"><i class="glyphicon glyphicon-ok"></i> Duyệt</button>
              </td>
              <td>
                <button class="btn btn-danger" data-catid="{{$phieuchi_dk->ID}}" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> Xóa</button>
              </td>
              <td>
                <a href="{{ route('phieuchi_dk.edit',['phieuchi_dk'=>$phieuchi_dk->ID])}}">
                  <button style="width:100%" type="button" class="btn btn-block btn-info">Sửa <span class=" glyphicon glyphicon-pencil"></span>            
                  </button>
                </a>
              </td>

            </td> -->
            @elseif($phieuchi_dk->DUYET_PCDK == 1)
            <td style="text-align: center;"><span class="label label-success">Đã duyệt</span></td>
            <!-- <td align="center">
              <button  type="button" class="btn bg-orange btn-flat " data-catid="{{$phieuchi_dk->ID}}" data-toggle="modal" data-target="#Huyduyet"><i class="glyphicon glyphicon-remove"></i> Hủy duyệt</button>
            </td>
            <td>
              <button class="btn btn-danger" data-catid="{{$phieuchi_dk->ID}}" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> Xóa</button>
            </td>
            <td>
              <a href="{{ route('phieuchi_dk.edit',['phieuchi_dk'=>$phieuchi_dk->ID])}}">
                <button style="width:100%" type="button" class="btn btn-block btn-info">Sửa <span class=" glyphicon glyphicon-pencil"></span>            
                </button>
              </a> -->
              @else
              <td style="text-align: center;"><span class="label label-default">Không duyệt</span><!-- </td>
              <td align="center">
                <button  type="button" class="btn bg-teal btn-flat " data-catid="{{$phieuchi_dk->ID}}" data-toggle="modal" data-target="#Khongduyet"><i class="glyphicon glyphicon-ok"></i>Duyệt</button>
              </td>
              <td>
                <button class="btn btn-danger" data-catid="{{$phieuchi_dk->ID}}" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> Xóa</button>
              </td>
              <td>
                <a href="{{ route('phieuchi_dk.edit',['phieuchi_dk'=>$phieuchi_dk->ID])}}">
                  <button style="width:100%" type="button" class="btn btn-block btn-info">Sửa <span class=" glyphicon glyphicon-pencil"></span>            
                  </button>
                </a>

              </td> -->
              @endif
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
    </div>
  </div>
</div>
<!-- /.box-body -->



<!-- <div class="modal modal-danger fade" id="Huyduyet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">Xác Nhận Hủy Duyệt</h4>
      </div>
      <form action="{{route('huyduyet_pcdk.update','test')}}" method="post">
        {{method_field('patch')}}
        {{csrf_field()}}
        <div class="modal-body">
          <input type="hidden" name="id" id="id" value="">
          <p class="text-center">
            Bạn Có Chắc Chắn Xác Nhận?
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

<div class="modal modal-danger fade" id="Khongduyet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">Xác Nhận Hủy Duyệt</h4>
      </div>
      <form action="{{route('khongduyet_pcdk.update','test')}}" method="post">
        {{method_field('patch')}}
        {{csrf_field()}}
        <div class="modal-body">
          <input type="hidden" name="id" id="id" value="">
          <p class="text-center">
            Bạn Có Chắc Chắn Xác Nhận?
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

<div class="modal modal-danger fade" id="Duyet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">Xác Nhận Duyệt</h4>
      </div>
      <form action="{{route('duyet_pcdk.update','test')}}" method="post">
        {{method_field('patch')}}
        {{csrf_field()}}
        <div class="modal-body">
          <input type="hidden" name="id" id="id" value="">
          <p class="text-center">
            Bạn Có Chắc Chắn Xác Nhận?
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

  $('#Duyet').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var id = button.data('catid') 
    var modal = $(this)
    modal.find('.modal-body #id').val(id);
  })

  $('#Huyduyet').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var id = button.data('catid') 
    var modal = $(this)
    modal.find('.modal-body #id').val(id);
  })

  $('#Khongduyet').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var id = button.data('catid') 
    var modal = $(this)
    modal.find('.modal-body #id').val(id);
  })
</script>
 -->

@endsection