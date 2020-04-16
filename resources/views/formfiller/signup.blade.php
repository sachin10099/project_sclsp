@extends('front.front')
@section('content')

  <center>
    <div class="btn-group">
      <button onclick="changeViewSignUp('user', 'operator')">Sign Up as a User</button>
      <button onclick="changeViewSignUp('operator', 'user')">Sign Up as a Operator</button>
      <button>If your have already account goto login, click here</button>
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
        <input type="number" class="form-control" name="contact_number" required=""><br>

        <label><strong>Enter Address:</strong></label>
        @if($errors->has('address'))
            <span class="" style="color: red;">{{ $errors->first('address') }}</span>
        @endif
        <textarea class="form-control" name="address" row="4" required=""></textarea><br>
       
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
      <form>
        <label><strong>Enter full name:</strong></label>
        <input type="text" class="form-control" name="name" required=""><br>

        <label><strong>Choose Your Gender:</strong></label>
        <div class="radio">
          <label><input type="radio" name="gender" required=""> Male</label>
          <label><input type="radio" name="gender" required=""> Female</label>
        </div><br>

        <label><strong>Enter Email Id:</strong></label>
        <input type="email" class="form-control" name="email" required=""><br>

        <label><strong>Enter Contact Number:</strong></label>
        <input type="number" class="form-control" name="contact_number" required=""><br>

        <label><strong>Choose Your State:</strong></label>
        <div class="form-group">
          <select class="form-control" name="state" required="">
            <option></option>
            <option>Sitapur</option>
            <option>Mumbai</option>
            <option>Delhi</option>
            <option>Agra</option>
            <option>Banaras</option>
          </select>
        </div>
        <br>

        <label><strong>Choose Your City:</strong></label>
        <div class="form-group">
          <select class="form-control" name="city" required="">
            <option></option>
            <option>Sitapur</option>
            <option>Mumbai</option>
            <option>Delhi</option>
            <option>Agra</option>
            <option>Banaras</option>
          </select>
        </div>

        <label><strong>Enter Your Area Pincode:</strong></label>
        <input type="Password" class="form-control" name="pincode" required=""><br>

        <label><strong>Enter Your Complete Address:</strong></label>
        <input type="text" class="form-control" name="address" required=""><br>

        <label><strong>Password:</strong></label>
        <input type="password" class="form-control" name="password" required=""><br>

        <label><strong>Confirm Password:</strong></label>
        <input type="password" class="form-control" name="confirm_password" required=""><br>
        <div class="checkbox">
          <label><input type="checkbox" value="termcondition" required=""> <a href="">Accept terms & conditions</a></label>
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

<div class="row">

<div class="container">
        <div class="row db-padding-btm db-attached">
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="db-wrapper">
                    <div class="db-pricing-eleven db-bk-color-one">
                        <div class="price">
                            <sup><i class="fa fa-inr" aria-hidden="true"></i></sup>99
                                <small>per quarter</small>
                        </div>
                        <div class="type">
                            SMALL PLAN
                        </div>
                        <ul>

                            <li><i class="glyphicon glyphicon-print"></i>30+ Accounts </li>
                            <li><i class="glyphicon glyphicon-time"></i>150+ Projects </li>
                            <li><i class="glyphicon glyphicon-trash"></i>Lead Required</li>
                        </ul>
                        <div class="pricing-footer">

                            <a href="#" class="btn db-button-color-square btn-lg">BOOK ORDER</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                 <div class="db-wrapper">
                <div class="db-pricing-eleven db-bk-color-two popular">
                    <div class="price">
                        <sup><i class="fa fa-inr" aria-hidden="true"></i></sup>159
                                <small>per quarter</small>
                    </div>
                    <div class="type">
                        MEDIUM PLAN
                    </div>
                    <ul>

                        <li><i class="glyphicon glyphicon-print"></i>30+ Accounts </li>
                        <li><i class="glyphicon glyphicon-time"></i>150+ Projects </li>
                        <li><i class="glyphicon glyphicon-trash"></i>Lead Required</li>
                    </ul>
                    <div class="pricing-footer">

                        <a href="#" class="btn db-button-color-square btn-lg">BOOK ORDER</a>
                    </div>
                </div>
                     </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                 <div class="db-wrapper">
                <div class="db-pricing-eleven db-bk-color-three">
                    <div class="price">
                        <sup><i class="fa fa-inr" aria-hidden="true"></i></sup>799
                                <small>per quarter</small>
                    </div>
                    <div class="type">
                        ADVANCE PLAN
                    </div>
                    <ul>

                        <li><i class="glyphicon glyphicon-print"></i>30+ Accounts </li>
                        <li><i class="glyphicon glyphicon-time"></i>150+ Projects </li>
                        <li><i class="glyphicon glyphicon-trash"></i>Lead Required</li>
                    </ul>
                    <div class="pricing-footer">

                        <a href="#" class="btn db-button-color-square btn-lg">BOOK ORDER</a>
                    </div>
                </div>
                     </div>
            </div>

        </div>

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

  </script> 
@endsection