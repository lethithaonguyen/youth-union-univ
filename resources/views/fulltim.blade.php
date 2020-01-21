
@extends('layout.app')

@section('head_content')
@if(Session::get('session_vt') != 4)
TÌM KIẾM THÔNG TIN
@endif
@endsection
@section('link_content')
@if(Session::get('session_vt') != 4)
<h1>
  QUẢN LÝ THÔNG TIN

</h1>
@endif
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  @if(Session::get('session_vt') != 4)
  <li class="active">Tìm kiếm thông tin</li>
  @endif
</ol>
@endsection

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
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
    <form role="form" method="get" action="" enctype="multipart/form-data">
     {{ csrf_field() }}

     <div class="container">
      <br>
      <h3 align="center">Doan vien thanh nien</h3>
      <br>
      <div class="row">
        <div class="col-md-10">
          <input type="text" name="sinhvien" id="sinhvien" class="form-control" placeholder="Search" value="">
        </div>
        <div class="col-md-2">
          @csrf
          <button type="button" name="search" id="seach" class="btn btn-success">Search</button>
        </div>
        
      </div>
      <br>
      <div class="table-responsive">
        <table class="table table-bordered table-triped">
          <thead>
            <tr>
              <th>Ten sv</th>
              <th>Ten sv</th>
              <th>Ten sv</th>

            </tr>
          </thead>
          <tbody>
            @foreach($sv as $sinhvien)
            <tr>
              <td>{{$sinhvien->TEN_SV}}</td>
              <td>{{$sinhvien->DIACHI_SV}}</td>
              <td>{{$sinhvien->MSSV}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        
      </div>
    </div>
  </form>
</div>
</div>
</div>
<script>
  $(document).ready(function(){
    load_data (''); 
    function load_data(sinhvien_query = ''){
      var _token = $('input[name="_token"]').val();
      $.ajax({
      url:"{{ route('get_fulltim') }}", // đường dẫn khi gửi dữ liệu đi 'search' là tên route mình đặt bạn mở route lên xem là hiểu nó là cái j.
      method:"POST", // phương thức gửi dữ liệu.
      data:{sinhvien_query:sinhvien_query, _token:_token},
      dataType: "json",
      success:function(data){ //dữ liệu nhận về
        var output = '';
        if(data.length > 0){
          for(var count = 0 ; count < data.length; count++)
          {
            output += '<tr>';
            output += '<td>'+data[count].Ten_SV+'</td>';
            output += '<td>'+data[count].DIACHI_SV+'</td>';
            output += '<td>'+data[count].MSSV+'</td>';
            // output += '<td>'+data[count].Ten_SV+'</td>';
            output += '</tr>'
          }
        }
        else{
         output += '<tr>';
         output += '<td colspan = "3">No data</td>';
            // output += '<td>'+data[count].Ten_SV+'</td>';
            output += '</tr>'
          }
          $('tbody').html(output);
        }
      });
    }
    $('#search').click(function(){
var sinhvien_query = $('#sinhvien').val();
load_data(sinhvien_query);
    });
  });
</script>
@endsection