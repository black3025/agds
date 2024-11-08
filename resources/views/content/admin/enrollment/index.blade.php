@extends('layouts/contentNavbarLayout')

@section('title', 'Admin - Enrollments')

@section('page-script')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/DataTables/datatables.min.css') }}"/>
    <script type="text/javascript" src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
    <script>
        $(function(){
        
            fetchAllEnrollments();
            function fetchAllEnrollments(){
                $.get('{{route("getEnrollments")}}',{},function(data){
                    $('#all_enrollment').html(data.result);
                },'json');
            }
        })
   
    </script>
@endsection



@section('content')
<div class="col-12 col-lg-12 order-2 order-md-12 order-lg-12 mb-4">
    <div class="card">
      <div class="row row-bordered g-0">
          <div class="col-md-12">
                <div class="card mb-10" id="all_enrollment">
        
                </div>
           </div>
      </div>
    </div>
</div>
@endsection