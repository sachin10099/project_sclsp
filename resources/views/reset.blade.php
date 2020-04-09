@extends('front.login_front')
@section('content')	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('assets1/images/reset.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="post" action="{{ url('reset/password') }}">
					@csrf
					<center>
						<img src="{{ asset('/') }}/public/assets/img/logo/logo1.jpg" alt="S.C.L.S.P Logo" style="width:100px;height: 100px;">
						<br>
						@if($errors->has('pass'))
                            <span  style="color: white;">{{ $errors->first('pass') }}</span>
                        @endif
                        @if($errors->has('confirm_pass'))
                            <span  style="color: white;">{{ $errors->first('confirm_pass') }}</span>
                        @endif
					</center>
					<span class="login100-form-title p-b-34 p-t-27">
						RESET PASSWORD
					</span>
					<input type="hidden" name="id" value="{{ $id }}">
					<div class="wrap-input100 validate-input" data-validate="Password">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Confrim password">
						<input class="input100" type="password" name="confirm_pass" placeholder="Confrim Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>
					<div class="container-login100-form-btn">
						<input type="submit" class="login100-form-btn" value="SAVE CHANGES">
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
@endsection