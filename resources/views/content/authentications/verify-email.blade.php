@extends('layouts/blankLayout')

@section('title', 'Email Verification - Pages')

@section('content')
    Please Verify your email. {{ Auth::user()->email }}
@endsection