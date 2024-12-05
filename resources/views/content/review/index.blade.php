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
<script src="{{asset('assets/js/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('assets/js/swal.js')}}"></script>
@endsection

@section('content')
  <!-- trainer section -->

  <section class="trainer_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2 id = "instructors" class="force_white">
          Our Instructors
        </h2>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-6 mx-auto">
          <div class="box">
            <div class="name">
              <h5 class="force_white">
                ALOE
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
        <div class="col-lg-3 col-md-6 mx-auto">
          <div class="box">
            <div class="name">
              <h5 class="force_white">
                BEA
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
        <div class="col-lg-3 col-md-6 mx-auto">
          <div class="box">
            <div class="name">
              <h5 class="force_white">
                BERN
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
        <div class="col-lg-3 col-md-6 mx-auto">
          <div class="box">
            <div class="name">
              <h5 class="force_white">
                CED
              </h5>
            </div>
            <div class="img-box">
              <img src= {{asset('assets/img/index/t4.jpg')}} alt="">
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
                3rd Flr. Ayala Malls Legazpi City
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
                +639273106985
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
                agds@testmail.com
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
      &copy; 2020 All Rights Reserved. 
    </p>
  </footer>
  <!-- footer section -->
  <script src="{{ asset('assets/js/jquery-3.4.1.min.js')}}""></script>
  <script src="{{ asset('assets/js/bootstrap.js')}}"></script>
@endsection