<!DOCTYPE html>
<html lang="en">
<head>
	<title>Welcome to S.C.L.S.P</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	 <!-- Favicons -->
  <link href="{{ asset('') }}public/assets/img/logo/logo.png" rel="icon">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('') }}public/assets1/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('') }}public/assets1/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('') }}public/assets1/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('') }}public/assets1/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('') }}public/assets1/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('') }}public/assets1/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('') }}public/assets1/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('') }}public/assets1/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('') }}public/assets1/css/util.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('') }}public/assets1/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	@yield('content')

<!--===============================================================================================-->
	<script src="{{ asset('') }}public/assets1/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="{{ asset('') }}public/assets1/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="{{ asset('') }}public/assets1/vendor/bootstrap/js/popper.js"></script>
	<script src="{{ asset('') }}public/assets1/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="{{ asset('') }}public/assets1/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="{{ asset('') }}public/assets1/vendor/daterangepicker/moment.min.js"></script>
	<script src="{{ asset('') }}public/assets1/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="{{ asset('') }}public/assets1/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="{{ asset('') }}public/assets1/js/main.js"></script>
	<script type="text/javascript">
        setTimeout(function(){ 
            document.getElementById("hideAlert").style.display  = "none";
        }, 5000);
    </script>

</body>
</html>