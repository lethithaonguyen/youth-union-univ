   <link rel="stylesheet" href="{{asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
   <!-- font awesome -->
   <link rel="stylesheet" href="{{asset('template/bower_components/font-awesome/css/font-awesome.min.css')}}">
   <!-- ionicons -->
   <link rel="stylesheet" href="{{asset('template/bower_components/ionicons/css/ionicons.min.css')}}">
   <!-- jvectormap -->
   <link rel="stylesheet" href="{{asset('template/bower_components/jvectormap/jquery-jvectormap.css')}}">
   <!-- theme style -->
   <link rel="stylesheet" href="{{asset('template/dist/css/adminlte.min.css')}}">
  <!-- adminlte skins. choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="{{asset('template/dist/css/skins/_all-skins.min.css')}}">
   <!-- datatable -->
   <link rel="stylesheet" href="{{asset('template/bower_components/datatables.net-bs/css/datatables.bootstrap.min.css')}}">

   <!-- icheck for checkboxes and radio inputs -->
   <link rel="stylesheet" href="{{asset('template/plugins/icheck/all.css')}}">
   <section class="sidebar">
    <!-- sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        @if(Session::get('session_phai_sv') == 1)
        <img src="{{asset('hinh_luanvan/male.png')}}" class="img-circle" alt="user image">
        @else
        <img src="{{asset('hinh_luanvan/female.png')}}" class="img-circle" alt="user image" height="1000px">
        @endif
      </div>
      <div class="pull-left info">
        <p style="color: black;"><small>{{ Session::get('session_ten_sv') }} ({{ Session::get('session_mssv_sv') }})</small></p>

        <a href="#"><i class="fa fa-circle text-success"></i><small><b>{{ Session::get('session_ten_vt') }} 
        @if(Session::get('session_vt') != 1 &&Session::get('session_vt') != 2){{ Session::get('session_ten_chidoan_sv') }}@elseif(Session::get('session_vt') == 2) {{Session::get('session_ten_doankhoa')}}@endif</b></small><p style="color: black;">Online</p></a>

      </div>
    </div>
    <!-- search form -->
{{--     <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="search...">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat">
            <i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </form> --}}
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">

      <li class="header">Danh mục quản lý</li>
      <li class="treeview">
        <a href="{{route('tim_kiem')}}">
          <i class="fa fa-home" style="color: #20B2AA"></i>
          <span>Trang chủ</span>
        </a>
      </li>

      @if(Session::get('session_vt') != 4)

      <li class="treeview">
        <a href="">
         <i class="fa fa-file-text-o" style="color: #00CD00;"></i><span>Quản lý thông tin</span>
         <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">

        @if(Session::get('session_vt') == 1)
        <li class="active"><a href="{{route('doankhoa.index')}}"><i class="fa fa-circle-o" style="color: #00CD00;"></i>Đoàn khoa</a>
          @elseif(Session::get('session_vt') == 2)
          <li class="active"><a href="{{route('doankhoa_view')}}"><i class="fa fa-circle-o" style="color: #00CD00;"></i>Đoàn khoa</a>
            @endif


            @if(Session::get('session_vt') == 2)
            <li class="active"><a href="{{route('index_doankhoa')}}"><i class="fa fa-circle-o" style="color: #00CD00;"></i>Chi đoàn</a>
              @elseif(Session::get('session_vt') == 3)
              <li class="active"><a href="{{route('index_chidoan')}}"><i class="fa fa-circle-o" style="color: #00CD00;"></i>Chi đoàn</a>
                @endif



                @if(Session::get('session_vt') == 1)
                <li class="active"><a href="{{route('doanvien_thanhnien.index_getchidoan')}}"><i class="fa fa-circle-o"></i>Đoàn viên-thanh niên</a>
                  @elseif(Session::get('session_vt') == 2)
                  <li class="active"><a href="{{route('doanvien_thanhnien.doankhoa_index_getchidoan')}}"><i class="fa fa-circle-o" style="color: #00CD00;"></i>Đoàn viên-thanh niên</a>
                    @elseif(Session::get('session_vt') == 3)
                    <li class="active" style="color: #00CD00;"><a href="{{route('doanvien_thanhnien.index_chidoan')}}"><i class="fa fa-circle-o"></i>Đoàn viên-thanh niên</a> 
                      @endif
                    </ul>
                  </li>

                  <li class="treeview">
                    <a href="#">
                      <i class="fa fa-money" aria-hidden="true" style="color: #66CD00;"></i>
                      <span>Đoàn phí thu - chi</span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                     <li class="treeview">
                      <a href="#">
                        <i class="fa fa-files-o" style="color: purple;"></i>
                        <span>Đoàn phí thu</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>
                      <ul class="treeview-menu">
                        @if(Session::get('session_vt') == 1)
                        <li><a href="{{route('doanphi_thu_dk.index')}}"><i class="fa fa-circle-o" style="color: purple;"></i> Đoàn khoa</a></li>
                        @endif
                        @if(Session::get('session_vt') == 2)
                        <li><a href="{{route('doanphi_thu_cd.index')}}"><i class="fa fa-circle-o" style="color: purple;"></i> Chi đoàn</a></li>
                        @endif
                        @if(Session::get('session_vt') == 3)
                        <li><a href="{{route('getdoanvien')}}"><i class="fa fa-circle-o" style="color: purple;"></i> Đoàn viên</a></li>
                        @endif
                      </ul>
                    </li>
                    <li class="treeview">
                      <a href="#">
                        <i class="fa fa-files-o "style="color: orange;"></i>
                        <span>Đoàn phí chi</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>
                      <ul class="treeview-menu">
                        @if(Session::get('session_vt') == 2)
                        <li><a href="{{route('phieuchi_dk.index')}}"><i class="fa fa-circle-o" style="color: orange;"></i> Đoàn khoa</a></li>
                        @endif
                        @if(Session::get('session_vt') == 3)
                        <li><a href="{{route('phieuchi_chi_cd.index')}}"><i class="fa fa-circle-o" style="color: orange;"></i> Chi đoàn</a></li>
                        @endif
                        @if(Session::get('session_vt') == 1)
                        <li><a href="{{route('loai_noidung_chi.index')}}"><i class="fa fa-circle-o" style="color: orange;"></i> Loại nội dung chi</a></li>
                        @endif
                      </ul>
                    </li>
                    @if(Session::get('session_vt') == 1 || Session::get('session_vt') == 2)
                    <li class="treeview">
                      <a href="#">
                        <img src="{{asset('hinh_luanvan/pie-chart_2.png')}}" width="20px">
                        <span>Thống kê thu-chi</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>
                      <ul class="treeview-menu">
                        @if(Session::get('session_vt') == 1)
                        <li><a href="{{route('thongke_thuchi_dk')}}"><i class="fa fa-circle-o"></i> Đoàn khoa</a></li>
                        @endif
                        @if(Session::get('session_vt') == 2)
                        <li><a href="{{route('thongke_thuchi_cd')}}"><i class="fa fa-circle-o"></i> Chi đoàn</a></li>
                        @endif
                      </ul>
                    </li>
                    @endif
                  </ul>
                </li>


                @if(Session::get('session_vt')==2 || Session::get('session_vt')== 3 ||Session::get('session_vt')== 1)
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-trophy" aria-hidden="true" style="color:orange;"></i>
                    <span>Khen thưởng-kỷ luật</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    @if(Session::get('session_vt')==2 || Session::get('session_vt')== 3)
                    <li><a href="{{route('chitiet_ktkl.index')}}"><i class="fa fa-circle-o"></i>Danh sách khen thưởng - kỷ luật</a></li>
                    @endif
                    @if(Session::get('session_vt')==3)
                    <li><a href="{{route('khenthuong_kyluat.index')}}"><i class="fa fa-circle-o"></i>
                    Quản lý khen thưởng - kỷ luật</a></li>
                    @endif
                    @if(Session::get('session_vt')==1)
                    <li><a href="{{route('loai_ktkl.index')}}"><i class="fa fa-circle-o"></i> Loại khen thưởng - kỳ luật</a></li>
                    <li><a href="{{route('hinhthuc_ktkl.index')}}"><i class="fa fa-circle-o"></i> Hình thức khen thưởng - kỳ luật</a></li>
                    @endif
                  </ul>
                </li>
                @endif
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-user-plus" aria-hidden="true" style="color: #66CD00;"></i></i> <span>Kết nạp đoàn</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    @if(Session::get('session_vt')==3 || Session::get('session_vt')==1)
                    <li><a href="{{route('qd_dv_ketnap.index')}}"><i class="fa fa-circle-o"></i>Danh sách kết nạp</a></li>
                    @endif
                    @if(Session::get('session_vt')==2)
                    <li><a href="{{route('qd_dv_ketnap.index')}}"><i class="fa fa-circle-o"></i>Quyết định kết nạp</a></li>
                    <li><a href="{{route('dv_ketnap.index')}}"><i class="fa fa-circle-o"></i>Thời gian kết nạp</a></li>
                    @endif
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-tree" aria-hidden="true" style="color:#00FA9A;"></i> <span>Trưởng thành đoàn</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    @if(Session::get('session_vt')==3||Session::get('session_vt')==1)
                    <li><a href="{{route('qd_dv_ttdoan.index')}}"><i class="fa fa-circle-o"></i>Danh sách trưởng thành đoàn</a></li>
                    @endif
                    @if(Session::get('session_vt')==2)
                    <li><a href="{{route('qd_dv_ttdoan.index')}}"><i class="fa fa-circle-o"></i>Quyết định trưởng thành đoàn</a></li>
                    <li><a href="{{route('dv_tt_doan.index')}}"><i class="fa fa-circle-o"></i>Thời gian trưởng thành đoàn</a></li>
                    @endif
                  </ul>
                </li>
                @if(Session::get('session_vt') == 1)
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-table" style="color: #ADFF2F"></i> <span>Mẫu phiếu</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="{{route('ct_mp.index')}}"><i class="fa fa-circle-o"></i>lập chi tiết mẫu phiếu</a></li>
                    <li class="treeview">
                      <a href="#">
                        <i class="fa fa-table" style="color: #20B2AA;"></i> <span>Quản lý nội dung phiếu</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>
                      <ul class="treeview-menu">
                        <li><a href="{{route('loai_noidung_pdg.index')}}"><i class="fa fa-circle-o"></i>loại nội dung</a></li>
                        <li><a href="{{route('kieu_dulieu.index')}}"><i class="fa fa-circle-o"></i>loại kiểu dữ liệu</a></li>
                        <li><a href="{{route('noidung_pdg.index')}}"><i class="fa fa-circle-o"></i>Nội dung phiếu đánh giá</a></li>
                      </ul>
                    </li>
                    <li><a href="{{route('mauphieu.index')}}"><i class="fa fa-circle-o"></i>quản lý mẫu phiếu</a></li>
                  </ul>
                </li>
                <li>
                  @endif
                  @if(Session::get('session_vt') == 3 || Session::get('session_vt') == 2)
                  <li class="treeview">
                    <a href="#">
                     <i class="fa fa-star" aria-hidden="true" style="color: red;"></i></i> <span>Bầu đoàn viên ưu tú</span>
                     <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="{{route('phieubau_uutu.index')}}"><i class="fa fa-circle-o"></i>Tạo phiếu bầu đoàn viên ưu tú</a></li>
                    @if(Session::get('session_vt') == 3)
                    <li><a href="{{route('chitiet_bau_ut.index')}}"><i class="fa fa-circle-o"></i>Danh sách bầu ưu tú</a></li>
                    @elseif(Session::get('session_vt') == 2)
                    <li><a href="{{route('doankhoa_index_getchidoan_ctbau')}}"><i class="fa fa-circle-o"></i>Danh sách bầu ưu tú</a></li>
                    @endif
                  </ul>
                </li>
                @endif
                @if(Session::get('session_vt') == 1 ||Session::get('session_vt') == 2)
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-user-circle" aria-hidden="true" style="color: #00EEEE;"></i> <span>Quản lý người dùng</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="{{route('users.index')}}"><i class="fa fa-circle-o"></i>Danh sách người dùng</a></li>
                  </ul>
                </li>
                @endif
                @if(Session::get('session_vt') != 4)
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-users" aria-hidden="true" style="color: #EE00EE;"></i> <span>Quản lý chức vụ đoàn</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="{{route('ct_chucvu_dv.index')}}"><i class="fa fa-circle-o"></i>Quản lý danh sách chức vụ đoàn</a></li>
                  </ul>
                </li>
                @endif
                @endif
                @if(Session::get('session_vt') == 2 || Session::get('session_vt') == 4|| Session::get('session_vt') == 1)
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-pie-chart" style="color: #EE3A8C"></i>
                    <span>Thành tích tham gia</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    @if(Session::get('session_vt') == 2 || Session::get('session_vt') == 4)
                    <li><a href="{{route('thanhtich_thamgia.index')}}"><i class="fa fa-circle-o"></i>Danh sách thành tích tham gia</a></li>
                    @endif
                    @if(Session::get('session_vt') == 1 )
                    <li><a href="{{route('thanhtich.index')}}"><i class="fa fa-circle-o"></i> Thành tích</a></li>
                    @endif
{{--           @if(Session::get('session_vt') == 2 || Session::get('session_vt') == 3)
          <li><a href="{{route('loai_pt.index')}}"><i class="fa fa-circle-o"></i> Loại phong trào</a></li>
          @endif --}}
        </ul>
      </li>
      @endif
      @if(Session::get('session_vt') == 2 || Session::get('session_vt') == 3|| Session::get('session_vt') == 1)
      <li class="treeview">
        <a href="#">
          <i class="fa fa-futbol-o" aria-hidden="true" style="color: orange;"></i>
          <span>Phong trào</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          @if(Session::get('session_vt') == 2)
          <li><a href="{{route('pt_doankhoa.index')}}"><i class="fa fa-circle-o"></i>Đoàn khoa</a></li>
          @endif
          @if(Session::get('session_vt') == 3 || Session::get('session_vt') == 4)
          <li><a href="{{route('pt_chidoan.index')}}"><i class="fa fa-circle-o"></i> Chi đoàn</a></li>
          @endif
          @if(Session::get('session_vt') == 1)
          <li><a href="{{route('loai_pt.index')}}"><i class="fa fa-circle-o"></i> Loại phong trào</a></li>
          @endif
        </ul>
      </li>
      @endif
      <li class="treeview">
        <a href="#">
          <i class="fa fa-pencil-square" aria-hidden="true" style="color:#EE1289;"></i> <span>Đánh giá</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          @if(Session::get('session_vt') != 3 && Session::get('session_vt') != 4)
          <li class="treeview">
            <a href="#">
              <i class="fa fa-files-o" style="color: #CD1076"></i>
              <span>Đánh giá đoàn khoa</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              @if(Session::get('session_vt') == 2)
              <li><a href="{{route('index_create_pdg_dk')}}"><i class="fa fa-circle-o"></i>Tạo đánh giá</a></li>
              @endif
              @if(Session::get('session_vt') == 1)
              <li><a href="{{route('index_duyet_pdg_dk')}}"><i class="fa fa-circle-o"></i>Duyệt đánh giá</a></li>
              @endif
              @if(Session::get('session_vt') == 2)
              <li><a href="{{route('ds_pdg_dk')}}"><i class="fa fa-circle-o"></i>Xem kết quả đánh giá</a></li>
              @endif
              @if(Session::get('session_vt') == 1)
              <li><a href="{{route('thongke_xeploai_dk')}}"><i class="fa fa-circle-o"></i>Thống kê xếp loại đoàn khoa</a></li>
              @endif
            </ul>
          </li>
          @endif

          @if(Session::get('session_vt') != 1 && Session::get('session_vt') != 4)
          <li class="treeview">
            <a href="#">
              <i class="fa fa-files-o" style="color: #CD1076"></i>
              <span>Đánh giá chi đoàn</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              @if(Session::get('session_vt') == 3)
              <li><a href="{{route('index_create_pdg_cd')}}"><i class="fa fa-circle-o"></i>Tạo đánh giá</a></li>
              @endif
              @if(Session::get('session_vt') == 2)
              <li><a href="{{route('index_duyet_pdg_cd')}}"><i class="fa fa-circle-o"></i>Duyệt đánh giá</a></li>
              @endif
              @if(Session::get('session_vt') == 3)
              <li><a href="{{route('ds_pdg_cd')}}"><i class="fa fa-circle-o"></i>Xem kết quả đánh giá</a></li>
              @endif
              @if(Session::get('session_vt') == 2)
              <li><a href="{{route('thongke_xeploai_cd')}}"><i class="fa fa-circle-o"></i>Thống kê xếp loại chi đoàn</a></li>
              @endif
            </ul>
          </li>
          @endif

          @if(Session::get('session_vt') != 1 && Session::get('session_vt') != 2 )
          <li class="treeview">
            <a href="#">
              <i class="fa fa-files-o" style="color: #CD1076"></i>
              <span>Đánh giá đoàn viên</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              @if(Session::get('session_vt') == 4)
              <li><a href="{{route('index_create_pdg_dv')}}"><i class="fa fa-circle-o"></i>Tạo đánh giá</a></li>
              @endif
              @if(Session::get('session_vt') == 3)
              <li><a href="{{route('index_duyet_pdg_dv')}}"><i class="fa fa-circle-o"></i>Duyệt đánh giá</a></li>
              @endif
              @if(Session::get('session_vt') == 4)
              <li><a href="{{route('ds_pdg_dv')}}"><i class="fa fa-circle-o"></i>Xem kết quả đánh giá</a></li>
              @endif
              @if(Session::get('session_vt') == 2 || Session::get('session_vt') == 3)
              <li><a href="{{route('thongke_xeploai_dv')}}"><i class="fa fa-circle-o"></i>Thống kê xếp loại đoàn viên</a></li>
              @endif
            </ul>
          </li>
          @endif
        </ul>
      </li>

      @if(Session::get('session_vt') == 1)
      <li class="treeview">
        <a href="#">
          <i class="fa fa-cogs" style="color:#32CD32;"></i> <span>Hệ thống</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{route('vaitro.index')}}"><i class="fa fa-circle-o"></i> Vai trò </a></li>
          <li><a href="{{route('chucvu_dv.index')}}"><i class="fa fa-circle-o"></i>Chức vụ</a></li>
          <li><a href="{{route('dantoc.index')}}"><i class="fa fa-circle-o"></i>Dân tộc</a></li>
          <li><a href="{{route('tongiao.index')}}"><i class="fa fa-circle-o"></i>Tôn giáo</a></li>
          <li><a href="{{route('phuong_xa.index')}}"><i class="fa fa-circle-o"></i>Quê quán-nơi sinh</a></li>
          <li><a href="{{route('namhoc.index')}}"><i class="fa fa-circle-o"></i>Năm học</a></li>
          <li><a href="{{route('hocky.index')}}"><i class="fa fa-circle-o"></i>Học kỳ</a></li>
          <li><a href="{{route('thangnam.index')}}"><i class="fa fa-circle-o"></i>Tháng năm - đoàn phí</a></li>
          <li><a href="{{route('khoa.index')}}"><i class="fa fa-circle-o"></i>Khóa</a></li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-pie-chart"></i>
              <span>Xếp loại đánh giá</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{route('xeploai_dk.index')}}"><i class="fa fa-circle-o"></i> Đoàn khoa</a></li>
              <li><a href="{{route('xeploai_cd.index')}}"><i class="fa fa-circle-o"></i>Chi đoàn</a></li>
              <li><a href="{{route('xeploai_dv.index')}}"><i class="fa fa-circle-o"></i>Đoàn viên</a></li>
            </ul>
          </li>
        </ul>
      </li>
      @endif
    </ul>
  </section>