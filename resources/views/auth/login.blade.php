<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V14</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{asset('template_login/images/icons/favicon.ico')}}"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('template_login/vendor/bootstrap/css/bootstrap.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('template_login/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('template_login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('template_login/vendor/animate/animate.css')}}">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('template_login/vendor/css-hamburgers/hamburgers.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('template_login/vendor/animsition/css/animsition.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('template_login/vendor/select2/select2.min.css')}}">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('template_login/vendor/daterangepicker/daterangepicker.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('template_login/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('template_login/css/main.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<!--   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->
	<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
</head>
<style type="text/css">
	
	.container-login100 {
	/*	background-color: mediumturquoise !important;*/
		background-image: url('hinh_luanvan/background.jpeg') !important;
	}

	.login100-form-btn {
		background-color: #66CCFF ;
	}

	.profile-img {
		width: 160px;
		height: 160px;
		margin: 0 auto 10px;
		display: block;
		-moz-border-radius: 50%;
		-webkit-border-radius: 50%;
		border-radius: 50%;
	}
	img.happy
	{
		display: block; 
		margin-left: auto; 
		margin-right: auto;
	} 
	.glyphicon{
		color: blue;
	}
	marquee {
		width: 100%;
		padding: 10px 0;
		/*background-color: lightblue;*/
		font-size: 25px;
		font-weight: 30px;
		color: white;
		/*font-family: Arial;*/
	}
	.login100-form-btn:hover {
  background-color: #4169E1 !important;
}
</style>
<body>
	
	<div class="limiter">

		<div class="container-login100">
	{{-- 		<marquee behavior="alternate">HỆ THỐNG QUẢN LÝ ĐOÀN VỤ ĐOÀN TRƯỜNG ĐẠI HỌC CẦN THƠ<img src="{{asset('hinh_luanvan/banner-doanhoi.png')}}"></marquee> --}}
			<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55 ">
				<div class="row">

					<img  class="happy" width="90%" src="{{asset('hinh_luanvan/banner-doanhoi.png')}}" alt="User">

				</div>
				<br><br>
				<form class="login100-form validate-form flex-sb flex-w" method="POST" action="{{ route('post.login') }}">
					{{ csrf_field() }}


<!-- 					<span class="txt1 p-b-11">
						MÃ SỐ ĐĂNG NHẬP
					</span> -->
					<div class="wrap-input100 validate-input m-b-36 form-group" data-validate = "email is required">
						<div class="input-group {{ $errors->has('email') ? ' has-error' : '' }}">
							<div class="input-group-addon">
								<i class="glyphicon glyphicon-user"></i>
							</div>
							<input class="input100" type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" placeholder="Mã số đăng nhập" autocomplete="off">
							@if ($errors->has('email'))
							<span class="focus-input100">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
							@endif
						</div>
					</div>
					
<!-- 					<span class="txt1 p-b-11">
						Password
					</span> -->
					<div class="wrap-input100 validate-input m-b-12 form-group {{ $errors->has('password') ? ' has-error' : '' }}" data-validate = "Password is required">
						<div class="input-group">
							<div class="input-group-addon">
								<i class=" glyphicon glyphicon-lock "></i>
							</div>
							<span class="btn-show-pass">
								<i class="fa fa-eye"></i>
							</span>

							<input class="input100" type="password" name="password" class="form-control" placeholder="Mật khẩu" autocomplete="off" pattern=".{5,}" title="Nhập 5 hoặc nhiều hơn 5 ký tự">
							@if ($errors->has('password'))
							<span class="focus-input100"> 
								<strong>{{ $errors->first('password') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="flex-sb-m w-full p-b-48">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" {{ old('remember') ? 'checked' : '' }} name="remember" value="remember" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Ghi nhớ
							</label>
						</div>

						<div>
							<a href="#" class="txt3">
								Quên mật khẩu?
							</a>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Đăng nhập
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

	<!--===============================================================================================-->
	<script src="{{asset('template_login/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
	<!--===============================================================================================-->
	<script src="{{asset('template_login/vendor/animsition/js/animsition.min.js')}}"></script>
	<!--===============================================================================================-->
	<script src="{{asset('template_login/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('template_login/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
	<!--===============================================================================================-->
	<script src="{{asset('template_login/vendor/select2/select2.min.js')}}"></script>
	<!--===============================================================================================-->
	<script src="{{asset('template_login/vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{asset('template_login/vendor/daterangepicker/daterangepicker.js')}}"></script>
	<!--===============================================================================================-->
	<script src="{{asset('template_login/vendor/countdowntime/countdowntime.js')}}"></script>
	<!--===============================================================================================-->
	<script src="{{asset('template_login/js/main.js')}}"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	<script>
		@if(Session::has('message'))
		var type="{{Session::get('alert-type','info')}}"


		switch(type){
			case 'info':
			toastr.info("{{ Session::get('message') }}");
			break;
			case 'success':
			toastr.success("{{ Session::get('message') }}");
			break;
			case 'warning':
			toastr.warning("{{ Session::get('message') }}");
			break;
			case 'error':
			toastr.error("{{ Session::get('message') }}");
			break;
		}
		@endif
	</script>


</body>
</html>