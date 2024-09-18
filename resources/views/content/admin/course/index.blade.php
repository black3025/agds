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
    <div class="row mb-12 g-6">
    <h5>Courses Offerred</h5>
            @foreach($courses as $course)
            <div class="col-md-6 col-lg-3" style="margin-bottom:15px">
                <div class="mb-12 card h-100">
                    <div class="card-header">
                        <a style="align:right" data-bs-toggle="modal" data-bs-target="#basicModal" href="#" onclick="setss({{$course}},'{{asset('assets/img/course/' .$course->image_display)}}');">Edit</a>
                        <a href="{{ route('admin-course.show',$course->id) }}" >
                        <img class="card-img-top" src={{ asset('assets/img/course/' .$course->image_display) }} alt={{ $course->name.' image' }}>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{$course->name}}</h5>
                        <p class="card-text">
                            {{ $course->description}} <p class="right"> read more...</p>
                        </p>
                    </div>
                    </a>
                </div>
            
            </div>
            @endforeach
    </div>
    @include('content/admin/course/update')
    <script>
        function setss(course,img)
        {
           $('#id').val(course['id']);
           $('#name').val(course['name']);
           $('#description').val(course['description']);
           $("#img_prev").attr("src", img);
        }
    </script>
@endsection
