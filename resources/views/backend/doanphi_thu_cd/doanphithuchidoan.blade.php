@extends('layout.app')

@section('head_content')
DANH SÁCH ĐOÀN PHÍ THU CHI ĐOÀN

@endsection
@section('link_content')
<h1>
  QUẢN LÝ ĐOÀN PHÍ THU CHI ĐOÀN
  <small>                
    <a href="{{route('phuong_xa.create')}}" class="btn btn-success">
      <span aria-hidden="true" style="font-family: Arial;">Thêm mới</span>
    </a>
  </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Danh sách đoàn phí thu chi đoàn</li>
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
        <form method="get" action="" >
         <label class="col-md-2 control-label">Chọn Năm học</label>
         <div class="col-md-4">
          <select class="form-control" name="namhoc" id="namhoc">
            @foreach($nh as $val)
            <option @if($tndp->NAMHOC_ID == $val->ID ) selected @endif value="{{$val->ID}}">{{$val->TEN_NH}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-2 control-label">
          <button type='submit' class="btn btn-info"> Liệt kê </button>
          <!--       <a href="{{route('doanphithu_index')}}"><span> <i class="fa fa-repeat"></i></span></a> -->
        </div>
      </form>
      <form method="post" action="">
        {!! csrf_field() !!}
        <table class="table" border="0" style="border-color: gray"  >
          <thead>
            <tr>
              <th id="blank">&nbsp;</th>
              @foreach($tn as $thangnam)
              <th id="co1" headers="blank">{{$thangnam->THANGNAM}}</th>
              @endforeach
              <th>Số tháng đóng</th>
            </tr>
          </thead>
          <tbody>
            @foreach($cd as $chidoan)
            <tr>
              <th id="c1" headers="blank">{{$chidoan->TEN_CD}}-{{$chidoan->TEN_KHOA}}</th>
              <?php $dem=0;?>
              @foreach($dp as $doanphi)
              <td>

                <?php 
                $h = '<input type="checkbox" '; 
                ?>

                <?php
                foreach($dp_t_cd as $doanphi_thu_cd){
                  if($doanphi_thu_cd->CHIDOAN_ID == $chidoan->ID && $doanphi_thu_cd->THANGNAM_ID == $doanphi->ID && $doanphi_thu_cd->dadong == 1){
                    $h = $h. ' checked ';
                    $dem = $dem + 1; 
                    break;
                  }

                }

                ?>
         <!-- @foreach($dpt as $doanphithu)
        //  @if($doanphithu->sinhvien_id == $sinhvien->id && $doanphithu->thangnam_id == $doanphi->id && $doanphithu->dadong == 1){
         // checked
        //  $dem=$dem+1; }
        //  @endif
         // @endforeach
       -->
       <?php $h = $h . 'name="doanphi['.$chidoan->ID.']['. $doanphi->ID.']">';
       echo $h;?>
<!--
          <input type="checkbox" 
          @foreach($dpt as $doanphithu)
          @if($doanphithu->sinhvien_id == $sinhvien->id && $doanphithu->thangnam_id == $doanphi->id && $doanphithu->dadong == 1)
          checked
          @endif
          @endforeach
          name="doanphi[{{$sinhvien->id}}][{{ $doanphi->id }}]">
        -->
        <!--               <input type="hidden" name="thangnamdp" value="{{ $doanphi->id }}">   -->

      </td>
      @endforeach
      <td> <?php echo $dem;?>     </td>
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


</div>
</div>
</div>


@endsection

