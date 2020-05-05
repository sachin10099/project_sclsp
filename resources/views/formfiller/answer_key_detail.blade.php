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
    <div class="container-fluid">
        <div class="owl-carousel owl-theme">
          <div class="item">
            <div class="card" style="max-width: 95%">
              <div class="card-body">
                <p> <i class="fa fa-life-ring" aria-hidden="true" style="font-size: 30px;color:blue;margin-top: 11px;"></i>&nbsp;&nbsp;Save Money, Save Time <br> Save Tree</p>
                <hr>
                <center><p>Paper Less</p></center>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="card" style="max-width: 95%">
              <div class="card-body">
                <p><i class="fa fa-bug" aria-hidden="true" style="font-size: 30px;color:red;margin-top: 11px;"></i>&nbsp;&nbsp;Any Issues 24/7 Video Guides & Call On 7905184088</p>
                <hr>
                <center><p>Personal Help</p></center>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="card" style="max-width: 95%">
              <div class="card-body">
                <p><i class="fa fa-clock-o" aria-hidden="true" style="font-size: 30px;color:skyblue;margin-top: 11px;"></i>&nbsp;&nbsp;Work Done Minimum With in 24 Houres&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                <hr>
                <center><p>Tension Free</p></center>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="card" style="max-width: 95%">
              <div class="card-body">
                <p><i class="fa fa-phone" aria-hidden="true" style="font-size: 30px;color:skyblue;margin-top: 11px;"></i>&nbsp;&nbsp;{{ $data['admin_info']['contact_number'] }}<br>{{ $data['admin_info']['email'] }}</p>
                <hr>
                <center><p>Ready For Help</p></center>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>

      <div class="container-fluid" style="margin-top: 10px;margin-bottom: 40px;">
        <h3>Answer Key With Documents:</h3>
        <br>
        <div class="row">
          @foreach($data['answerKeyDetails']->getRetaltedDoc as $data)
          <div class="col-sm-4">
            <div class="card" style="width: 100%;margin-top: 10px;">
              <div class="card-body">
                <h5 class="card-title" style="color: black;">Region Name: {!! $data->region_name !!}</h5>
                <p class="">Visit Official Link: 
                  @if($data->official_links)
                    <a href="{{$data->official_links}}">
                      <i class="fa fa-globe" aria-hidden="true" style="color: green;font-size: 15px;"></i> Click here</a>
                    </p>
                  @else
                    <span style="color: orange;">Not Found.</span><br>
                  @endif
                <br>
                @if($data->documents)
                  <a href="{{$data->documents}}" class="btn btn-primary" style="background-color: blue;color: white;" download>Download File</a>
                @else
                  <a href="{{$data->documents}}" class="btn btn-primary" style="background-color: blue;color: white;" disable>Download File</a>
                @endif
                
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

  var datatable;
  $(document).ready(function() {
      document.getElementById('loader').style.display = "none";
        datatable = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! url('form-filler/answer-key/data') !!}', 
        "aoColumnDefs": [ {
               "aTargets": [ 1 ],
               "mRender": function ( data, type, full ) {
                return $("<div/>").html(data).text(); 
                }
            } ],
        order:[
          [0,"DESC"]
        ],
        columns: [
            { data: 'id', name: 'id' },
            { data: 'title', name: 'title' },
            { data: 'official_link', name: 'official_link'},
            { data: 'action', name: 'action', orderable: false, searchable: false}
           
        ]
    });
  });
  </script>
@endsection