 
@extends('layout.app')

@section('head_content')
DANH SÁCH QUYẾT ĐỊNH KHEN THƯỞNG - KỶ LUẬT @if(Session::get('session_vt')==3)<b>{{Session::get('session_ten_chidoan_sv')}}-{{Session::get('session_ten_khoa_sv')}}</b>@elseif(Session::get('session_vt')==2)<b>{{Session::get('session_ten_doankhoa')}}</b>@endif

@endsection
@section('link_content')

<h1>
  QUẢN LÝ QUYẾT ĐỊNH KHEN THƯỞNG - KỶ LUẬT
  @if(Session::get('session_vt')==3)
  <small>                
    <a href="{{route('chitiet_ktkl.create')}}" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
  @endif
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách quyết định khen thưởng - kỷ luật</li>
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
     <form action="{{ route('ct_chucvu_dv.bulkDeleteCT_CV_DV') }}" method="POST" id="xoanhieuForm">
      {!! csrf_field() !!}

      <table class="table table-bordered table-striped dataTable" id="example1" role="grid" aria-describedby="example1_info" >
        <thead>
          <tr role="row" >
            <th style="text-align: center;">STT</th>
            <th style="text-align: center;">Đoàn viên được khen thưởng - kỷ luật</th>
            <th style="text-align: center;">Tên khen thưởng - kỷ luật</th>
            <th style="text-align: center;">Nội dung khen thưởng - kỷ luật</th>
            <th style="text-align: center;">Ngày khen thưởng - kỷ luật</th>
            <th style="text-align: center;">Chi đoàn - khóa</th>
            <th style="text-align: center;">Đoàn khoa</th>
            <th style="text-align: center;">Trạng thái</th>
            @if(Session::get('session_vt')==2)
            <th style="text-align: center;" >Thao tác</th>
            @endif
            @if(Session::get('session_vt')==3)
            <th style="text-align: center;" >Thao tác</th>
            <th style="text-align: center;" >Thao tác</th>
            @endif

          </tr>
        </thead>
        <?php
        $stt=1;
        ?> 
        <tbody>  
          @foreach($ct_ktkl as $chitiet_ktkl)          
          <tr class="odd" role="row">
            <td class="sorting_1">{{$stt++}}</td>
            <td>{{$chitiet_ktkl->TEN_SV}}</td>
            <td>{{$chitiet_ktkl->TEN_KTKL}}</td>
            <td>{{$chitiet_ktkl->NOIDUNG_KTKL}}</td>
            <td>{{\Carbon\Carbon::parse($chitiet_ktkl->NGAYBATDAU)->format('d/m/Y')}}</td>
            <td>{{$chitiet_ktkl->TEN_CD}}-{{$chitiet_ktkl->TEN_KHOA}}</td>
            <td>{{$chitiet_ktkl->TEN_DK}}</td>
            
            @if($chitiet_ktkl->DUYET_KTKL == NULL)
            <td style="text-align: center;"><span class="label label-danger">Chưa duyệt</span></td>
            @if(Session::get('session_vt')==2)
            <td align="center">

              <button type="button" class="btn bg-teal btn-flat" data-catid="{{$chitiet_ktkl->ID}}" data-toggle="modal" data-target="#Duyet"><i class="glyphicon glyphicon-ok"></i> Duyệt</button>
            </td>
            @endif
            @if(Session::get('session_vt')==3)
            <td>
              <button class="btn btn-danger" data-catid="{{$chitiet_ktkl->ID}}" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> Xóa</button>
            </td>
            <td>
              <a href="{{ route('chitiet_ktkl.edit',['chitiet_ktkl'=>$chitiet_ktkl->ID])}}">
                <button style="width:100%" type="button" class="btn btn-block btn-info">Sửa <span class=" glyphicon glyphicon-pencil"></span>            
                </button>
              </a>
            </td>

            @endif
            @else
            <td style="text-align: center;"><span class="label label-success">Đã duyệt</span></td>
            @if(Session::get('session_vt')==2)
            <td align="center">
              <button  type="button" class="btn bg-purple btn-flat margin" data-catid="{{$chitiet_ktkl->ID}}" data-toggle="modal" data-target="#Huyduyet"><i class="glyphicon glyphicon-remove"></i> Hủy duyệt</button>
            </td>
            @endif
            @if(Session::get('session_vt')==3)
            <td>
              <button class="btn btn-danger" data-catid="{{$chitiet_ktkl->ID}}" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> Xóa</button>
            </td>
            <td>
              <a href="{{ route('chitiet_ktkl.edit',['chitiet_ktkl'=>$chitiet_ktkl->ID])}}">
                <button style="width:100%" type="button" class="btn btn-block btn-info">Sửa <span class=" glyphicon glyphicon-pencil"></span>            
                </button>
              </a>

            </td>
            @endif
            @endif
          </tr>
          @endforeach
        </tbody>
      </table>
    </form>
  </div>
</div>
</div>
<!-- /.box-body -->



<div class="modal modal-danger fade" id="Huyduyet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">Xác Nhận Hủy Duyệt</h4>
      </div>
      <form action="{{route('huyduyet_ktkl.update','test')}}" method="post">
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
      <form action="{{route('duyet_ktkl.update','test')}}" method="post">
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
      <form action="{{route('huyduyet_ktkl.destroy','test')}}" method="post">
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