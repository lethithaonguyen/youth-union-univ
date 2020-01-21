 <!-- Logo -->
 <a href="{{route('trangchu')}}" class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><img src="{{asset('hinh_luanvan/logo-Doan.png')}}" width="500%"></span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"><img src="{{asset('hinh_luanvan/logo-Doan.png')}}" ><img src="{{asset('hinh_luanvan/logo-HSV.png')}}" ></span>
</a>

<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
    <span class="sr-only">Toggle navigation</span>   
  </a>

<!-- Navbar Right Menu -->
<div class="navbar-custom-menu">

  <ul class="nav navbar-nav">

    <li class="dropdown tasks-menu">


      <ul class="dropdown-menu">

        <li>

          <ul class="menu">

            <li><!-- Task item -->
              <a href="#">
                <h3>
                  Some task I need to do
                  <small class="pull-right">60%</small>
                </h3>
                <div class="progress xs">
                  <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar"
                  aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                  <span class="sr-only">60% Complete</span>
                </div>
              </div>
            </a>
          </li>
          <!-- end task item -->
          <li><!-- Task item -->
            <a href="#">
              <h3>
                Make beautiful transitions
                <small class="pull-right">80%</small>
              </h3>
              <div class="progress xs">
                <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar"
                aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                <span class="sr-only">80% Complete</span>
              </div>
            </div>
          </a>
        </li>
        <!-- end task item -->
      </ul>
    </li>
    <li class="footer">
      <a href="#">View all tasks</a>
    </li>
  </ul>
</li>

<!-- User Account: style can be found in dropdown.less -->
<li class="dropdown user user-menu">

  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    {{--     <img src="{{asset('template/dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image" width="20px"> --}}
    @if(Session::get('session_phai_sv') == 1)
    <img src="{{asset('hinh_luanvan/male.png')}}" class="user-image" alt="User Image" width="60px">
    @else
    <img src="{{asset('hinh_luanvan/female.png')}}" class="user-image" alt="User Image" width="60px">
    @endif
    <span class="hidden-xs">
      {{ Session::get('session_ten_sv') }} ({{ Session::get('session_mssv_sv') }})
    </span>
  </a>

  <ul class="dropdown-menu">

    <li class="user-header">
      @if(Session::get('session_phai_sv') == 1)
      <img src="{{asset('hinh_luanvan/male.png')}}" class="img-circle" alt="User Image">
      @else
      <img src="{{asset('hinh_luanvan/female.png')}}" class="img-circle" alt="User Image">
      @endif
      {{-- <small>{{ Session::get('session_id_chidoan_sv') }}</small> --}}
      <p>
        {{ Session::get('session_ten_sv') }} ({{ Session::get('session_mssv_sv') }})
        <small><b>Quyền - {{ Session::get('session_ten_vt') }}@if(Session::get('session_vt') != 1 &&Session::get('session_vt') != 2) - chi đoàn {{ Session::get('session_ten_chidoan_sv') }}@elseif(Session::get('session_vt') == 2) {{Session::get('session_ten_doankhoa')}}@endif</b></small>

        <small>Được tạo - {{ Session::get('session_ngay') }}</small>

        {{--        <small>{{ Session::get('session_id_chidoan_sv') }}</small> --}}

      </p>
    </li>
    <!-- Menu Footer-->
    <li class="user-footer">
      <div class="pull-left">
        <a href="{{route('thongtinsinhvien')}}" class="btn btn-default btn-flat">Thông tin cá nhân</a>
      </div>
      <div class="pull-right">
        <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Đăng xuất</a>
      </div>
    </li>
  </ul>
</li>
<!-- Control Sidebar Toggle Button -->
<li>
  <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
</li>
</ul>
</div>

</nav>