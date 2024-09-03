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
    <div class="row mb-12">
        <div class="col-md-3">
            <div class="card">
            <img class="card-img-top" src={{ asset('assets/img/course/' .$course->image_display) }} alt={{ $course->name.' image' }}>
            <div class="card-body">
                <h5 class="card-title">{{$course->name}}</h5>
                <p class="card-text">
                    {{$course->description}}
                </p>
            </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card mb-10">
                <div class="card-header">
                    <h7 class="card-title mb-0">Available Class:</h5>
                </div>
                <div class="card-body pt-0">
                    
                    <br><br>
                    <table class="table table-hover" id="tblCourse" >
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Teacher</th>
                                <th>Duration</th>
                                <th>Timeslot</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach($course->ClassSchedule as $sched)
                                <tr>
                                    <td>{{$sched->category->name}}</td>
                                    <td>{{$sched->user->fname}} {{$sched->user->mname[0]}}. {{$sched->user->lname}}</td>
                                    <td>{{$sched->day_start}} to {{$sched->day_end}}</td>
                                    <td>{{$sched->time_start}} to {{$sched->time_end}}</td>
                                    <td><a href="#"><i class='bx bxs-comment-add'></i>Book</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
   
@endsection