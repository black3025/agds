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
      <div class="card-title">
      </div>
        <div class="card-body">
          <div class="row">
            <div class="col-4" id="calendar">
              this will display calendar
            </div>
            <div class="col-4" id="calendar">
              this will display calendar
            </div>
            <div class="col-4" id="calendar">
              this will display calendar
            </div>
          </div>
        </div>
    </div>
  </div>
@endsection
