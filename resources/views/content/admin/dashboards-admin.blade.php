@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Student')



@section('content')
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
                <p class="mb-1">New Enrolees</p>
                <h4 class="card-title mb-3">{{$enrollements->count()}}</h4>
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
                <p class="mb-1">Active Course</p>
                <h4 class="card-title mb-3">{{$courses->count()}}</h4>
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
                <p class="mb-1">Students</p>
                <h4 class="card-title mb-3">{{$students->count()}}</h4>
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
                <p class="mb-1">Trainors</p>
                <h4 class="card-title mb-3">{{$teachers->count()}}</h4>
                <!-- <small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> -->
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">   
    <div class="row"> 
      <div class="col-lg-8 col-md-8 col-8 mb-8" style="margin-bottom:15px">
          <div class="card">
                <div class="card-body">
                    @include('content.calendar.calendar')
                </div>
          </div>
      </div>
      <div class="col-lg-4 col-md-4 col-4 mb-4" style="margin-bottom:15px">
        <div class="card h-100">
                <div class="card-header">Announcements</div>
                <div class="card-body">
                  @foreach($posts as $post)
                    {{Str::limit($post->content, 30)}} Date Posted: {{date('F d, Y', strtotime($post->created_at))}}
                    <img class="card-img-top" src={{asset('storage/post_pic/' .$post->pic) }}  class="d-block w-px-10 h-px-10 rounded" alt="{{$post->pic}}">
                  @endforeach
                </div>
          </div>
      </div>
    </div>
  </div>
  @endsection
