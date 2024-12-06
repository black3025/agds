@extends('layouts/contentNavbarLayout')

@section('title', 'Admin')

@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/DataTables/datatables.min.css') }}"/>
@endsection
@section('page-script')
    <script src="{{ asset('assets/js/jquery-3.4.1.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#tblPost').DataTable();
        });
    </script>
    </script> 
    <script>
        $(function(){
        
            fetchAllPosts();
            function fetchAllPosts(){
                $.get('{{route("getPosts")}}',{},function(data){
                    $('#all_Post').html(data.result);
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
                <div class="card mb-10" id="all_Post">
        
                </div>
           </div>
      </div>
    </div>
</div>
@endsection