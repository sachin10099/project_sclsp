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
			<div class="col-sm-2">&nbsp;</div>
			<div class="panel panel-default col-sm-8 box" id="user" style="margin-top:50px;margin-bottom:50px;">
				<center><h2>Log In</h2></center>
				<form>
				<label><strong>Enter Email Id:</strong></label>
				<input type="email" class="form-control" name="email" required=""><br>
				<label><strong>Enter Your Password:</strong></label>
				<input type="Password" class="form-control" name="passowrd" required=""><br>
				<center>
				<input type="submit" class="btn btn-primary" name="Submit" style="margin-bottom: 20px;">
				<p><a href="{{ url('forgot/password') }}">Forgot Password</a></p>
				<p><a href="{{ url('form-filler/signup') }}"><span style="color: black;">If you dont't have an account, Please    </span><button type="button" style="margin-left: 10px;">Sign UP</button></a></p>
				</center>
				</form>
			</div>
			<div class="col-sm-2">&nbsp;</div>
		</div>
	</div>
	<script type="text/javascript">
		document.getElementById('loader').style.display ="none";
	</script>
@endsection