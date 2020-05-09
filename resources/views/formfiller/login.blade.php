@extends('front.front')
@section('content')
<style type="text/css">
	.box:hover {
	  -webkit-box-shadow: 3px 3px 5px 6px #ccc;  /* Safari 3-4, iOS 4.0.2 - 4.2, Android 2.3+ */
	  -moz-box-shadow:    3px 3px 5px 6px #ccc;  /* Firefox 3.5 - 3.6 */
	  box-shadow:         3px 3px 5px 6px #ccc;  /
	}
</style>

	<div class="container">
		<div class="col-sm-4">&nbsp;</div>
		<div class="panel panel-default col-sm-4 box" id="user" style="margin-top:50px;margin-bottom:50px;">
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
		    <br>
			<center><h2>Log In</h2></center>
			<center>
				<form method="post" action="{{ url('global/login') }}">
				@csrf
				<label><strong>Enter email id or contact number:</strong></label>
				@if($errors->has('email'))
		            <span class="" style="color: red;">{{ $errors->first('email') }}</span>
		        @endif
				<input type="text" class="form-control" name="email" required=""><br>
				<label><strong>Enter your password:</strong></label>
				@if($errors->has('password'))
		            <span class="" style="color: red;">{{ $errors->first('password') }}</span>
		        @endif
				<input type="Password" class="form-control" name="password" required=""><br>
				<center>
				<input type="submit" class="btn btn-primary" name="Submit" style="margin-bottom: 20px;">
				<p><a href="{{ url('forgot/password') }}">Forgot Password</a></p>
				<p><a href="{{ url('form-filler/signup') }}"><span style="color: black;">If you dont't have an account, Please    </span><button type="button" style="margin-left: 10px;background-color: green;color: white;">Sign UP</button></a></p>
				</form>
			</center>
		</div>
			<div class="col-sm-4">&nbsp;</div>
		</div>
	</div>
	<script type="text/javascript">
		document.getElementById('loader').style.display ="none";
	</script>
@endsection