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
        $(function(){
                    //Fetch Course
                fetchAllCourse();
                function fetchAllCourse(){
                    $.get('{{route("getCourse")}}',{},function(data){
                        $('#all_course').html(data.result);
                    },'json');
                }
        })
    </script>
@endsection

@section('content')  
<div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="pb-1 mb-6">Courses Offerred</h5>
        <div class="row mb-12 g-6" id="all_course">

        </div>
</div>
@endsection
