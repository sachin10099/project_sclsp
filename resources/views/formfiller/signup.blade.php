@extends('front.front')
@section('content')

  <center>
    <div class="btn-group">
      <a href="{{ url('form-filler/signup') }}"><button>Sign Up as a User</button></a>
      <a href="{{ url('form-filler/login') }}"><button>If your have already account goto login, click here</button></a>
      <a href="{{ url('operator/signup') }}"><button onclick="changeViewSignUp('operator', 'user')">Sign Up as a Operator</button></a>
    </div>
  </center>
  <div class="container">
  <div class="row">
    <div class="col-sm-2">&nbsp;</div>
    <div class="panel panel-default col-sm-8 box" id="user" style="margin-top:50px;margin-bottom:50px;">
      <center><h2>Sign Up as a User</h2></center>
      <form method="post" action="{{ url('form-filler/user/signup') }}">
        @csrf
        <label><strong>Enter full name:</strong></label>
        @if($errors->has('user_name'))
            <span class="" style="color: red;">{{ $errors->first('user_name') }}</span>
        @endif
        <input type="text" class="form-control" name="user_name" value="{{ old('user_name') }}" required=""><br>
        
        <label><strong>Enter Email Id:</strong></label>
        @if($errors->has('email'))
            <span class="" style="color: red;">{{ $errors->first('email') }}</span>
        @endif
        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required=""><br>

        <label><strong>Enter Contact Number:</strong></label>
        @if($errors->has('contact_number'))
            <span class="" style="color: red;">{{ $errors->first('contact_number') }}</span>
        @endif
        <input type="number" class="form-control" name="contact_number" value="{{ old('contact_number') }}" required=""><br>

        <label><strong>Enter Address:</strong></label>
        @if($errors->has('address'))
            <span class="" style="color: red;">{{ $errors->first('address') }}</span>
        @endif
        <textarea class="form-control" name="address" row="4" value="{{ old('address') }}" required=""></textarea><br>
       
        <label><strong>Enter Password:</strong></label>
        @if($errors->has('user_password'))
            <span class="" style="color: red;">{{ $errors->first('user_password') }}</span>
        @endif
        <input type="Password" class="form-control" name="user_password" required=""><br>
        
        <label><strong>Confirm Password:</strong></label>
        @if($errors->has('user_confirm_pass'))
            <span class="" style="color: red;">{{ $errors->first('user_confirm_pass') }}</span>
        @endif
        <input type="password" class="form-control" name="user_confirm_pass" required=""><br>
        <br>
        <div class="checkbox">
          <label><input type="checkbox" name="checkbox" value="Yes" required=""> <a href="" style="color: blue;">Accept terms & conditions</a></label>
            @if($errors->has('checkbox'))
                <span class="" style="color: red;">{{ $errors->first('checkbox') }}</span>
            @endif
        </div>
        
        <center>
          <input type="submit" class="btn btn-primary" name="Submit" style="margin-bottom: 20px;">
          <p>if your have already account goto <a href="{{ url('form-filler/login') }}">login</a></p>
        </center>
      </form>
    </div>
    <div class="col-sm-2">&nbsp;</div>    
  </div>
  </div>

  </div>

  <script type="text/javascript">
    document.getElementById('loader').style.display ="none";
    document.getElementById('operator').style.display ="none";

    function changeViewSignUp(data1, data2) {
      document.getElementById(data1).style.display ="block";
      document.getElementById(data2).style.display ="none";
    }

    $('#myTab a').click(function(e) {
        e.preventDefault();
        $(this).tab('show');
    });

    // on load of the page: switch to the currently selected tab
    var hash = window.location.hash;
    $('#myTab a[href="' + hash + '"]').tab('show');
  </script> 
@endsection