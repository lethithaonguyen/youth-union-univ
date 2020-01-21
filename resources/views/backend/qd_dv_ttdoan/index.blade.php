 
@extends('layout.app')

@section('head_content')
DANH SÁCH QUYẾT ĐỊNH TRƯỞNG THÀNH ĐOÀN @if(Session::get('session_vt')==2) CỦA ĐOÀN KHOA <b>{{Session::get('session_ten_doankhoa')}}</b>
@elseif(Session::get('session_vt')==3) CỦA CHI ĐOÀN <b>{{Session::get('session_ten_chidoan_sv')}}
  @endif 

  @endsection
  @section('link_content')

  <h1>
    QUẢN LÝ QUYẾT ĐỊNH TRƯỞNG THÀNH ĐOÀN
    @if(Session::get('session_vt')==2)
    <small>                
      <a href="{{route('qd_dv_ttdoan.index_getchidoan_tt')}}" class="btn btn-success">
        <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
      </a>
    </small>
    @endif
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Danh sách quyết định trưởng thành đoàn</li>
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
    <form method="get" action="{{route('loc_ttdoan')}}" >
      <div class="form-group col-md-6">
        <label for="doankhoa">Đoàn khoa</label>
        <div class="col-3">
          <select class="form-control" name="doankhoa" id="doankhoa">
            @foreach($dk as $doankhoa)
            <option @if($dk_l->ID == $doankhoa->ID ) selected @endif value="{{$doankhoa->ID}}">{{$doankhoa->TEN_DK}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group col-md-6">
        <label for="khoa">Khóa</label>
        <div class="col-3">
          <select class="form-control" name="khoa" id="khoa">
            @foreach($k as $khoa)
            <option @if($k_l->ID == $khoa->ID ) selected @endif value="{{$khoa->ID}}">{{$khoa->TEN_KHOA}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="control-label" style="text-align: center;">
        <button type='submit' class="btn btn-info"> Liệt kê </button>
      </div>
    </form>
    <br>
    <div class="row">

      <div class="col-sm-12">
        {!! csrf_field() !!}

        <table class="table table-bordered table-striped dataTable" id="example1" role="grid" aria-describedby="example1_info" >
          <thead>
            <tr role="row" >
              <th style="text-align: center;">STT</th>
              <!-- <th style="text-align: center;">Đoàn viên lập danh sách</th> -->
              <th style="text-align: center;">Đoàn viên được trưởng thành đoàn</th>
              <th style="text-align: center;">Đoàn khoa</th>
              <th style="text-align: center;">Chi đoàn - khóa</th>
              <th style="text-align: center;">Ngày trưởng thành đoàn</th>
              <th style="text-align: center;">Trạng thái</th>
              @if(Session::get('session_vt')==1)
              <th style="text-align: center;" >Thao tác</th>
              @endif
              @if(Session::get('session_vt')==2)
              <th style="text-align: center;" >Thao tác</th>
              <th style="text-align: center;" >Thao tác</th>
              @endif
            </thead>
            <?php
            $stt=1;
            ?> 
            <tbody>  
              @foreach($qd_dv_tt as $qd_dv_ttdoan)          
              <tr class="odd" role="row">
                <td class="sorting_1">{{$stt++}}</td>
                <td>{{$qd_dv_ttdoan->TEN_SV}}</td>
                <td>{{$qd_dv_ttdoan->TEN_DK}}</td>
                <td>{{$qd_dv_ttdoan->TEN_CD}}-{{$qd_dv_ttdoan->TEN_KHOA}}</td>
                <td>{{\Carbon\Carbon::parse($qd_dv_ttdoan->NGAYTTDOAN)->format('d/m/Y')}}</td>
                @if($qd_dv_ttdoan->DUYET_TTD == NULL)
                <td style="text-align: center;"><span class="label label-danger">Chưa duyệt</span></td>
                @if(Session::get('session_vt')==1)
                <td align="center">

                  <button type="button" class="btn bg-teal btn-flat" data-catid="{{$qd_dv_ttdoan->ID}}" data-toggle="modal" data-target="#Duyet"><i class="glyphicon glyphicon-ok"></i> Duyệt</button>
                </td>
                @endif
                @if(Session::get('session_vt')==2)
                <td>
                  <button class="btn btn-danger" data-catid="{{$qd_dv_ttdoan->ID}}" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> Xóa</button>
                </td>
                <td>
                  <a href="{{ route('qd_dv_ttdoan.edit',['qd_dv_ttdoan'=>$qd_dv_ttdoan->ID])}}">
                    <button style="width:100%" type="button" class="btn btn-block btn-info">Sửa <span class=" glyphicon glyphicon-pencil"></span>            
                    </button>
                  </a>
                </td>
                @endif
              </td>
              @else
              <td style="text-align: center;"><span class="label label-success">Đã duyệt</span></td>
              @if(Session::get('session_vt')==1)
              <td align="center">
                <button  type="button" class="btn bg-orange btn-flat " data-catid="{{$qd_dv_ttdoan->ID}}" data-toggle="modal" data-target="#Huyduyet"><i class="glyphicon glyphicon-remove"></i> Hủy duyệt</button>
              </td>
              @endif
              @if(Session::get('session_vt')==2)
              <td>
                <button class="btn btn-danger" data-catid="{{$qd_dv_ttdoan->ID}}" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> Xóa</button>
              </td>
              <td>
                <a href="{{ route('qd_dv_ttdoan.edit',['qd_dv_ttdoan'=>$qd_dv_ttdoan->ID])}}">
                  <button style="width:100%" type="button" class="btn btn-block btn-info">Sửa <span class=" glyphicon glyphicon-pencil"></span>            
                  </button>
                </a>

              </td>
              @endif
              @endif
           <!--  <td>
              <div style="width:100%" class="btn-group">
                <a href="{{ route('qd_dv_ttdoan.edit',['qd_dv_ttdoan'=>$qd_dv_ttdoan->ID])}}">
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
      <form action="{{route('huyduyet_tt.update','test')}}" method="post">
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
      <form action="{{route('duyet_tt.update','test')}}" method="post">
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
      <form action="{{route('huyduyet_tt.destroy','test')}}" method="post">
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