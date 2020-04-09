@extends('front.login_front')
@section('content')	
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('{{ asset('/')  }}public/assets1/images/forgot.jpg');">
			<div class="wrap-login100">
				@if(session()->has('success'))
			        <div class="alert alert-success" id="hideAlert">
			            {{ session()->get('success') }}
			        </div>
			    @endif
			    @if(session()->has('error'))
			        <div class="alert alert-danger" id="hideAlert">
			            {{ session()->get('error') }}
			        </div>
			    @endif
				<form class="login100-form validate-form" method="post" action="{{ url('forgot/password') }}">
					@csrf
					<center>
						<img src="{{ asset('/')  }}public/assets/img/logo/logo1.jpg" alt="S.C.L.S.P Logo" style="width:100px;height: 100px;">
					</center>
					<span class="login100-form-title p-b-34 p-t-27">
						FORGOT PASSWORD
					</span>
					<label style="color: white;">Enter your registered email id below, a reset password link will be sent to your registered email id</label><br>
					<div class="wrap-input100">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					@if($errors->has('email'))
                        <span style="color: white;">{{ $errors->first('email') }}</span>
                    @endif
					<div class="container-login100-form-btn">
						<input class="login100-form-btn" type="submit" value="Send" style="color: white;" />
					</div>
					<div class="text-center p-t-90">
						<a class="txt1" href="{{ url('/') }}">
							Home
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div id="dropDownSelect1"></div>

@endsection