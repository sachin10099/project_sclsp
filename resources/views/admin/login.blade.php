@extends('front.login_front')
@section('content')	
	<div class="limiter">
		@if(session()->has('success'))
	        <div class="alert alert-success" id="hideAlert">
	            {{ session()->get('success') }}
	        </div>
	    @endif
		<div class="container-login100" style="background-image: url('{{ asset('/')  }}public/assets1/images/loginback.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="{{ url('admin/login') }}">
					@csrf
					<center>
						<img src="{{ asset('/')  }}public/assets/img/logo/logo1.jpg" alt="S.C.L.S.P Logo" style="width:100px;height: 100px;">
					</center><br>
					@if(session()->has('error'))
		                <div class="alert alert-danger" id="hideAlert">
		                    {{ session()->get('error') }}
		                </div>
		            @endif
					<span class="login100-form-title p-b-34 p-t-27">
						Admin Log in
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter Valid Email">
						<input class="input100" placeholder="Email" type="text" name="email" value="{{ old('email') }}" required>
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
						@error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" placeholder="Password" id="password"  name="password" required>
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>
					<div class="container-login100-form-btn">
						<input type="submit" class="login100-form-btn" value="Login" style="color:white;">
					</div>

					<div class="text-center p-t-90">
						<a class="txt1" href="{{ url('forgot/password') }}">
							Forgot Password?
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
<div id="dropDownSelect1"></div>
@endsection