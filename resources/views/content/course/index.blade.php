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
     <div class="table-responsive" style="margin:15px">
            <table class="table table-hover" id="tblCourse" >
                <thead>
                    <tr style="text-align:center;">
                        <th>Cover</th>
                        <th >Course</th>
                        <th >Description</th>
                        <th >Action</th>                    
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($courses as $course)
                       
                        <tr>
                            <td><img src={{ asset('assets/img/course/' .$course->image_display) }} alt={{ $course->name.' image' }} width="150px"></td>
                            <td> <a href="{{ route('course.show',$course->id) }}" >{{ $course->name }}  </a></td>
                            <td>{{ $course->description }}</td>
                            <td>
                               <a href="#" style="color:green;"><i class='bx bx-folder-plus'></i>Reserve</a> |
                               <a href="#" style="color:blue;"><i class='bx bx-message-square-dots'></i>Inquire</a>
                            </td>
                        </tr>
                       
                    @endforeach
                </tbody>
            </table>
    </div>
</div>
@endsection
