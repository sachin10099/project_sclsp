<!DOCTYPE html>
<html>
<head>
  <title>Welcome to S.C.L.S.P</title>
  <meta name="viewport" content="width=device-width">
  <!-- Favicons -->
  <link href="{{ asset('/') }}public/assets/img/logo/logo.png" rel="icon">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
  <script src="{{ asset('public/assets/js/payment.js') }}"></script>  
  <style type="text/css">
    .razorpay_payment_button{

    }
  </style>
</head>
<body>
  <center>
    <div class="card" style="width: 80%;margin-top: 100px;">
      <div class="card-body">
        <center><img src="{{ asset('/') }}public/assets/img/logo/logo.png" alt="Company Logo" style="max-width: 150px;max-height: 150px;"></center>
        <center>
          <h2>
            Your request has been received, after which you complete the payment process, then your request will be considered complete.
            }
          </h2>
          <center><span style="color: blue;"><h3>Applicable Fee :  Rs. {{ $data->amount }}</h3></span></center>
        </center>
        <button onclick="pay('{{ $data->id }}','{{$data->amount}}')">Proceed To Pay</button>
      </div>
    </div>
  </center>
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</body>
</html>