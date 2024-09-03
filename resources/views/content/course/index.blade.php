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
<h5 class="pb-1 mb-6">Courses Offerred</h5>
<div class="row mb-12">
    @foreach($courses as $course)
        <a href="{{ route('course.show',$course->id) }}" >
            <div class="col-md-3">
                <div class="card">
                    <img class="card-img-top" src={{ asset('assets/img/course/' .$course->image_display) }} alt={{ $course->name.' image' }}>
                    <div class="card-body">
                        <h5 class="card-title">{{$course->name}}</h5>
                        <p class="card-text">
                            {{$course->description}}...
                        </p>
                    </div>
                </div>
            </div>
        </a>
    @endforeach
</div>
@endsection
