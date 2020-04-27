@extends('front.formfiller')
@section('content')
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
    <header class="site-navbar mt-3">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="site-logo col-6"><a href="{{ url('form-filler/index') }}"><img src="{{ asset('/') }}public/assets/img/logo/logo1.jpg" style="max-width:100px;max-height:100px;" alt="Company Logo"></a></div>
          <nav class="mx-auto site-navigation">
            <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
              <li class="d-lg-none"><a href="post-job.html">Post a Job</a></li>
              <li class="d-lg-none"><a href="login.html">Log In</a></li>
            </ul>
          </nav>
          <div class="right-cta-menu text-right d-flex aligin-items-center col-6">
            <div class="ml-auto">
              <a href="{{ asset('form-filler/login') }}" class="btn btn-default border-width-2 d-none d-lg-inline-block" style="background-color:red;color:white;"><span class="mr-2 icon-lock_outline"></span>Log In</a>
            </div>
            <a href="#" class="site-menu-toggle js-menu-toggle d-inline-block d-xl-none mt-lg-2 ml-3"><span class="icon-menu h3 m-0 p-0 mt-2"></span></a>
          </div>

        </div>
      </div>
    </header>

    <!-- HOME -->
    <section class="home-section section-hero overlay bg-image" style="background-image: url('{{ asset('/') }}public/asset2/images/back1.jpg');" id="home-section">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-12">
            <div class="mb-5 text-center">
              <h1 class="text-white font-weight-bold" style="margin-top: 10px;">We Provide Best Way To Get Your Dream Job</h1>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate est, consequuntur perferendis.</p>
            </div>
            <form method="post" class="search-jobs-form">
              <div class="row mb-5">
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                  <input type="text" class="form-control form-control-lg" placeholder="Job title, Company...">
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                  <select class="selectpicker" data-style="btn-white btn-lg" data-width="100%" data-live-search="true" title="Select Region">
                    <option>Anywhere</option>
                    <option>San Francisco</option>
                    <option>Palo Alto</option>
                    <option>New York</option>
                    <option>Manhattan</option>
                    <option>Ontario</option>
                    <option>Toronto</option>
                    <option>Kansas</option>
                    <option>Mountain View</option>
                  </select>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                  <select class="selectpicker" data-style="btn-white btn-lg" data-width="100%" data-live-search="true" title="Select Job Type">
                    <option>Part Time</option>
                    <option>Full Time</option>
                  </select>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                  <button type="submit" class="btn btn-primary btn-lg btn-block text-white btn-search"><span class="icon-search icon mr-2"></span>Search Job</button>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 popular-keywords">
                  <h3>Go to home: </h3>
                  <ul class="keywords list-unstyled m-0 p-0">
                    <li><a href="{{ url('/') }}" class="">Click</a></li>
                  </ul>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <a href="#next" class="scroll-button smoothscroll">
        <span class=" icon-keyboard_arrow_down"></span>
      </a>

    </section>
    
    <section class="py-5 bg-image overlay-primary fixed overlay" id="next" style="background-image: url('{{ asset('/') }}public/asset2/images/hero_1.jpg');">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2 text-black">Our Form Filler Status</h2>
            <p class="lead text-black">Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita unde officiis recusandae sequi excepturi corrupti.</p>
          </div>
        </div>
        <div class="row pb-0 block__19738 section-counter">

          <div class="col-sm-4">
            <div class="d-flex align-items-center justify-content-center mb-2">
              <strong class="number" data-number="1930" style="color:black;">0</strong>
            </div>
            <span class="caption" style="color:black;">Our Candidates</span>
          </div>

          <div class="col-sm-4">
            <div class="d-flex align-items-center justify-content-center mb-2">
              <strong class="number" data-number="54" style="color:black;">0</strong>
            </div>
            <span class="caption" style="color:black;">Jobs Posted</span>
          </div>

          <div class="col-sm-4">
            <div class="d-flex align-items-center justify-content-center mb-2">
              <strong class="number" data-number="120" style="color:black;">0</strong>
            </div>
            <span class="caption" style="color:black;">Jobs Filled</span>
          </div>
            
        </div>
      </div>
    </section>
	
    <section class="site-section">
        <div class="row">
          <div class="col-sm-4">
              <div class="w3-container" style="margin-top: 20px;">
                <div class="w3-card-4" style="width:100%;">
                  <header class="w3-container w3-red">
                    <h3 style="color: white;">Latest Jobs</h3>
                  </header>
                  <div class="">
                    <ul class="w3-ul">
                      <li>Bihar City Manager Online Form 2020</li>
                      <li>BPSC Project Manager Online Form 2020 (Re Open)</li>
                      <li>UPPSC Pre 2020 / ACF/ RFO Online Form</li>
                    </ul>
                  </div>
                  <footer class="w3-container w3-red">
                    <a href="">View All</a>
                  </footer>
                </div>
              </div>
          </div>
          <div class="col-sm-4">
              <div class="w3-container" style="margin-top: 20px;">
              <div class="w3-card-4" style="width:100%;">
                <header class="w3-container w3-red">
                  <h3 style="color: white;">Admin Cards / Answer Keys</h3>
                </header>

                <div class="">
                  <ul class="w3-ul">
                      <li>Bihar City Manager Online Form 2020</li>
                      <li>BPSC Project Manager Online Form 2020 (Re Open)</li>
                      <li>UPPSC Pre 2020 / ACF/ RFO Online Form</li>
                  </ul>
                </div>

                <footer class="w3-container w3-red">
                  <a href="">View All</a>
                </footer>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
              <div class="w3-container" style="margin-top: 20px;">
                <div class="w3-card-4" style="width:100%;">
                  <header class="w3-container w3-red">
                    <h3 style="color: white;">Results</h3>
                  </header>
                  <div class="">
                    <ul class="w3-ul">
                      <li>Bihar City Manager Online Form 2020</li>
                      <li>BPSC Project Manager Online Form 2020 (Re Open)</li>
                      <li>UPPSC Pre 2020 / ACF/ RFO Online Form</li>
                    </ul>
                  </div>

                  <footer class="w3-container w3-red">
                    <a href="">View All</a>
                  </footer>
                </div>
              </div>
          </div>
          
        </div>
    </section>


 <center><h3><strong style="color: red;">Note: </strong>Plans only applicable for Operator Users</h3></center>
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

    
    <section class="py-5 bg-image overlay-primary fixed overlay" style="background-image: url('images/hero_1.jpg');">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-8">
            <h2 class="text-white">Looking For A Job?</h2>
            <p class="mb-0 text-white lead">Lorem ipsum dolor sit amet consectetur adipisicing elit tempora adipisci impedit.</p>
          </div>
          <div class="col-md-3 ml-auto">
            <a href="{{ url('form-filler/signup') }}" class="btn btn-warning btn-block btn-lg">Sign Up</a>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection