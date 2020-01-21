
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

     <div class="box-body"  >
      @if(Session::get('session_vt') == 1 || Session::get('session_vt') == 2 || Session::get('session_vt') == 3 )

      <div class="form-group col-md-2" style="width: 20%">
        <br>
        <label for="country_name">Tên sinh viên</label>  
        <input type="text" name="country_name" id="country_name" class="form-control col-md-4" placeholder="Enter Country Name" />
        <div id="countryList"></div>
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
       <label for="tendantoc">Tên chi đoàn</label>
       <input class="form-control col-md-4 "  id="tendantoc" name="tendantoc" placeholder="Nhập tên chi đoàn" type="text"  required>
     </div>

     <div class="form-group col-md-2" style="width: 20%">
       <br>
       <label for="tendantoc">Tên đoàn khoa</label>
       <input class="form-control col-md-4 "  id="tendantoc" name="tendantoc" placeholder="Nhập tên đoàn khoa" type="text"  required>
     </div>

     <div class="form-group col-md-2" style="width: 20%">
       <br>
       <label for="tendantoc">Tên khóa</label>
       <input class="form-control col-md-4 "  id="tendantoc" name="tendantoc" placeholder="Nhập khóa" type="text"  required>
     </div>

     <div class="box-footer" style="text-align: center;">

       <button  class="btn btn-success"><a href="" style="color: white; text-align: center;"> Tìm kiếm </a></button>
     </div>


     @endif
   </div>
</form>
</div>
</div>
</div>
{{-- <script>
    $('input[name=checkSuaMaTT]').change(function(){
    if($(this).is(':checked')) {
      $("#idTT").attr("disabled", false);
      // $("#kyBaoCao").valid();
      // $('#addKy').attr("disabled", false);
    } else {
      // $("#maKy").attr("disabled", true);
      // $('#addKy').attr("disabled", true);
    }
  });
</script> --}}
<script>
  $(document).ready(function(){

   $('#country_name').keyup(function(){ //bắt sự kiện keyup khi người dùng gõ từ khóa tim kiếm
    var query = $(this).val(); //lấy gía trị ng dùng gõ
    if(query != '') //kiểm tra khác rỗng thì thực hiện đoạn lệnh bên dưới
    {
     var _token = $('input[name="_token"]').val(); // token để mã hóa dữ liệu
     $.ajax({
      url:"{{ route('gettimkiem') }}", // đường dẫn khi gửi dữ liệu đi 'search' là tên route mình đặt bạn mở route lên xem là hiểu nó là cái j.
      method:"POST", // phương thức gửi dữ liệu.
      data:{query:query, _token:_token},
      success:function(data){ //dữ liệu nhận về
       $('#countryList').fadeIn();  
       $('#countryList').html(data); //nhận dữ liệu dạng html và gán vào cặp thẻ có id là countryList
     }
   });
   }
 });

   $(document).on('click', 'li', function(){  
    $('#country_name').val($(this).text());  
    $('#countryList').fadeOut();  
  });  

 });
</script>
@endsection