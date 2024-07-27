@extends('layouts/blankLayout')

@section('title', 'Welcome')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/index      .css')}}">
@endsection

@section('content')
    <header class="header-main">
        <div class="header-main-logo">
            <img src = "img/logo.png" alt = "AGDS LOGO">
            <nav>
                <ul>
                    <li class="list-item"><a href="http://">HOME</a></li>
                    <li class="list-item"><a href="http://">ABOUT US</a></li>
                    <li class="list-item"><a href="http://"></a>CONTACT US</li>
                    <li class="list-item"><a href="http://"></a>RECENT POST</li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <div class="main-intro">
            <h1>Your<br>future Starts<br>here..</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At, inventore esse iure vitae dolorem minima reprehenderit asperiores sapiente explicabo.</p>               
        </div>
        <div class="main-qoutes">
            <p>"Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sequi quo, inventore cum fuga nostrum expedita animi dolorum incidunt autem modi nisi facere explicabo tempore sint dolor nulla reprehenderit atque quidem."</p>
            <p>"Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sequi quo, inventore cum fuga nostrum expedita animi dolorum incidunt autem modi nisi facere explicabo tempore sint dolor nulla reprehenderit atque quidem."</p>
        </div>
    </main>
@endsection