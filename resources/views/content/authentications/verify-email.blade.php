@extends('layouts/blankLayout')

@section('title', 'Email Verification - Pages')

@section('content')
    Please Verify your email. {{ gAuth::user()->email }}
@endsection