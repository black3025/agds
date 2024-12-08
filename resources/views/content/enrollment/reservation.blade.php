@extends('layouts/contentNavbarLayout')

@section('title', 'Student-Reservation')

@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/DataTables/datatables.min.css') }}"/>
@endsection
@section('vendor-script')

    <script type="text/javascript" src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#tblReservation').DataTable();
        });
    </script>
    <script>
        $(function(){
            fetchAllReservation();
            function fetchAllReservation(){
                $.get('{{route("getReservation")}}',{},function(data){
                    $('#all_reservation').html(data.result);
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
                <div class="card mb-10" id="all_reservation">
        
                </div>
           </div>
      </div>
    </div>
</div>
@endsection