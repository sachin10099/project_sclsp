@extends('front.front')  
@section('content')
<div id="myModalstory" class="modal fade" role="dialog">
  <div class="modal-dialog">
  <!-- Modal content For Story Section -->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="title2">No Data Found</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p id="data2">Content Not Found.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      </div>
  </div>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex flex-column justify-content-center align-items-center" style="background: url('{{ $data['banner']['image'] }}') center center;">
    <div class="container" data-aos="fade-in">
      <h1>{{ $data['banner']['heading'] }}</h1>
      <h2>{!! $data['banner']['tagline'] !!}</h2>
      <div class="d-flex align-items-center">
        <i class="bx bxs-right-arrow-alt get-started-icon"></i>
        <a href="#services" class="btn-get-started scrollto">Get Started</a>
      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
      <div class="container">

        <div class="row">
          <div class="col-xl-4 col-lg-5" data-aos="fade-up">
            <div class="content">
              <h3>{{ $data['why_choose']['heading'] }}</h3>
              <p>{!! $data['why_choose']['desc'] !!}</p>
            </div>
          </div>
          <div class="col-xl-8 col-lg-7 d-flex">
            <div class="icon-boxes d-flex flex-column justify-content-center">
              <div class="row">
                @foreach($data['services'] as $service)
                <div class="col-xl-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="{{ $service->icon }}" style="color: blue;"></i>
                    <h4 style="color: red;">{{ $service->heading }}</h4>
                    <p>{!! str_limit($service->desc, $limit = 80, $end = '...') !!}</p>
                    <a href="#services">View More</a>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Why Us Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Services</h2>
          <p>{!! $data['service_content']['desc'] !!}</p>
        </div>

        <div class="row">
          @foreach($data['services'] as $service)
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="{{ $service->icon }}"></i></div>
              <h4 class="title"><a href="">{{ $service->heading }}</a></h4>
              @php
                    $char_count = strlen($service->desc);
              @endphp
                  <p>{!! str_limit($service->desc, $limit = 115, $end = '...') !!} 
              @if($char_count > 115)</p>
                   <p  id="btn-services" style="pointer:cursor;" 
                   onclick="openModel({{ $service }})" class="btn-get-started scrollto">View More</p>
              @endif
              @if($service->icon == 'icofont-edit')
                <a href="{{ url('form-filler/index') }}"><button class="btn btn-primary service-btn">Explore</button></a>
              @else
                <button class="btn btn-primary service-btn">Explore</button>
              @endif
            </div>
          </div>
          @endforeach
      </div>
    </section><!-- End Services Section -->

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients">
      <div class="container" data-aos="fade-up">

        <div class="owl-carousel clients-carousel">
          <img src="{{ asset('/') }}public/assets/img/clients/client-1.png" alt="">
          <img src="{{ asset('/') }}public/assets/img/clients/client-2.png" alt="">
          <img src="{{ asset('/') }}public/assets/img/clients/client-3.png" alt="">
          <img src="{{ asset('/') }}public/assets/img/clients/client-4.png" alt="">
          <img src="{{ asset('/') }}public/assets/img/clients/client-5.png" alt="">
          <img src="{{ asset('/') }}public/assets/img/clients/client-6.png" alt="">
          <img src="{{ asset('/') }}public/assets/img/clients/client-7.png" alt="">
          <img src="{{ asset('/') }}public/assets/img/clients/client-8.png" alt="">
        </div>

      </div>
    </section><!-- End Clients Section -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
      <div class="container">

        <div class="row">
          <div class="col-xl-5 col-lg-6 video-box d-flex justify-content-center align-items-stretch" data-aos="fade-right" style=" background: url('{{ $data['about']['image']  }}') center center no-repeat; background-size: cover; min-height: 500px;">
            <a href="{{ $data['about']['video_url'] }}" class="venobox play-btn mb-4" data-vbtype="video" data-autoplay="true"></a>
          </div>

          <div class="col-xl-7 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5">
            <h4 data-aos="fade-up">About us</h4>
            <h3 data-aos="fade-up">{{ $data['about']['heading'] }}</h3>
              @php
                    $char_count = strlen($data['about']['desc']);
              @endphp
                  <p>{!! str_limit($data['about']['desc'], $limit = 650, $end = '...') !!} 
              @if($char_count > 650)</p>
                   <p  id="btn-services" style="pointer:cursor;" 
                   onclick="openModel({{ $data['about'] }})" class="btn-get-started scrollto">View More</p>
              @endif
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    

    <!-- ======= Values Section ======= -->
    <section id="values" class="values">
      <div class="container">

        <div class="row">
          @foreach($data['scopes'] as $scopes)
          <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up" style="margin-top: 10px;">
            <div class="card" style="background-image: url({{ $scopes->image }});">
              <div class="card-body">
                <h5 class="card-title"><a href="">{{ $scopes->heading }}</a></h5>
                @php
                    $char_count = strlen($scopes->desc);
                @endphp 
                    <p class="card-text">{!! str_limit($scopes->desc, $limit = 85, $end = '...') !!}</p>
                @if($char_count > 85)
                  <div class="read-more" onclick="openModel({{ $scopes }})"><i class="icofont-arrow-right"></i> Read More</div>
                @endif
                
                
              </div>
            </div>
          </div>
          @endforeach
        
        </div>

      </div>
    </section><!-- End Values Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
      <div class="container" data-aos="fade-up">

        <div class="owl-carousel testimonials-carousel">
          @foreach($data['testimonials'] as $testimonial)
          <div class="testimonial-item">
            <img src="{{ $testimonial->image }}" class="testimonial-img" alt="">
            <h3>{{ $testimonial->name }}</h3>
            <h4>{{ $testimonial->designation }}</h4>
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
               @php
                    $char_count = strlen($testimonial->desc);
                @endphp 
                    <p class="card-text">{!! str_limit($testimonial->desc, $limit = 150, $end = '...') !!}
                @if($char_count > 150)
                  <span class="read-more" onclick="openModel({{ $testimonial }})"><i class="icofont-arrow-right"></i> Read More</span>

                @endif
                 </p>
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
          </div>
          @endforeach
        
        </div>

      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team">
      <div class="container">

        <div class="section-title">
          <h2 data-aos="fade-up">Team</h2>
        </div>

        <div class="row">

          @foreach($data['teams'] as $team)
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up">
            <div class="member">
              <div class="member-img">
                <img src="{{ $team->image }}" class="img-fluid" alt="">
                <div class="social">
                  <a href="{{ $team->twitter_link }}" target="_blank"><i class="icofont-twitter"></i></a>
                  <a href="{{ $team->facebook_link }}" target="_blank"><i class="icofont-facebook"></i></a>
                  <a href="{{ $team->insta_link }}" target="_blank"><i class="icofont-instagram"></i></a>
                  <a href="{{ $team->linkedin_link }}" target="_blank"><i class="icofont-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>{{ $team->name }}</h4>
                <span>{{ $team->designation }}</span>
              </div>
            </div>
          </div>
          @endforeach
        </div>

      </div>
    </section><!-- End Team Section -->

    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq section-bg">
      <div class="container">

        <div class="section-title">
          <h2 data-aos="fade-up">F.A.Q</h2>
          <p data-aos="fade-up">{!! $data['faq_content']['desc']  !!}</p>
        </div>

        <div class="faq-list">
          <ul>
            @php
              $i = 0;
            @endphp
            @foreach($data['faqs'] as $faq)
            @php
              $i++;
            @endphp
            <li data-aos="fade-up" data-aos-delay="100">
              <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#faq-list-2{{$i}}" class="collapsed">{{ $faq->question }}<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-2{{$i}}" class="collapse" data-parent=".faq-list">
                <p>
                 {!! $faq->answer !!}
                </p>
              </div>
            </li>
            @endforeach
          </ul>
        </div>

      </div>
    </section><!-- End F.A.Q Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2 data-aos="fade-up">Contact</h2>
        </div>

        <div class="row justify-content-center">

          <div class="col-xl-3 col-lg-4 mt-4" data-aos="fade-up">
            <div class="info-box">
              <i class="bx bx-map"></i>
              <h3>Our Address</h3>
              <p>{{ $data['address']->data  }}</p>
            </div>
          </div>

          <div class="col-xl-3 col-lg-4 mt-4" data-aos="fade-up" data-aos-delay="100">
            <div class="info-box">
              <i class="bx bx-envelope"></i>
              <h3>Email Us</h3>
              @foreach($data['emails'] as $email)
                <p>{{ $email->data }}</p>
              @endforeach
            </div>
          </div>
          <div class="col-xl-3 col-lg-4 mt-4" data-aos="fade-up" data-aos-delay="200">
            <div class="info-box">
              <i class="bx bx-phone-call"></i>
              <h3>Call Us</h3>
              @foreach($data['contacts'] as $contact)
                <p>{{ $contact->data }}</p>
              @endforeach
            </div>
          </div>
        </div>

        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="300">
          <div class="col-xl-9 col-lg-12 mt-4">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="form-row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validate"></div>
                </div>
                <div class="col-md-6 form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <textarea class="form-control" id="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                <div class="validate"></div>
              </div>
              <div class="mb-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="button" class="btn btn-danger" onclick="sendQuery()">Send Message</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->
  <script type="text/javascript">
    document.getElementById('loader').style.display = "none";
    function openModel(data) {
        $("#myModalstory").modal("show");
        document.getElementById("title2").innerHTML = data.heading;
        document.getElementById("data2").innerHTML = data.desc;
    }

    function sendQuery() {
      var name    = $('#name').val();
      var email   = $('#email').val();
      var message = $('#message').val();
      var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
      if(name === '') {
        swal("", "Name field must be required.", "warning");
        return false;
      }
      if(name.length > 150) {
        alert('Name must be less than 150 charactors.');
        return false;
      }
      if(email === '') {
        swal("", "Email field must be required.", "warning");
        return false;
      }
      if (reg.test(email) == false) 
        {
            swal("", 'Invalid Email Address.', "warning");
            return false;
        }
      if(message === '') {
        swal("", "Message field must be required.", "warning");
        return false;
      }
      document.getElementById('loader').style.display = 'block';
      $.ajax({
            method:'post',
            url   : "{{ url('user/send-query') }}",
            data  : {
                "_token": "{{ csrf_token() }}",
                'name'    : name,
                'email'   : email,
                'message' : message
            },
            success: function(data){
                document.getElementById('loader').style.display = 'none';
                swal(data, 'Soon your problem will be resolved efficiently. Answer will be provided to you through email.', "success");
                setTimeout(function(){ 
                    location.reload();
                }, 5000);
            }
        });
    }

    function subscribe() {
      var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
      var email = $('#subscribe_email').val();
      if(email === '') {
        swal("", "Email field must be required.", "warning");
        return false;
      }

      if (reg.test(email) == false) {
            swal("", 'Invalid Email Address.', "warning");
            return false;
      }
      document.getElementById('loader').style.display = 'block';
      $.ajax({
            method:'post',
            url   : "{{ url('subscribe') }}",
            data  : {
                "_token": "{{ csrf_token() }}",
                'email'    : email
            },
            success: function(data){
                document.getElementById('loader').style.display = 'none';
                swal('Thank You', data, "success");
                setTimeout(function(){ 
                    location.reload();
                }, 4000);
            }
        });
    }
  </script>
  @endsection