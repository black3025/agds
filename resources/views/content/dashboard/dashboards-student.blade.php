@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Student')


@section('content')
<div class="row">
    <div class="col-xxl-8 col-md-8 mb-6 order-0">
        <div class="card">
          <div class="d-flex align-items-start row">
            <div class="col-sm-7">
              <div class="card-body">
                <h5 class="card-title text-primary mb-3">{{ucfirst(Auth::user()->fname)}} you have {{Auth::user()->loyalty->sum('amount')}} loyalty points.</h5>
                <p class="mb-6">You have done 
                  @if(empty(Auth::user()->enrollments))
                    0
                  @else
                    {{Auth::user()->enrollments->where('status', 'Done')->  count() }}
                  @endif
                 classes.
                 
                 
                 <br>View more courses</p>

                
              </div>
            </div>
            <div class="col-sm-5 text-center text-sm-left">
              <div class="card-body pb-0 px-0 px-md-6">
                <img src="{{asset('assets/img/illustrations/man-with-laptop-light.png')}}" height="175" class="scaleX-n1-rtl" alt="View Badge User">
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 order-1">
        <div class="row">
          <div class="col-lg-6 col-md-12 col-6 mb-6">
            <div class="card h-100">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between mb-4">
                  <div class="avatar flex-shrink-0">
                    <img src="../assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded">
                  </div>
                </div>
                <p class="mb-1">Active Course</p>
                <h4 class="card-title mb-3">
                  @if(empty(Auth::user()->enrollments))
                    0
                  @else
                    {{Auth::user()->enrollments->where('verified','Approved')->count()}}
                  @endif
                </h4>
                <small class="text-success fw-medium"><a href="{{route('enrollment.index')}}"><i class='bx bxs-palette'></i>View Course</a></small>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-12 col-6 mb-6">
            <div class="card h-100">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between mb-4">
                  <div class="avatar flex-shrink-0">
                    <img src="../assets/img/icons/unicons/wallet-info.png" alt="wallet info" class="rounded">
                  </div>
                  <div class="dropdown">
                    <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="bx bx-dots-vertical-rounded text-muted"></i>
                    </button>
                  </div>
                </div>
                <p class="mb-1">Course Completed</p>
                <h4 class="card-title mb-3">
                  @if(empty(Auth::user()->enrollment))
                    0
                  @else
                    Auth::user()->enrollment->where('verified','Completed')->count()
                  @endif
                </h4>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
<div class="row" style="margin-top:15px">
  <div class="col-xxl-8 col-md-8 mb-6 order-0">
    <div class="card h-100">
      <div class="card-body">
          @include('content.calendar.calendar')
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 order-1">
    <div class="card h-100">
        <div class="card-header">Announcements</div>
        <div class="card-body">
            
        </div>
    </div>
  </div>
</div>
@endsection
