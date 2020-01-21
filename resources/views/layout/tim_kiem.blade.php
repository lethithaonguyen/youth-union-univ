
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
    <form role="form" method="get" action="{{route('get_thongtin')}}" enctype="multipart/form-data">
     {{ csrf_field() }}

     <!-- /.card-body -->

     <div class="box-body"  >
      @if(Session::get('session_vt') == 1 || Session::get('session_vt') == 2 || Session::get('session_vt') == 3 )

      <div class="form-group col-md-2" style="width: 20%">
        <br>
        <label for="sinhvien">Tên sinh viên</label>  
        <input type="text" name="sinhvien" id="sinhvien" class="form-control col-md-4" placeholder="Enter Country Name" />
        <div id="sinhvien_list"></div>
      </div>




      <div class="form-group col-md-2" style="width: 20%">
        <br>
        <label for="tenphai">Phái</label>
        
        <select class="form-control col-md-4" id="tenphai" name="tenphai">
          <option value="" >--Chọn giới tính--</option>
          <option value="1">Nam</option>
          <option value="2">Nữ</option>
        </select>
        
      </div>

     <div class="form-group col-md-2" style="width: 20%">
       <br>
       <label for="doankhoa">Tên đoàn khoa</label>
       <input class="form-control col-md-4 "  id="doankhoa" name="doankhoa" placeholder="Nhập tên đoàn khoa" type="text">
       <div id="doankhoa_list"></div>
     </div>

      <div class="form-group col-md-2" style="width: 20%">
       <br>
       <label for="tendantoc">Tên chi đoàn</label>
       <input class="form-control col-md-4 "  id="tendantoc" name="tendantoc" placeholder="Nhập tên chi đoàn" type="text">
     </div>



     <div class="form-group col-md-2" style="width: 20%">
       <br>
       <label for="tendantoc">Tên khóa</label>
       <input class="form-control col-md-4 "  id="tendantoc" name="tendantoc" placeholder="Nhập khóa" type="text">
     </div>

     <div class="box-footer" style="text-align: center;">

       <button  class="btn btn-success"> Tìm kiếm </button>
     </div>


     @endif
   </div>
 </form>
</div>
</div>
</div>
<script>
  $(document).ready(function(){

   $('#doankhoa').keyup(function(){ //bắt sự kiện keyup khi người dùng gõ từ khóa tim kiếm
    var query = $(this).val(); //lấy gía trị ng dùng gõ
    if(query != '') //kiểm tra khác rỗng thì thực hiện đoạn lệnh bên dưới
    {
     var _token = $('input[name="_token"]').val(); // token để mã hóa dữ liệu
     $.ajax({
      url:"{{ route('get_timkiem') }}", // đường dẫn khi gửi dữ liệu đi 'search' là tên route mình đặt bạn mở route lên xem là hiểu nó là cái j.
      method:"POST", // phương thức gửi dữ liệu.
      data:{query:query, _token:_token},
      success:function(data){ //dữ liệu nhận về
       $('#sinhvien_list').fadeIn();  
       $('#sinhvien_list').html(data); //nhận dữ liệu dạng html và gán vào cặp thẻ có id là sinhvien_list
     }
   });
   }
 });

   $(document).on('click', 'li', function(){  
    $('#sinhvien').val($(this).text());  
    $('#sinhvien_list').fadeOut();  
  });  

});
</script>
<script>
  $(document).ready(function(){

   $('#sinhvien').keyup(function(){ //bắt sự kiện keyup khi người dùng gõ từ khóa tim kiếm
    var query = $(this).val(); //lấy gía trị ng dùng gõ
    if(query != '') //kiểm tra khác rỗng thì thực hiện đoạn lệnh bên dưới
    {
     var _token = $('input[name="_token"]').val(); // token để mã hóa dữ liệu
     $.ajax({
      url:"{{ route('get_timkiem_dk') }}", // đường dẫn khi gửi dữ liệu đi 'search' là tên route mình đặt bạn mở route lên xem là hiểu nó là cái j.
      method:"POST", // phương thức gửi dữ liệu.
      data:{query:query, _token:_token},
      success:function(data){ //dữ liệu nhận về
       $('#doankhoa_list').fadeIn();  
       $('#doankhoa_list').html(data); //nhận dữ liệu dạng html và gán vào cặp thẻ có id là doankhoa_list
     }
   });
   }
 });

   $(document).on('click', 'li', function(){  
    $('#doankhoa').val($(this).text());  
    $('#doankhoa_list').fadeOut();  
  });  

});
</script>
@endsection