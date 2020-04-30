<!DOCTYPE html>
<html>
<head>
  <title>Welcome to S.C.L.S.P</title>
  <meta name="viewport" content="width=device-width">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <!-- Favicons -->
  <link href="{{ asset('/') }}public/assets/img/logo/logo.png" rel="icon">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
  <script src="{{ asset('public/assets/js/payment.js') }}"></script> 
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
  <style type="text/css">
  
  .button{
    display: inline-block;
    *display: inline;
    zoom: 1;
    padding: 6px 20px;
    margin: 0;
    cursor: pointer;
    border: 1px solid #bbb;
    overflow: visible;
    font: bold 13px arial, helvetica, sans-serif;
    text-decoration: none;
    white-space: nowrap;
    color: #555;
    background-color: #ddd;
    background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(255,255,255,1)), to(rgba(255,255,255,0)));
    background-image: -webkit-linear-gradient(top, rgba(255,255,255,1), rgba(255,255,255,0));
    background-image: -moz-linear-gradient(top, rgba(255,255,255,1), rgba(255,255,255,0));
    background-image: -ms-linear-gradient(top, rgba(255,255,255,1), rgba(255,255,255,0));
    background-image: -o-linear-gradient(top, rgba(255,255,255,1), rgba(255,255,255,0));
    background-image: linear-gradient(top, rgba(255,255,255,1), rgba(255,255,255,0));
    
    -webkit-transition: background-color .2s ease-out;
    -moz-transition: background-color .2s ease-out;
    -ms-transition: background-color .2s ease-out;
    -o-transition: background-color .2s ease-out;
    transition: background-color .2s ease-out;
    background-clip: padding-box; /* Fix bleeding */
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    -moz-box-shadow: 0 1px 0 rgba(0, 0, 0, .3), 0 2px 2px -1px rgba(0, 0, 0, .5), 0 1px 0 rgba(255, 255, 255, .3) inset;
    -webkit-box-shadow: 0 1px 0 rgba(0, 0, 0, .3), 0 2px 2px -1px rgba(0, 0, 0, .5), 0 1px 0 rgba(255, 255, 255, .3) inset;
    box-shadow: 0 1px 0 rgba(0, 0, 0, .3), 0 2px 2px -1px rgba(0, 0, 0, .5), 0 1px 0 rgba(255, 255, 255, .3) inset;
    text-shadow: 0 1px 0 rgba(255,255,255, .9);
    
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  .button:hover{
    background-color: #eee;
    color: #555;
  }

  .button:active{
    background: #e9e9e9;
    position: relative;
    top: 1px;
    text-shadow: none;
    -moz-box-shadow: 0 1px 1px rgba(0, 0, 0, .3) inset;
    -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .3) inset;
    box-shadow: 0 1px 1px rgba(0, 0, 0, .3) inset;
}

.button[disabled], .button[disabled]:hover, .button[disabled]:active{
  border-color: #eaeaea;
  background: #fafafa;
  cursor: default;
  position: static;
  color: #999;
  /* Usually, !important should be avoided but here it's really needed :) */
  -moz-box-shadow: none !important;
  -webkit-box-shadow: none !important;
  box-shadow: none !important;
  text-shadow: none !important;
}
  </style>
</head>
<body style="background-image: url('{{ asset('public/assets/img/payment.jpg') }}');background-size: cover;background-repeat: no-repeat;">
  <center>
    <div class="card" style="width: 80%;margin-top: 100px;">
      <div class="card-body" style="background-color: transparent;">
        <center><img src="{{ asset('/') }}public/assets/img/logo/logo.png" alt="Company Logo" style="max-width: 150px;max-height: 150px;"></center>
        <center>
          <h3 style="padding-top: 50px;">
            Your request has been received, after which you complete the payment process, then your request will be considered complete.
          </h3>
          <center style="padding-top: 50px;"><span style="color: blue;"><h3>On The Basis Of Your Category The Applicable Fee :  Rs. {{ $data->amount }}</h3></span></center>
        </center>
        <div style="padding-top: 50px;">
        <button  class="button" onclick="pay('{{ $data->id }}','{{$data->amount}}')"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Proceed To Pay</button>
       </div>
       
        <br><strong onclick="back()" style="cursor: pointer;">Go to Back</strong>
      </div>
    </div>
  </center>
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <script type="text/javascript">
      function back() {
        window.history.back();
      }
  </script>
</body>
</html>