 
@extends('layout.app')

@section('head_content')
DANH SÁCH CHI TIẾT BẦU ƯU TÚ @if(Session::get('session_vt')==3) CỦA CHI ĐOÀN <b>{{Session::get('session_ten_chidoan_sv')}}-{{Session::get('session_ten_khoa_sv')}} </b>@elseif(Session::get('session_vt')==2)CỦA CHI ĐOÀN <b>{{Session::get('ten_chidoan')}}-{{Session::get('ten_khoa')}} </b>@endif

@endsection
@section('link_content')

<h1>
  QUẢN LÝ CHI TIẾT BẦU ƯU TÚ
  @if(Session::get('session_vt')==3)
  <small>                
    <a href="{{route('chitiet_bau_ut.create')}}" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
  @endif
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách chi tiết bầu ưu tú</li>
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
<div class="alert alert-success" id="success-alert">
  <span class="glyphicon glyphicon-ok"></span>
  {!! session('capquyensuccess') !!}

  <button type="button" class="close" data-dismiss="alert" aria-label="close">
    <span aria-hidden="true">&times;</span>
  </button>

</div>
@endif
@if(Session::has('deletesuccess'))
<div class="alert alert-danger" id="success-alert">
  <span class="glyphicon glyphicon-remove"></span>
  {!! session('deletesuccess') !!}

  <button type="button" class="close" data-dismiss="alert" aria-label="close">
    <span aria-hidden="true">&times;</span>
  </button>

</div>
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
            <!-- <th style="text-align: center;">Đoàn viên lập danh sách</th> -->
            <th style="text-align: center;">Tên phiếu đánh giá đoàn viên</th>
            <th style="text-align: center;">Chi đoàn - khóa</th>
            <th style="text-align: center;">Ngày bầu</th>
            <th style="text-align: center;">Số phiếu đồng ý</th>
            <th style="text-align: center;">Trạng thái</th>
            @if(Session::get('session_vt') == 2)
            <th style="text-align: center;">Thao tác</th>
            @endif
            @if(Session::get('session_vt') == 3)
            <th style="text-align: center;">Thao tác</th>
            <th style="text-align: center;">Thao tác</th>
            @endif
          </thead>
          <?php
          $stt=1;
          ?> 
          <tbody>  
            @foreach($ct_bau_ut as $chitiet_bau_ut)          
            <tr class="odd" role="row">
              <td class="sorting_1">{{$stt++}}</td>
              <td>{{$chitiet_bau_ut->TEN_PDGDV}}</td>
              <td>{{$chitiet_bau_ut->TEN_CD}}-{{$chitiet_bau_ut->TEN_KHOA}}</td>
              <td>{{\Carbon\Carbon::parse($chitiet_bau_ut->NGAY_BAU)->format('d/m/Y')}}</td>
              <td>{{$chitiet_bau_ut->SOPHIEU_DONGY}}</td>
              @if($chitiet_bau_ut->DUYET_BAU == NULL)
              <td style="text-align: center;"><span class="label label-danger">Chưa duyệt</span></td>
              @if(Session::get('session_vt') == 2)
              <td align="center">

                <button  type="button" class="btn bg-teal btn-flat " data-catid="{{$chitiet_bau_ut->ID}}" data-toggle="modal" data-target="#Duyet"><i class="glyphicon glyphicon-ok"></i> Duyệt</button>
              </td>
              @endif
              @if(Session::get('session_vt') == 3)
              <td>
                <button class="btn btn-danger" data-catid="{{$chitiet_bau_ut->ID}}" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> Xóa</button>
              </td>
              <td>
                <a href="{{ route('chitiet_bau_ut.edit',['chitiet_bau_ut'=>$chitiet_bau_ut->ID])}}">
                  <button style="width:100%" type="button" class="btn btn-block btn-info">Sửa <span class=" glyphicon glyphicon-pencil"></span>            
                  </button>
                </a>
              </td>
              @endif

              @else
              <td style="text-align: center;"><span class="label label-success">Đã duyệt</span></td>
              @if(Session::get('session_vt') == 2)
              <td align="center">
                <button  type="button" class="btn bg-orange btn-flat " data-catid="{{$chitiet_bau_ut->ID}}" data-toggle="modal" data-target="#Huyduyet"><i class="glyphicon glyphicon-remove"></i> Hủy duyệt</button>
              </td>
              @endif
              @if(Session::get('session_vt') == 3)
              <td>
                <button class="btn btn-danger" data-catid="{{$chitiet_bau_ut->ID}}" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> Xóa</button>
              </td>
              <td>
                <a href="{{ route('chitiet_bau_ut.edit',['chitiet_bau_ut'=>$chitiet_bau_ut->ID])}}">
                  <button style="width:100%" type="button" class="btn btn-block btn-info">Sửa <span class=" glyphicon glyphicon-pencil"></span>            
                  </button>
                </a>

              </td>
              @endif
              @endif
           <!--  <td>
              <div style="width:100%" class="btn-group">
                <a href="{{ route('chitiet_bau_ut.edit',['chitiet_bau_ut'=>$chitiet_bau_ut->ID])}}">
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



<div class="modal modal-warning fade" id="Huyduyet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">Xác Nhận Hủy Duyệt</h4>
      </div>
      <form action="{{route('huyduyet_bau.update','test')}}" method="post">
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
          <button type="submit" class="btn btn-danger">Có</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal modal-success fade" id="Duyet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">Xác Nhận Duyệt</h4>
      </div>
      <form action="{{route('duyet_bau.update','test')}}" method="post">
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
          <button type="button" class="btn btn-warning" data-dismiss="modal">Không</button>
          <button type="submit" class="btn btn-info">Có</button>
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
      <form action="{{route('huyduyet_bau.destroy','test')}}" method="post">
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
</script>


@endsection