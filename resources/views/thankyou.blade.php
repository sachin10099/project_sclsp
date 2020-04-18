<!DOCTYPE html>
<html>
<head>
	<title>Welcome to S.C.L.S.P</title>
	<!-- Favicons -->
  	<link href="{{ asset('/') }}public/assets/img/logo/logo.png" rel="icon">
</head>
<body>
@if($data == 'expired') 
	<center><h2 style="margin-top: 100px;color: red;">{{ $msg }}</h2></center>
@else 
	<center><h2 style="margin-top: 100px;">Thank You</h2></center>
	<center><img src="{{ asset('public/assets3/img/verify.gif') }}" alt="Verify"></center>
	<center><h3>{{ $msg }}</h3></center>
@endif

</body>
</html>