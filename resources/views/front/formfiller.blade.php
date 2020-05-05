
<!doctype html>
<html lang="en">
  <head>
    <title>Welcome to S.C.L.S.P</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>



    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
    <link rel="stylesheet" href="{{ asset('/') }}public/asset2/css/custom-bs.css">
    <link rel="stylesheet" href="{{ asset('/') }}public/asset2/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}public/asset2/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}public/asset2/fonts/icomoon/style.css">
    <link rel="stylesheet" href="{{ asset('/') }}public/asset2/fonts/line-icons/style.css">
    <link rel="stylesheet" href="{{ asset('/') }}public/asset2/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}public/asset2/css/animate.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="{{ asset('/') }}public/assets/img/logo/logo.png" rel="icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('/') }}public/asset2/css/style.css">   
   <!--  Owl Carosual Links  -->
    <link rel="stylesheet" href="{{ asset('public/owl/assets/owl.carousel.min.css') }}/">
    <link rel="stylesheet" href="{{ asset('public/owl/assets/owl.theme.default.min.css') }}">
  </head>
  <body id="top">

    <div id="overlayer"></div>
    <div class="loader">
      <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
    
    @yield('content')

    <!-- SCRIPTS -->
    <script src="{{ asset('/') }}public/asset2/js/jquery.min.js"></script>
    <script src="{{ asset('/') }}public/asset2/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/') }}public/asset2/js/isotope.pkgd.min.js"></script>
    <script src="{{ asset('/') }}public/asset2/js/stickyfill.min.js"></script>
    <script src="{{ asset('/') }}public/asset2/js/jquery.fancybox.min.js"></script>
    <script src="{{ asset('/') }}public/asset2/js/jquery.easing.1.3.js"></script>
    <script src="{{ asset('/') }}public/asset2/js/jquery.waypoints.min.js"></script>
    <script src="{{ asset('/') }}public/asset2/js/jquery.animateNumber.min.js"></script>
    <script src="{{ asset('/') }}public/asset2/js/owl.carousel.min.js"></script>
    <script src="{{ asset('/') }}public/owl/owl.carousel.min.js"></script>
    
    <script src="{{ asset('/') }}public/asset2/js/bootstrap-select.min.js"></script>
    
    <script src="{{ asset('/') }}public/asset2/js/custom.js"></script>
    <script type="text/javascript">
      document.getElementById('results').style.display = "none";
      function manageTabs(data1, data2) {
        document.getElementById(data1).style.display = "block";
        document.getElementById(data2).style.display = "none";
      }
    </script>

     
  </body>
</html>