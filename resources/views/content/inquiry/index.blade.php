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
        <div class="col-md-8">
            <div class="card mb-10">
                <div class="card-header">
                    <h7 class="card-title mb-0">{{$inq->subject}}</h7>
                </div>
                <div class="card-body pt-0 mb-10">
                    <div class="row g-6 mb-50">
                    @foreach($inq->reply as $reply)
                        <div class="card bg-secondary text-white"">
                            <div class="card-header">
                                <h7 class="card-title text-white">{{$inq->subject}}</h5>
                            </div>
                            <div class="card-body pt-0">
                            
                                    <p>{{$reply->body}}</p>
                                    <p>{{date('F d, Y h:s a',strtotime($reply->created_at))}}</p>
                            
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif
</div>
@endsection
