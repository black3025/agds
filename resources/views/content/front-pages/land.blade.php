@extends('layouts/blankLayout')

@section('title', 'Welcome')

@section('page-style')
<!-- Page -->
<!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

<!-- bootstrap core css -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/landing/style.css')}}" />

<!-- fonts style -->
<link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="{{ asset('assets/css/landing/style.css')}}" rel="stylesheet" />
<!-- responsive style -->
<link  href="{{ asset('assets/css/landing/responsive.css')}}" rel="stylesheet" />
@endsection

@section('content')
<div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="{{url('/')}}">
            <span>
              Amber Graceal Dance Studio  
            </span>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
              <ul class="navbar-nav  ">
                <li class="nav-item active">
                  <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="#why"> Why us </a>
                </li>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#instructors"> Instructors</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#contact-us"> Contact Us</a>
                </li>
                   <li class="nav-item">
                  <a class="nav-link" href="{{route('login')}}"> Login</a>
                </li>
                </li>
                   <li class="nav-item">
                  <a class="nav-link" href="{{route('auth-register')}}"> Register</a>
                </li>
              </ul>
              <div class="user_option">
                <form class="form-inline my-2 my-lg-0 ml-0 ml-lg-4 mb-3 mb-lg-0">
                  <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>
                </form>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
    <!-- slider section -->
    <section class=" slider_section position-relative">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container">
              <div class="col-lg-10 col-md-11 mx-auto">
                <div class="detail-box">
                  <div>
                    <h3>
                      Art
                    </h3>
                    <h2>
                      Dance
                    </h2>
                    <h1>
                      Music
                    </h1>
                    <p>
                      A place to grow your talent..
                    </p>
                    <div class="">
                      <a href="#contact-us">
                        Contact Us
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        {{-- <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
        </ol> --}}
      </div>
    </section>
    <!-- end slider section -->
  </div>


  <!-- Us section -->

  <section class="us_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2 class="force_white" id = "why">
          Why Choose Us
        </h2>
      </div>

      <div class="us_container ">
        <div class="row">
          <div class="col-lg-3 col-md-6">
            <div class="box">
              <div class="img-box">
                <img src= {{asset('assets/img/index/u-1.png')}} alt="">
              </div>
              <div class="detail-box">
                <h5 class="force_white">
                  QUALITY EQUIPMENT
                </h5>
                <p>
                  ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="box">
              <div class="img-box">
                <img src= {{asset('assets/img/index/u-4.png')}} alt="">
              </div>
              <div class="detail-box">
                <h5 class="force_white">
                  NUTRITION
                </h5>
                <p>
                  ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="box">
              <div class="img-box">
                <img src= {{asset('assets/img/index/u-2.png')}} alt="">
              </div>
              <div class="detail-box">
                <h5 class="force_white">
                  HEALTHY DIET PLAN
                </h5>
                <p>
                  ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="box">
              <div class="img-box">
                <img src= {{asset('assets/img/index/u-3.png')}} alt="">
              </div>
              <div class="detail-box">
                <h5 class="force_white">
                  SPORT TRAINING
                </h5>
                <p>
                  ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end us section -->


  <!-- heathy section -->

  <section class="heathy_section layout_padding">
    <div class="container">

      <div class="row">
        <div class="col-md-12 mx-auto">
          <div class="detail-box">
            <h2 class="force_white">
              HEALTHY MIND, HEALTHY BODY
            </h2>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillumLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
            </p>
            <div class="btn-box">
              <a href="">
                READ MORE
              </a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- end heathy section -->

  <!-- trainer section -->

  <section class="trainer_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2 id = "instructors" class="force_white">
          Our Instructors
        </h2>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-6 mx-auto">
          <div class="box">
            <div class="name">
              <h5>
                Amber
              </h5>
            </div>
            <div class="img-box">
              <img src= {{asset('assets/img/index/t1.jpg')}} alt="">
            </div>
            <div class="social_box">
              <a href="">
                <img src= {{asset('assets/img/index/facebook-logo.png')}} alt="">
              </a>
              <a href="">
                <img src= {{asset('assets/img/index/twitter.png')}} alt="">
              </a>
              <a href="">
                <img src= {{asset('assets/img/index/instagram-logo.png')}} alt="">
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mx-auto">
          <div class="box">
            <div class="name">
              <h5>
                Grace
              </h5>
            </div>
            <div class="img-box">
              <img src= {{asset('assets/img/index/t2.jpg')}} alt="">
            </div>
            <div class="social_box">
              <a href="">
                <img src= {{asset('assets/img/index/facebook-logo.png')}} alt="">
              </a>
              <a href="">
                <img src= {{asset('assets/img/index/twitter.png')}} alt="">
              </a>
              <a href="">
                <img src= {{asset('assets/img/index/instagram-logo.png')}} alt="">
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mx-auto">
          <div class="box">
            <div class="name">
              <h5>
                Dance
              </h5>
            </div>
            <div class="img-box">
              <img src= {{asset('assets/img/index/t3.jpg')}} alt="">
            </div>
            <div class="social_box">
              <a href="">
                <img src= {{asset('assets/img/index/facebook-logo.png')}} alt="">
              </a>
              <a href="">
                <img src= {{asset('assets/img/index/twitter.png')}} alt="">
              </a>
              <a href="">
                <img src= {{asset('assets/img/index/instagram-logo.png')}} alt="">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end trainer section -->

  <!-- contact section -->

  <section class="contact_section ">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 px-0">
          <div class="img-box">
            <img src= {{asset('assets/img/index/contact-img.jpg')}} alt="" id="contact-us">
          </div>
        </div>
        <div class="col-lg-5 col-md-6" >
          <div class="form_container pr-0 pr-lg-5 mr-0 mr-lg-2">
            <div class="heading_container">
              <h2 >
                Contact Us
              </h2>
            </div>
            <form action="">
              <div>
                <input type="text" placeholder="Name" />
              </div>
              <div>
                <input type="email" placeholder="Email" />
              </div>
              <div>
                <input type="text" placeholder="Phone Number" />
              </div>
              <div>
                <input type="text" class="message-box" placeholder="Message" />
              </div>
              <div class="d-flex ">
                <button>
                  Send
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end contact section -->

  <!-- info section -->
  <section class="info_section layout_padding2">
    <div class="container">
      <div class="info_items">
        <a href="">
          <div class="item ">
            <div class="img-box box-1">
              <img src="" alt="">
            </div>
            <div class="detail-box">
              <p>
                Location
              </p>
            </div>
          </div>
        </a>
        <a href="">
          <div class="item ">
            <div class="img-box box-2">
              <img src="" alt="">
            </div>
            <div class="detail-box">
              <p>
                +02 1234567890
              </p>
            </div>
          </div>
        </a>
        <a href="">
          <div class="item ">
            <div class="img-box box-3">
              <img src="" alt="">
            </div>
            <div class="detail-box">
              <p>
                demo@gmail.com
              </p>
            </div>
          </div>
        </a>
      </div>
    </div>
  </section>

  <!-- end info_section -->

  <!-- footer section -->
  <footer class="container-fluid footer_section">
    <p>
      &copy; 2020 All Rights Reserved. Design by
      <a href="https://html.design/">Free Html Templates</a>
    </p>
  </footer>
  <!-- footer section -->
  <script src="{{ asset('assets/js/jquery-3.4.1.min.js')}}""></script>
  <script src="{{ asset('assets/js/bootstrap.js')}}"></script>
@endsection