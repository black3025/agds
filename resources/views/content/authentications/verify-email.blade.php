@extends('layouts/blankLayout')

@section('title', 'Email Verification - Pages')

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card">
                    <div class="card-body">
                        <center>Please Verify your email. {{ Auth::user()->email }}</center>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection