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

@endsection

@section('content')  
<div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="pb-1 mb-6">Enrolled Courses</h5>
        <div class="row mb-12 g-6">
            @foreach($enrollments as $enrollment)
            <div class="mb-12 col-md-3 g-6" style="margin-bottom:15px">
            <a href="{{ route('course.show',$enrollment->id) }}" >
                <div class="card h-100">
                    <img class="card-img-top" src={{ asset('storage/course_image/' .$enrollment->ClassSchedule->course->image_display) }} alt={{ $enrollment->ClassSchedule->course    ->name.' image' }}>
                    <div class="card-body">
                       <h5 class="card-title">{{$enrollment->ClassSchedule->course->name}} | {{$enrollment->ClassSchedule->category->name}}</h5>
                        <p class="card-text">
                            Status: @if($enrollment->verified == "Pending") <span style="color:red;">@else <span style="color:green;">@endif{{$enrollment->verified}}</span>
                        </p>
                        <p class="card-text">
                            Teacher: {{$enrollment->ClassSchedule->user->fname}} @if(!empty( $enrollment->ClassSchedule->user->mname )) {{$enrollment->ClassSchedule->user->mname[0]}}. @else  @endif {{$enrollment->ClassSchedule->user->lname}}
                        </p>
                    </div>
                </div>
            </a>
            </div>
            @endforeach
        </div>
</div>
@endsection
