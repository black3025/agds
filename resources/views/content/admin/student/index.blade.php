@extends('layouts/contentNavbarLayout')

@section('title', 'Admin')


@section('page-script')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/DataTables/datatables.min.css') }}"/>
 <script type="text/javascript" src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready( function () {
        $('#tblStudent').DataTable();
        });
    </script>
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
 <div class="col-12 col-lg-12 order-2 order-md-12 order-lg-12 mb-4">
    <div class="card">
      <div class="row row-bordered g-0">
          <div class="col-md-12">
            <div class="card mb-10">
                <div class="card-body pt-0">
                    <table class="table table-hover" id="tblStudent" >
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Full name</th>
                                <th>Number of active Course</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach($students as $student)
                                <tr>
                                    <td>{{$student->studentID}}</td>
                                    <td><a href="{{route('student.show',$student->id)}}">{{$student->user->fname}} {{$student->user->mname}} {{$student->user->lname}}</a></td>
                                    <td>{{$student->user->enrollments->where('verified','Approved')->count()}}</td>
                                    <td><a onclick="setCourseId({{$student->user->id}})" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal" fdprocessedid="dyx4wr"><i class='bx bxs-comment-add'></i>Book</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Payment</h5>
                            <button type="button" id="mdClose" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <div class="row mb-3">
                                <img class="card-img-top" src={{ asset('assets/img/QR.png') }} alt='gcashQR'>
                                <div class="col mb-6">
                                    <form onsubmit="return enroll( {{Auth::user()->id}} );">
                                        @csrf
                                        <label for="refno" class="form-label">Reference Number</label>
                                        <input hidden tabindex ="-1"    type="text" name="ClassSchedule_id" id="ClassSchedule_id" />
                                        <input type="text" id="refno" name="refno" class="form-control" placeholder="Reference Number" required />
                                </div>
                            </div>
                                        <center><button type="submit" class="btn btn-primary right">Enroll now</button></center>
                                    </form>
                            </div>
                        </div>
                        </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection
