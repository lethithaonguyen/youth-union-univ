 
@extends('layout.app')

@section('head_content')
DANH SÁCH CHI ĐOÀN @if(Session::get('session_vt')==2){{Session::get('session_ten_doankhoa')}}@elseif(Session::get('session_vt')==3){{Session::get('session_ten_chidoan_sv')}}-{{Session::get('session_ten_khoa_sv')}}@endif

@endsection

@section('link_content')

<h1>
  QUẢN LÝ CHI ĐOÀN @if(Session::get('session_vt')==2){{Session::get('session_ten_doankhoa')}}@endif
  @if(Session::get('session_vt')==2)
  <small>                
    <a href="{{route('chidoan.create')}}" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
  @endif
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách chi đoàn</li>
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
<!-- import-export -->
@if(Session::get('session_vt')==2)
<div class="card-body">
  <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" class="form-control">
    <br>
    <button class="btn btn-success">Nhập file excel</button>
    <a class="btn btn-warning" href="{{ route('export') }}">Xuất file excel</a>
  </form>
</div>
@endif
<!-- end import-export -->




<!-- /.box-header -->
<div class="box-body">
  @if(Session::get('session_vt')==2)
  <form method="get" action="{{route('loc_chidoan')}}">
{{--     <label class="col-md-2 control-label">Chọn khóa</label>
    <div class="col-md-4">
      <select class="form-control" name="khoa" id="khoa" required>
        @foreach($k as $khoa)
        <option value="{{$khoa->ID}}">{{$khoa->TEN_KHOA}}</option>
        @endforeach
      </select>
    </div>

    <div class="col-md-2 control-label">
      <button type='submit' class="btn btn-info"> Liệt kê </button>
    </div> --}}

            <label class="col-md-2 control-label" for="khoa">Chọn Khóa</label>
            <div class="col-md-4">
              <select class="form-control" name="khoa" id="khoa">
                @foreach($k as $khoa)
                <option @if($k_l->ID == $khoa->ID ) selected @endif value="{{$khoa->ID}}">{{$khoa->TEN_KHOA}}</option>
                @endforeach
              </select>
            </div>

          <div class="control-label col-md-2" style="text-align: center;">
            <button type='submit' class="btn btn-info"> Liệt kê </button>
          </div>
        </form>
  <br><br><br><br>
  @endif
  <div class="row">
    <div class="col-sm-12">
      <!-- <form action="{{ route('chidoan.bulkDeleteCD') }}" method="POST" id="xoanhieuForm"> -->
        {!! csrf_field() !!}

        <table class="table table-bordered table-hover" id="example1">
          <thead>
            <tr role="row">
              <!-- <th><input type="checkbox"  id="selectall" class="checked" />Chọn</th> -->

              <th style="text-align: center;">STT</th>
              <th style="text-align: center;">Tên chi đoàn</th>
              <th style="text-align: center;">Tên đoàn khoa</th>
              <th style="text-align: center;">Tên khóa</th>
              <th style="text-align: center;">Ngày thành lập</th>
              <th style="text-align: center;">Trạng thái</th>
              @if(Session::get('session_vt')==2)
              <th style="text-align: center;">Thao tác</th>
              <th style="text-align: center;">Thao tác</th>
              <th style="text-align: center;">Thao tác</th>
              @endif
            </tr>
          </thead>
          <?php
          $stt=1;
          ?> 
          <tbody>  
            @foreach($cd as $chidoan)          
            <tr class="odd" role="row">
              <td class="sorting_1">{{$stt++}}</td>
              <td>{{$chidoan->TEN_CD}}
                <span  style=" float:right">(Có
                  <?php
                  $x = $chidoan->ID;
                  // dd($x);
                  $countnam = DB::table('doanvien_thanhnien')->where('CHIDOAN_ID' ,'=',$x)->where('PHAI_SV','=','1')->count();
                  // dd($countnam);
                  echo "<span style='color:red'>$countnam</span>" ;
                  ?> Nam và
                  <?php
                  $x = $chidoan->ID;
                  $countnu = DB::table('doanvien_thanhnien')->where('CHIDOAN_ID' ,'=',$x)->where('PHAI_SV','=', '2')->count();
                  //dd($countnu);
                  echo "<span style='color:red'>$countnu</span>" ;
                  ?> Nữ trong tổng gồm
                  <?php
                  $x = $chidoan->ID;
                  $countdoanvien_thanhnien = DB::table('doanvien_thanhnien')->where('CHIDOAN_ID' ,'=',$x)-> where('NOIVAODOAN_SV','!=',NULL)->where('NGAYCHUYENSH_SV','=',NULL)->count();

                  echo "<span style='color:red;font-weight:bold'>$countdoanvien_thanhnien</span>" ;
                  ?> Đoàn viên và
                  <?php
                  $x = $chidoan->ID;
                  $count_thanhnien = DB::table('doanvien_thanhnien')->where('CHIDOAN_ID' ,'=',$x)-> where('NOIVAODOAN_SV','=',NULL)->where('NGAYCHUYENSH_SV','=',NULL)->count();

                  echo "<span style='color:red;font-weight:bold'>$count_thanhnien</span>" ;
                  ?> Thanh niên
                )</span>
              </td>
              <td>{{$chidoan->TEN_DK}}</td>
              <td>{{$chidoan->TEN_KHOA}}</td>
              <td>{{\Carbon\Carbon::parse($chidoan->NGAY_THANHLAP)->format('d/m/Y')}}</td>
              @if($chidoan->DUYET_CD == NULL)
              <td style="text-align: center;"><span class="label label-success">Đang hoạt động</span></td>
              @if(Session::get('session_vt')==2)
              <td align="center">

                <button  type="button" class="btn bg-teal btn-flat " data-catid="{{$chidoan->ID}}" data-toggle="modal" data-target="#Duyet"><i class="glyphicon glyphicon-ok"></i>Cập nhật trạng thái</button>
              </td>
              <td>
                <button class="btn btn-danger" data-catid="{{$chidoan->ID}}" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> Xóa</button>
              </td>
              <td>
                <a href="{{ route('chidoan.edit',['chidoan'=>$chidoan->ID])}}">
                  <button style="width:100%" type="button" class="btn btn-block btn-info">Sửa <span class=" glyphicon glyphicon-pencil"></span>            
                  </button>
                </a>
              </td>
              @endif

            </td>
            @else
            <td style="text-align: center;"><span class="label label-danger">Ngưng hoạt động</span></td>
            @if(Session::get('session_vt')==2)
            <td align="center">
              <button  type="button" class="btn bg-orange btn-flat " data-catid="{{$chidoan->ID}}" data-toggle="modal" data-target="#Huyduyet"><i class="glyphicon glyphicon-remove"></i>Cập nhật trạng thái</button>
            </td>
            <td>
              <button class="btn btn-danger" data-catid="{{$chidoan->ID}}" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> Xóa</button>
            </td>
            <td>
              <a href="{{ route('chidoan.edit',['chidoan'=>$chidoan->ID])}}">
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
      <form action="{{route('huyduyet_cd.update','test')}}" method="post">
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
      <form action="{{route('duyet_cd.update','test')}}" method="post">
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
      <form action="{{route('huyduyet_cd.destroy','test')}}" method="post">
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