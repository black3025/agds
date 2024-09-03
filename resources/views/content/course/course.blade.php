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
    <div class="card">
        <div class="card-body">
            <h1>{{$course->name}}</h1>
            <center><img src={{ asset('assets/img/course/' .$course->image_display) }} alt={{ $course->name.' image' }} width="350px"></center>
            Available Schedules:<br><br>
           {{$course->ClassShedule}}
                
        </div>
    </div>
@endsection