@extends('front.formfiller')
@section('content')
<style type="text/css">
  /* The sticky class is added to the header with JS when it reaches its scroll position */
.sticky {
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 100;
}
ul.b {
  list-style-type: square;
}

</style>
<div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->


    <!-- NAVBAR -->
    <header class="sticky" style="background-image:linear-gradient(to right, red , #FFEBCD,lightgray)">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="site-logo col-6"><a href="{{ url('form-filler/index') }}"><img src="{{ asset('/') }}public/assets/img/logo/logo1.jpg" style="max-width:100px;max-height:100px;" alt="Company Logo"></a></div>
          <nav class="mx-auto site-navigation">
            <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
              <li class="d-lg-none"><a href="{{ url('form-filler/signup') }}">Sign Up</a></li>
              <li class="d-lg-none"><a href="{{ url('form-filler/login') }}">Log In</a></li>
            </ul>
          </nav>
          <div class="right-cta-menu text-right d-flex aligin-items-center col-6">
            <div class="ml-auto">
               <a href="{{ url('form-filler/signup') }}" class="btn btn-default border-width-2 d-none d-lg-inline-block" style="background-color:skyblue;color:white;"><span class="mr-2 icon-lock_outline"></span>Sign Up</a>&nbsp;
              <a href="{{ url('form-filler/login') }}" class="btn btn-default border-width-2 d-none d-lg-inline-block" style="background-color:red;color:white;"><span class="mr-2 icon-lock_outline"></span>Log In</a>
            </div>
            <a href="#" class="site-menu-toggle js-menu-toggle d-inline-block d-xl-none mt-lg-2 ml-3"><span class="icon-menu h3 m-0 p-0 mt-2"></span></a>
          </div>

        </div>
      </div>
    </header>
    <div style="padding-top: 100px;">
    <div class="large-12 columns">
        <div class="owl-carousel owl-theme">
          <div class="item">
            <div class="w3-container" style="margin-top: 20px;">
            <div class="w3-card-4" style="width:100%;">
              <div class="container">

                <p> <i class="fa fa-life-ring" aria-hidden="true" style="font-size: 30px;color:blue;margin-top: 11px;"></i>&nbsp;&nbsp;Save Money, Save Time <br> Save Tree</p>
                <hr>
                <center><p>Paper Less</p></center>
              </div>
            </div>
          </div>
          </div>
          <div class="item">
            <div class="w3-container" style="margin-top: 20px;">
            <div class="w3-card-4" style="width:100%;">
              <div class="container">
                <p><i class="fa fa-bug" aria-hidden="true" style="font-size: 30px;color:red;margin-top: 11px;"></i>&nbsp;&nbsp;Any Issues 24/7 Video Guides & Call On 7905184088</p>
                <hr>
                <center><p>Personal Help</p></center>
              </div>
            </div>
          </div>
          </div>
          <div class="item">
            <div class="w3-container" style="margin-top: 20px;">
            <div class="w3-card-4" style="width:100%;">
              <div class="container">
                <p><i class="fa fa-clock-o" aria-hidden="true" style="font-size: 30px;color:skyblue;margin-top: 11px;"></i>&nbsp;&nbsp;Work Done Minimum With in 24 Houres</p>
                <hr>
                <center><p>Tension Free</p></center>
              </div>
            </div>
          </div>
          </div>
          <div class="item">
            <div class="w3-container" style="margin-top: 20px;">
            <div class="w3-card-4" style="width:100%;">
              <div class="container">
                <p><i class="fa fa-phone" aria-hidden="true" style="font-size: 30px;color:skyblue;margin-top: 11px;"></i>&nbsp;&nbsp;{{ $data['admin_info']['contact_number'] }}<br>{{ $data['admin_info']['email'] }}</p>
                <hr>
                <center><p>Ready For Help</p></center>
              </div>
            </div>
          </div>
          </div>
        </div>
        </div>
      </div>

        <section class="">
        <div class="row">
          <div class="col-sm-4">
              <div class="w3-container">
                <div class="w3-card-4" style="width:100%;">
                  <header class="w3-container w3-red">
                    <center><h4 style="color: white;">Latest Jobs</h4></center>
                  </header>
                  <div class="">
                    <ul class="b">
                      <li>Bihar City Manager Online Form 2020</li>
                      <li>BPSC Project Manager Online Form 2020 (Re Open)</li>
                      <li>UPPSC Pre 2020 / ACF/ RFO Online Form</li>
                      <li>UPPSC Pre 2020 / ACF/ RFO Online Form</li>
                      <li>UPPSC Pre 2020 / ACF/ RFO Online Form</li>
                      <li>UPPSC Pre 2020 / ACF/ RFO Online Form</li>
                      <li>UPPSC Pre 2020 / ACF/ RFO Online Form</li>
                      <li>UPPSC Pre 2020 / ACF/ RFO Online Form</li>
                      <li>UPPSC Pre 2020 / ACF/ RFO Online Form</li>
                      <li>UPPSC Pre 2020 / ACF/ RFO Online Form</li>
                    </ul>
                  </div>
                  <footer class="w3-container w3-red">
                    <center><a href="">View All</a></center>
                  </footer>
                </div>
              </div>
          </div>
          <div class="col-sm-4">
              <div class="w3-container">
              <div class="w3-card-4" style="width:100%;">
                <header class="w3-container w3-red">
                  <center><h4 style="color: white;">Admin Cards / Answer Keys</h4></center>
                </header>

                <div class="">
                  <ul class="b">
                      <li>Bihar City Manager Online Form 2020</li>
                      <li>BPSC Project Manager Online Form 2020 (Re Open)</li>
                      <li>UPPSC Pre 2020 / ACF/ RFO Online Form</li>
                      <li>UPPSC Pre 2020 / ACF/ RFO Online Form</li>
                      <li>UPPSC Pre 2020 / ACF/ RFO Online Form</li>
                      <li>UPPSC Pre 2020 / ACF/ RFO Online Form</li>
                      <li>UPPSC Pre 2020 / ACF/ RFO Online Form</li>
                      <li>UPPSC Pre 2020 / ACF/ RFO Online Form</li>
                      <li>UPPSC Pre 2020 / ACF/ RFO Online Form</li>
                      <li>UPPSC Pre 2020 / ACF/ RFO Online Form</li>
                  </ul>
                </div>

                <footer class="w3-container w3-red">
                  <center><a href="">View All</a></center>
                </footer>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
              <div class="w3-container">
                <div class="w3-card-4" style="width:100%;">
                  <header class="w3-container w3-red">
                    <center><h4 style="color: white;">Results</h4></center>
                  </header>
                  <div class="">
                    <ul class="b">
                      <li>Bihar City Manager Online Form 2020</li>
                      <li>BPSC Project Manager Online Form 2020 (Re Open)</li>
                      <li>UPPSC Pre 2020 / ACF/ RFO Online Form</li>
                      <li>UPPSC Pre 2020 / ACF/ RFO Online Form</li>
                      <li>UPPSC Pre 2020 / ACF/ RFO Online Form</li>
                      <li>UPPSC Pre 2020 / ACF/ RFO Online Form</li>
                      <li>UPPSC Pre 2020 / ACF/ RFO Online Form</li>
                      <li>UPPSC Pre 2020 / ACF/ RFO Online Form</li>
                      <li>UPPSC Pre 2020 / ACF/ RFO Online Form</li>
                      <li>UPPSC Pre 2020 / ACF/ RFO Online Form</li>
                    </ul>
                  </div>

                  <footer class="w3-container w3-red">
                    <center><a href="">View All</a></center>
                  </footer>
                </div>
              </div>
          </div>
          
        </div>
    </section>

    <section class="py-5  fixed overlay" id="next" style="background-color: lightgray;margin-top: 80px;">
      <div class="container" >
        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2 text-black">Our Form Filler Status</h2>
          </div>
        </div>
        <div class="row pb-0 block__19738 section-counter">

          <div class="col-sm-4">
            <div class="d-flex align-items-center justify-content-center mb-2">
              <strong class="number" data-number="{{ $data['form_user_count'] }}" style="color:black;">0</strong>
            </div>
            <span class="caption" style="color:black;">Our Candidates</span>
          </div>

          <div class="col-sm-4">
            <div class="d-flex align-items-center justify-content-center mb-2">
              <strong class="number" data-number="{{ $data['jobs'] }}" style="color:black;">0</strong>
            </div>
            <span class="caption" style="color:black;">Jobs Posted</span>
          </div>

          <div class="col-sm-4">
            <div class="d-flex align-items-center justify-content-center mb-2">
              <strong class="number" data-number="{{ $data['applied_job'] }}" style="color:black;">0</strong>
            </div>
            <span class="caption" style="color:black;">Jobs Filled</span>
          </div>
            
        </div>
      </div>
    </section>

 <center><h3 style="margin-top: 80px;"><strong style="color: red;">Note: </strong>Plans only applicable for Operator Users</h3></center>
    <div class="container">
        <div class="row db-padding-btm db-attached">
          @foreach($data['plans'] as $plan)
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="db-wrapper">
                    <div class="{{ $plan->class_name }}">
                        <div class="price">
                            <sup><i class="fa fa-inr" aria-hidden="true"></i></sup>{{ $plan->plan_price }}
                              
                        </div>
                        <div class="type">
                            {{ $plan->plan_name }}
                        </div>
                        <ul>
                          <li><i class="glyphicon glyphicon-print"></i>{{ $plan->validity }} Account Activation </li>
                        </ul>
                        <div class="pricing-footer">

                            <a href="#" class="btn db-button-color-square btn-lg">BOOK ORDER</a>
                        </div>
                    </div>
                </div>
            </div>
          @endforeach
        </div>

    </div>

    
    <section class="py-5 bg-image overlay-primary fixed overlay">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-8">
            <h2 class="text-white">Looking For A Job?</h2>
            <p class="mb-0 text-white lead">You are welcome in our online job portal, here you can find your dream job by following just a few steps</p>
          </div>
          <div class="col-md-3 ml-auto">
            <a href="{{ url('form-filler/signup') }}" class="btn btn-warning btn-block btn-lg">Sign Up</a>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script type="text/javascript">
    $(document).ready(function(){
      $(".owl-carousel").owlCarousel({
        autoplay: true,
        lazyLoad: true,
        loop: true,
        responsiveClass: true,
        autoHeight: true,
        autoplayTimeout: 7000,
        smartSpeed: 800,
        nav: true,
        responsive: {
          0: {
            items: 1
          },

          600: {
            items: 3
          },

          1024: {
            items: 4
          },

          1366: {
            items: 4
          }
        }
      });
    });
  </script>
@endsection