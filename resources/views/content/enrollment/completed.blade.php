@extends('layouts/contentNavbarLayout')

@section('title', 'Courses')

@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/DataTables/datatables.min.css') }}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
    <script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
     <script type="text/javascript" src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready( function () {
        $('#tblCourse').DataTable();
        });

    </script>
@endsection

@section('page-script')
<script>
        function populate(sched)
        {
            if(sched==''){
                $('#addReviewLabel').text('Add New Review');
                $('.schedid').value(sched);
            }else{
                $('#addReviewLabel').text('Update Review');
                $('.schedid').value(sched);
            }
          
        }
</script>
@endsection

@section('content')  
<div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="pb-1 mb-6">Completed Courses</h5>
        <div class="row mb-12 g-6">
            @foreach($enrollments as $enrollment)
            <div class="mb-12 col-md-3 g-6" style="margin-bottom:15px">
            <a href="{{ route('Course Schedule',$enrollment->id) }}" >
                <div class="card h-100">
                    <img class="card-img-top" src={{ asset('storage/course_image/' .$enrollment->ClassSchedule->course->image_display) }} alt={{ $enrollment->ClassSchedule->course    ->name.' image' }}>
                    <div class="card-body">
                    {{-- <span class="position-absolute top-0 start-100 translate-middle badge badge-center rounded-pill bg-danger text-white">1</span> --}}
                       <h5 class="card-title">{{$enrollment->ClassSchedule->course->name}} | {{$enrollment->ClassSchedule->category->name}}</h5>
                        <p class="card-text">
                            Status: <span class="text-primary">Completed</span>
                        </p>
                        <p class="card-text">
                            Teacher: {{$enrollment->ClassSchedule->user->fname}} @if(!empty( $enrollment->ClassSchedule->user->mname )) {{$enrollment->ClassSchedule->user->mname[0]}}. @else  @endif {{$enrollment->ClassSchedule->user->lname}}
                        </p>
                  
                          <small class="text-success fw-medium"><a onclick="populate({{$enrollment->ClassSchedule->reviews}})"  href="#" data-bs-toggle="modal" data-bs-target="#addReview"><i class='bx bx-edit-alt'></i>Write Review</a></small>
                    </div>
                    
                </div>
            </a>
            </div>
            @endforeach
        </div>
</div>
@include('content/review/add')
@endsection
