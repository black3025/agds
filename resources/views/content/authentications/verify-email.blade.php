@extends('layouts/blankLayout')

@section('title', 'Email Verification - Pages')

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card">
                    <div class="card-body">
                        <center>Please Verify your email. <span style="color:blue;">{{ Auth::user()->email }}</span>
                            <a class="dropdown-item" href="{{route('logout')}}">
                                <i class='bx bx-power-off me-2'></i>
                                <span class="align-middle">Log Out</span>
                            </a>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection