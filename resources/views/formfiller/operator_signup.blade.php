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
    <div class="panel panel-default col-sm-8 box" id="operator" style="margin-top:50px;margin-bottom:50px;">
      <center><h2>Sign Up as a Operator</h2></center>
    
      <form method="post" action="{{ url('operator/signup') }}">
        @csrf
        <label><strong>Enter full name:</strong></label>
        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required="">
        @if($errors->has('name'))
            <span class="" style="color: red;">{{ $errors->first('name') }}</span>
             
            
        @endif
        <br>
        <label><strong>Enter Email Id:</strong></label>
        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required="">
        @if($errors->has('email'))
            <span class="" style="color: red;">{{ $errors->first('email') }}</span>
             
           
        @endif
        <br>
    
        <label><strong>Enter Contact Number:</strong></label>
        <input type="number" class="form-control" name="contact_number" value="{{ old('contact_number') }}" required="">
        @if($errors->has('contact_number'))
            <span class="" style="color: red;">{{ $errors->first('contact_number') }}</span>
            
        @endif
        <br>
        <label><strong>Choose Your State:</strong></label>
        <div class="form-group">
          <select class="form-control" name="state" required="">
            <option></option>
             <option></option>
            @foreach($data['states'] as $state)
                <option value="{{ $state->id }}" @if(old('state') == $state->id) {{ 'selected' }} @endif>{{ $state->name }}</option>
            @endforeach
          </select>
        </div>
        <br>
        @if($errors->has('state'))
            <span class="" style="color: red;">{{ $errors->first('state') }}</span>
            
        @endif

        <label><strong>Choose Your City:</strong></label>
        <div class="form-group">
          <select class="form-control" name="city" required="">
            <option></option>
            @foreach($data['cities'] as $city)
                <option value="{{ $city->id }}" @if(old('city') == $city->id) {{ 'selected' }} @endif>{{ $city->name }}</option>
            @endforeach
          </select>
        </div>
        @if($errors->has('city'))
            <span class="" style="color: red;">{{ $errors->first('city') }}</span>
            
        @endif
        <br>

        <label><strong>Enter Your Area Pincode:</strong></label>
        <input type="number" class="form-control" name="pincode" value="{{ old('pincode') }}" required="">
        @if($errors->has('pincode'))
            <span class="" style="color: red;">{{ $errors->first('pincode') }}</span>
            
        @endif
        <br>
        
        <label><strong>Enter Your Complete Address:</strong></label>
        <input type="text" class="form-control" name="address" value="{{ old('address') }}" required="">
        @if($errors->has('address'))
            <span class="" style="color: red;">{{ $errors->first('address') }}</span>
             
        @endif
        <br>

        <label><strong>Password:</strong></label>
        <input type="password" class="form-control" name="password" required="">
        @if($errors->has('password'))
            <span class="" style="color: red;">{{ $errors->first('password') }}</span>
             
        @endif

        <br>
        
        <label><strong>Confirm Password:</strong></label>
        <input type="password" class="form-control" name="confirm_password" required="">
        @if($errors->has('confirm_password'))
            <span class="" style="color: red;">{{ $errors->first('confirm_password') }}</span>
             
        @endif
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
  </script>
@endsection