@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Student')


@section('page-script')
  <script>
      function Inquire(){
         var form = {
            _token: $('input[name=_token]').val(),
            name: $('#name').val(),
            email: $('#email').val(),
            number: $('#number').val(),
            body: $('#body').val(),
            ajax: 1
         }

         $.ajax({
	         url : "{{route('contactus.store')}}",
	         data :  form,
	         type : "POST",
	         success : function(msg){
                //console.log(msg['message']);
                if(msg['success']){
                    success(msg['message']);
                    setTimeout(function(){window.location.reload();},1500);
                }else{
                    error(msg['message']);
                }
             }
        })
        return false;
    }
  </script>
@endsection

@section('content')
 <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
    <div class="card">
      <div class="row row-bordered g-0">
          <div id="calendar">
          this is an admin page</div>
      </div>
    </div>
  </div>
@endsection
