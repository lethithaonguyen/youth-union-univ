<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('template/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('template/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{asset('template/bower_components/jvectormap/jquery-jvectormap.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('template/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="{{asset('template/dist/css/skins/_all-skins.min.css')}}">
   <!-- DataTable -->
   <link rel="stylesheet" href="{{asset('template/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

   <!-- iCheck for checkboxes and radio inputs -->
   <link rel="stylesheet" href="{{asset('template/plugins/iCheck/all.css')}}">


   <!-- DataTables -->
   <link rel="stylesheet" href="{{asset('template/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<style>
/*a {
  color: black !important;
  }*/
  td{
    text-align: center; !important;
  }

  th{
    text-align: center; !important;
  }
</style>
<!-- định dạng cho biểu đồ -->
<style type="text/css">
  
  .highcharts-figure, .highcharts-data-table table {
    min-width: 310px; 
    max-width: 800px;
    margin: 1em auto;
}

#container {
    height: 400px;
}

.highcharts-data-table table {
  font-family: Verdana, sans-serif;
  border-collapse: collapse;
  border: 1px solid #EBEBEB;
  margin: 10px auto;
  text-align: center;
  width: 100%;
  max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
  font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

</style>

   

   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet"
href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<!-- thanh cuộn  -->
<style type="text/css">
  #noidung{
    overflow : auto;

  }


  .dropbtn {
  background-color: #3498DB;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
  background-color: #2980B9;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;}
</style>




<!-- sử dụng ajax -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
     @include('layout.header')
   </header>
   <!-- Left side column. contains the logo and sidebar -->
   <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    @include('layout.sidebar')
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" >
      @yield('link_content')
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">@yield('head_content')</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-wrench"></i></button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#">Action</a></li>
                      <li><a href="#">Another action</a></li>
                      <li><a href="#">Something else here</a></li>
                      <li class="divider"></li>
                      <li><a href="#">Separated link</a></li>
                    </ul>
                  </div>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                @yield('content')
              </div>
              <!-- ./box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->



      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    @include('layout.footer')
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->

      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
   immediately after the control sidebar -->
   <div class="control-sidebar-bg"></div>

 </div>
 <!-- ./wrapper -->

 <!-- jQuery 3 -->
 <script src="{{asset('template/bower_components/jquery/dist/jquery.min.js')}}"></script>
 <!-- Bootstrap 3.3.7 -->
 <script src="{{asset('template/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
 <!-- FastClick -->
 <script src="{{asset('template/bower_components/fastclick/lib/fastclick.js')}}"></script>
 <!-- AdminLTE App -->
 <script src="{{asset('template/dist/js/adminlte.min.js')}}"></script>
 <!-- Sparkline -->
 <script src="{{asset('template/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
 <!-- jvectormap  -->
 <script src="{{asset('template/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
 <script src="{{asset('template/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
 <!-- SlimScroll -->
 <script src="{{asset('template/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
 <!-- ChartJS -->
 <script src="{{asset('template/bower_components/chart.js/Chart.js')}}"></script>
 <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
 <script src="{{asset('template/dist/js/pages/dashboard2.js')}}"></script>
 <!-- AdminLTE for demo purposes -->
 <script src="{{asset('template/dist/js/demo.js')}}"></script>
 <!--  sweetalert -->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
 <script src="sweetalert2.all.min.js"></script>
 <!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
 <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
 <!-- bootstrap_notify -->
 <!--  <script src="bootstrap-notify-master/bootstrap-notify.js"></script> -->


 <!-- DataTables -->
 <script src="{{asset('template/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
 <script src="{{asset('template/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
 <script src="https://cdn.datatables.net/plug-ins/1.10.20/i18n/Vietnamese.json"></script>

 <!-- iCheck 1.0.1 -->
 <script src="{{asset('template/plugins/iCheck/icheck.min.js')}}"></script>

 @stack('js')
 <script type="text/javascript">
  function checkbox_is_checked() {
    if ($(".check-all:checked").length > 0)
    {
      $("#bulk-delete").show();
    }
    else
    {
      $("#bulk-delete").hide();
    }
  }


  $(function () {
    $("#selectall").click(function () {
      if ($("#selectall").is(':checked')) {
        $("input[type=checkbox]").each(function () {
          $(this).attr("checked", true);
        });
        $("#bulk-delete").show();

      } else {
        $("input[type=checkbox]").each(function () {
          $(this).attr("checked", false);
        });
        $("#bulk-delete").hide();
      }
    });
  });


  $('#bulk-delete').on('click', function(e){
  //console.log($('#xoanhieuForm').find('input[name=id[]]').val());
  e.preventDefault();


  Swal.fire({
    title: 'Bạn có chắc không?',
    text: 'Bạn sẽ không thể phục hồi dữ liệu này!',
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Đồng ý, xóa luôn!',
    cancelButtonText: 'Không, giữ lại'
  }).then((result) => {
    if (result.value) {
      Swal.fire(
        'Đã xóa!',
        'Dữ liệu của bạn đã xóa thành công.',
        'success'
        );$("#xoanhieuForm").submit();
  // For more information about handling dismissals please visit
  // https://sweetalert2.github.io/#handling-dismissals
} else if (result.dismiss === Swal.DismissReason.cancel) {
  Swal.fire(
    'Đã hủy lệnh',
    'Dữ liệu bạn an toàn :)',
    'error'
    )
}
});
})
</script>


<script type="text/javascript">
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
    })
  })

</script>
<script>
  $("#success-alert").fadeTo(1000, 5000).slideUp(1500, function(){
    $("#success-alert").alert('close');
  });
</script>


<script>
  $(function () {

    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
  })
</script>


<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>


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
@yield ('script')
</body>
</html>
