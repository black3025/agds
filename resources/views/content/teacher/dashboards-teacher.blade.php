@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Teacher')

@section('content')

  <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">   
    <div class="row"> 
      <div class="col-lg-8 col-md-8 col-8 mb-8" style="margin-bottom:15px">
          <div class="card h-100">
                <div class="card-body">
                    @include('content.calendar.calendar')
                </div>
          </div>
      </div>
    </div>
  </div>
  <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
    <div class="col-lg-12 col-md-12 order-1">
        <div class="row">
          <div class="col-lg-3 col-md-3 col-6 mb-6" style="margin-bottom:15px">
            <div class="card h-100">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between mb-4">
                  <div class="avatar flex-shrink-0">
                    <img src="../assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded">
                  </div>
                  <div class="dropdown">
                    <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="bx bx-dots-vertical-rounded text-muted"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                      <a class="dropdown-item" href="javascript:void(0);">View More</a>
                    </div>
                  </div>
                </div>
                <p class="mb-1">My Students</p>
                <h4 class="card-title mb-3">
                  @foreach(Auth::user()->ClassSchedules as $sched)
                        {{$sched->enrollment}}
                  @endforeach
                </h4>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-6 mb-6" style="margin-bottom:15px">
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
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                      <a class="dropdown-item" href="javascript:void(0);">View More</a>
                    </div>
                  </div>
                </div>
                <p class="mb-1">My Course</p>
                <h4 class="card-title mb-3">{{Auth::user()->ClassSchedules->count()}}</h4>
              </div>
            </div>
          </div>
          
        </div>
      </div>
  </div>
@endsection
