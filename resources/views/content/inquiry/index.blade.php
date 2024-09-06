@extends('layouts/contentNavbarLayout')

@section('title', 'Inquiries')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')

@endsection

@section('content')
<div class="row mb-12">
        <div class="col-md-4">
            <div class="card">
             <div class="card-body">
                <h5 class="card-title">My Inquiries</h5>
                <p class="card-text">
                    @if(count(Auth::User()->inquiry)>0)
                        <ul>
                       @foreach(Auth::User()->inquiry as $inquiry)
                        <li>
                            <a href="{{ route('inquiry.show',$inquiry->id) }}" style="color:001514; font-weight:strong; ">
                                {{$inquiry->subject}} 
                                <span @if( $inquiry->status == "NEW") style="color:red" 
                                     @elseif($inquiry->status == "ON-GOING") style="color:blue">
                                     @else style="color:green"
                                     @endif
                                >
                                     [{{$inquiry->status}}]
                                </span>
                            </a>
                        </li>
                       @endforeach
                        </ul>
                    @else
                        No Inquies found.
                    @endif
                </p>
            </div>
            </div>
        </div>
        @if(isset($inq))
            <div class="card mb-6 col-md-8">
                <div class="card-header">
                    <h6 class="card-title mb-0">Subject: {{$inq->subject}}</h6><br>
                    Body: <br>
                    <div class="card shadow-none bg-transparent border border-secondary">
                        <div class="card-body">
                            <p class="card-text text-secondary">
                                {{$inq->body}}
                            </p>
                        </div>
                    </div>
                    <span class="right muted"><p>{{date('F d, Y h:s a',strtotime($inq->created_at))}}</p></span>
                </div>
                <div class="card card overflow-hidden">
                    <div class="card-body pt-0 mb-10  ps ps-active-y">
                        @foreach($inq->reply as $reply)
                        <div class="card-body pt-0 mb-10  ps ps-active-y">
                            <div class="card bg-secondary text-white">
                                <div class="card-header">
                                    <h7 class="card-title text-white">{{$inq->subject}}</h5>
                                </div>
                                <div class="card-body pt-0">
                                
                                        <p>{{$reply->body}}</p>
                                        <p>{{date('F d, Y h:s a',strtotime($reply->created_at))}}</p>
                                
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="ps__rail-x" style="left: 0px; bottom: -200px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div>
                    <div class="ps__rail-y" style="top: 200px; height: 224px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 37px; height: 42px;"></div></div>
                </div>
                <div>
                    <form action="" class="input-group">
                        <div class="input-group">
                            <textarea name="response" id="response"></textarea>
                        </div>
                        <button class="submit">Send</button>
                    </form>
                </div>
            </div>
        @endif
</div>
@endsection