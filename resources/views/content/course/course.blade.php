@extends('layouts/contentNavbarLayout')

@section('title', 'Courses')

@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/DataTables/datatables.min.css') }}"/>
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready( function () {
        $('#tblCourse').DataTable();
        });
    </script>
@endsection

@section('content')
    <div class="row mb-12">
        <div class="col-md-3">
            <div class="card">
            <img class="card-img-top" src={{ asset('storage/course_image/' .$course->image_display) }} alt={{ $course->name.' image' }}>
            <div class="card-body">
                <h5 class="card-title">{{$course->name}}</h5>
                <p class="card-text">
                    {{$course->description}}
                </p>
            </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card mb-10">
                <div class="card-header">
                    <h7 class="card-title mb-0">Available Class:</h5>
                </div>
                <div class="card-body pt-0">
                    
                    <br><br>
                    <table class="table table-hover" id="tblCourse" >
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Teacher</th>
                                <th>Duration</th>
                                <th>Timeslot</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach($course->ClassSchedule as $sched)
                                <tr>
                                    <td>{{$sched->category->name}}</td>
                                    <td>{{$sched->user->fname}} @if(!empty( $sched->user->mname )) {{$sched->user->mname[0]}}. @else  @endif {{$sched->user->lname}}</td>
                                    <td>{{date('M d, Y',strtotime($sched->day_start))}} to {{date('M d, Y',strtotime($sched->day_end))}}</td>
                                    <td>{{date('h:s a',strtotime($sched->time_start))}} to {{date('h:s a',strtotime($sched->time_end))}}</td>
                                    <td>
                                        <a 
                                            onclick="setCourseId({{$sched->id}})"
                                            type="button"
                                            class="btn btn-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#basicModal"
                                            fdprocessedid="dyx4wr"
                                            title="Book">
                                               <i class='bx bx-cart-add' ></i>
                                        </a>
                                        <a 
                                            onclick="setCourseId({{$sched->id}})"
                                            type="button"
                                            class="btn btn-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#redeemModal"
                                            fdprocessedid="dyx4wr"
                                            title="Redeem ">
                                               <i class='bx bxs-purchase-tag-alt' ></i>
                                        </a>
                                    </td>
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
                <div class="modal fade" id="redeemModal" tabindex="-1" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Redeem</h5>
                            <button type="button" id="mdClose2" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col mb-6">
                                Redeem this course for 500 points?
                                    <form onsubmit="return redeem({{Auth::user()->id}});">
                                        @csrf
                                        <label for="refno2" class="form-label">Reference Number</label>
                                        <input tabindex ="-1"    type="text" name="ClassSchedule_id2" id="ClassSchedule_id2" />
                                        <input type="text" id="refno2" name="refno2" class="form-control" placeholder="Reference Number" value="Loyalty Points Redeem" />
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

 <script>
        function setCourseId(id)
        {
            $('#ClassSchedule_id').val(id);
            $('#ClassSchedule_id2').val(id);
        }

        function enroll(id){
            $('#mdClose').click();
            var form = {
                _token: $('input[name=_token]').val(),
                user_id: id,
                class_schedule_id : $('#ClassSchedule_id').val(),
                referenceNo: $('#refno').val(),
                verified: "Pending",
                status: "New",
                ajax: 1
            }

            $.ajax({
                url : "{{route('enrollment.store')}}",
                data :  form,
                type : "POST",
                success : function(msg){
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

        function redeem(id){
            $('#mdClose2').click();
            var form = { 
                _token: $('input[name=_token]').val(),
                user_id: id,
                class_schedule_id : $('#ClassSchedule_id2').val(),
                referenceNo: $('#refno2').val(),
                verified: "Approved",
                status: "New",
                ajax: 1
            }

            $.ajax({
                url : "{{route('redeem')}}",
                data :  form,
                type : "POST",
                success : function(msg){
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