<!DOCTYPE html>
<html><head>
    <meta charset="utf-8">
    <title>Bootflat-Admin Template</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="favicon_16.ico" rel="shortcut icon">
    <link href="favicon_16.ico" rel="bookmark">
    <!-- site css -->
    <link href="{{asset('themes/admin/dist/css/site.min.css')}}" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css">
    <!-- <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'> -->
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
    <script src="{{asset('themes/admin/dist/js/site.min.js')}}" type="text/javascript"></script>
    <style>
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #303641;
        color: #C1C3C6
      }
    </style>
  </head>
  <body>
    <div class="container">
      <form class="form-signin" method="POST" role="form" action="{{ route('register') }}">
      {{ csrf_field() }}
        <h3 class="form-signin-heading">Đăng ký 
        &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
      
        <a href="{{ route('login') }}" type="button"><button class="btn btn-info"  type="button"><span style="color:white">Về trang Đăng nhập</span> </a></button>

        </h3>

        <div class="form-group">
        
        <div class="input-group{{ $errors->has('name') ? ' has-error' : '' }}">
          <div class="input-group-addon">
            <i class="glyphicon glyphicon-user"></i>
          </div>
          <input name="name" value="{{ old('name') }}" class="form-control" id="name" type="text" placeholder="Họ tên người dùng" autocomplete="off">
          @if ($errors->has('name'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('name') }}</strong>
                                  </span>
          @endif
        </div>
      </div>


        <div class="form-group">
        
          <div class="input-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <div class="input-group-addon">
              <i class=" glyphicon glyphicon-envelope"></i>
            </div>
            <input name="email" value="{{ old('email') }}" class="form-control" id="email" type="email" placeholder="Email đăng nhập" autocomplete="off">
            @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
            @endif
          </div>

        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <div class="input-group">
            <div class="input-group-addon">
              <i class=" glyphicon glyphicon-lock "></i>
            </div>
            <input name="password" class="form-control" id="password" type="password" placeholder="Mật khẩu" autocomplete="off">
            @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <div class="input-group">
            <div class="input-group-addon">
              <i class=" glyphicon glyphicon-lock "></i>
            </div>
            <input name="password_confirmation" class="form-control" id="password-confirm" type="password" placeholder="Nhập lại mật khẩu" autocomplete="off">
          </div>
        </div>
<input type="hidden" value="3" name="role_id">
        
        <button class="btn btn-lg btn-primary btn-block" type="submit">Xác nhận Đăng ký</button>
        
      </form>

    </div>
    <div class="clearfix"></div>
    <br><br>
    <!-- footer
    <div class="site-footer login-footer">
      <div class="container">
        <div class="copyright clearfix text-center">
          <p><b>Bootflat</b>&nbsp;&nbsp;&nbsp;&nbsp;<a href="getting-started.html">Getting Started</a>&nbsp;•&nbsp;<a href="index.html">Documentation</a>&nbsp;•&nbsp;<a href="https://github.com/Bootflat/Bootflat.UI.Kit.PSD/archive/master.zip">Free PSD</a>&nbsp;•&nbsp;<a href="colors.html">Color Picker</a></p>
          <p>Code licensed under <a href="http://opensource.org/licenses/mit-license.html" target="_blank" rel="external nofollow">MIT License</a>, documentation under <a href="http://creativecommons.org/licenses/by/3.0/" rel="external nofollow">CC BY 3.0</a>.</p>
        </div>
      </div>
    </div> -->
  

</body></html>