@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))

@extends('layouts/blankLayout')

@section('title', 'Under Maintenance - Pages')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-misc.css')}}">
@endsection

@section('content')
<!--Under Maintenance -->
<div class="container-xxl container-p-y">
  <div class="misc-wrapper">
    <h2 class="mb-2 mx-2">{{__('Forbidden')}}</h2>
    <p class="mb-4 mx-2">
        {{($exception->getMessage() ?: 'Forbidden')}}
    </p>
    <a href="{{url('/Dashboard')}}" class="btn btn-primary">Back to home</a>
    <div class="mt-4">
      <img src="{{asset('assets/img/illustrations/girl-doing-yoga-light.png')}}" alt="girl-doing-yoga-light" width="500" class="img-fluid">
    </div>
  </div>
</div>
<!-- /Under Maintenance -->
@endsection
