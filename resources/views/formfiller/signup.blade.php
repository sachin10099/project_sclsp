@extends('front.front')
@section('content')

  <center>
    <div class="btn-group">
      <button onclick="changeViewSignUp('user', 'operator')">Sign Up as a User</button>
      <a href="{{ url('form-filler/login') }}"><button>If your have already account goto login, click here</button></a>
      <button onclick="changeViewSignUp('operator', 'user')">Sign Up as a Operator</button>
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
        
        <center>
          <input type="submit" class="btn btn-primary" name="Submit" style="margin-bottom: 20px;">
          <p>if your have already account goto <a href="{{ url('form-filler/login') }}">login</a></p>
        </center>
      </form>
    </div>

    <div class="panel panel-default col-sm-8 box" id="operator" style="margin-top:50px;margin-bottom:50px;">
      <center><h2>Sign Up as a Operator</h2></center>
    
      <form method="post" action="{{ url('operator/signup') }}">
        @csrf
        <label><strong>Enter full name:</strong></label>
        <input type="text" class="form-control" name="operator_name" required="">
        @if($errors->has('operator_name'))
            <span class="" style="color: red;">{{ $errors->first('operator_name') }}</span>
             <script type="text/javascript">
                setTimeout(function(){ 
                    changeViewSignUp('operator', 'user');
                }, 3000); 
            </script>  
            
        @endif
        <br>
        <label><strong>Enter Email Id:</strong></label>
        <input type="email" class="form-control" name="operator_email" required="">
        @if($errors->has('operator_email'))
            <span class="" style="color: red;">{{ $errors->first('operator_email') }}</span>
             <script type="text/javascript">
                setTimeout(function(){ 
                    changeViewSignUp('operator', 'user');
                }, 3000); 
            </script>  
           
        @endif
        <br>
    
        <label><strong>Enter Contact Number:</strong></label>
        <input type="number" class="form-control" name="operator_contact_number" required="">
        @if($errors->has('operator_contact_number'))
            <span class="" style="color: red;">{{ $errors->first('operator_contact_number') }}</span>
            <script type="text/javascript">
                setTimeout(function(){ 
                    changeViewSignUp('operator', 'user');
                }, 3000); 
            </script>  
        @endif
        <br>
        <label><strong>Choose Your State:</strong></label>
        <div class="form-group">
          <select class="form-control" name="operator_state" required="">
            <option></option>
             <option></option>
            @foreach($data['states'] as $state)
                <option value="{{ $state->id }}">{{ $state->name }}</option>
            @endforeach
          </select>
        </div>
        <br>
        @if($errors->has('operator_state'))
            <span class="" style="color: red;">{{ $errors->first('operator_state') }}</span>
            <script type="text/javascript">
                setTimeout(function(){ 
                    changeViewSignUp('operator', 'user');
                }, 3000); 
            </script>  
        @endif

        <label><strong>Choose Your City:</strong></label>
        <div class="form-group">
          <select class="form-control" name="operator_city" required="">
            <option></option>
            @foreach($data['cities'] as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
                    <script type="text/javascript">
                    changeViewSignUp('operator', 'user');
                </script>
            @endforeach
          </select>
        </div>
        @if($errors->has('operator_city'))
            <span class="" style="color: red;">{{ $errors->first('operator_city') }}</span>
            <script type="text/javascript">
                setTimeout(function(){ 
                    changeViewSignUp('operator', 'user');
                }, 3000); 
            </script>  
        @endif
        <br>

        <label><strong>Enter Your Area Pincode:</strong></label>
        <input type="number" class="form-control" name="operator_pincode" required="">
        @if($errors->has('operator_pincode'))
            <span class="" style="color: red;">{{ $errors->first('operator_pincode') }}</span>
            <script type="text/javascript">
                setTimeout(function(){ 
                    changeViewSignUp('operator', 'user');
                }, 3000); 
            </script>  
        @endif
        <br>
        
        <label><strong>Enter Your Complete Address:</strong></label>
        <input type="text" class="form-control" name="operator_address" required="">
        @if($errors->has('operator_address'))
            <span class="" style="color: red;">{{ $errors->first('operator_address') }}</span>
             <script type="text/javascript">
                setTimeout(function(){ 
                    changeViewSignUp('operator', 'user');
                }, 3000); 
            </script>  
        @endif
        <br>

        <label><strong>Password:</strong></label>
        <input type="password" class="form-control" name="operator_password" required="">
        @if($errors->has('operator_password'))
            <span class="" style="color: red;">{{ $errors->first('operator_password') }}</span>
             <script type="text/javascript">
                setTimeout(function(){ 
                    changeViewSignUp('operator', 'user');
                }, 3000); 
            </script>  
        @endif

        <br>
        
        <label><strong>Confirm Password:</strong></label>
        <input type="password" class="form-control" name="operator_confirm_password" required="">
        @if($errors->has('operator_confirm_password'))
            <span class="" style="color: red;">{{ $errors->first('operator_confirm_password') }}</span>
             <script type="text/javascript">
                setTimeout(function(){ 
                    changeViewSignUp('operator', 'user');
                }, 3000); 
            </script>  
        @endif
        <br>
        <div class="checkbox">
          <label><input type="checkbox" name="checkbox" value="Yes" required=""> <a href="">Accept terms & conditions</a></label>
            @if($errors->has('checkbox'))
                <span class="" style="color: red;">{{ $errors->first('checkbox') }}</span>
                <script type="text/javascript">
                    setTimeout(function(){ 
                        changeViewSignUp('operator', 'user');
                    }, 3000); 
                </script>  
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