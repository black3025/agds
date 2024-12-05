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
        <div class="col-md-2">
            <div class="card">
            <img class="card-img-top" src={{ asset('storage/course_image/' .$course->image_display) }} alt={{ $course->name.' image' }}>
            <div class="card-body">
                <h5 class="card-title">{{$course->name}}</h5>
                <p class="card-text" style="font-size:0.9em;">
                    {{$course->description}}
                </p>
            </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="card mb-10">
                <div class="card-header">
                    <h7 class="card-title mb-0">Available Class:</h5>
                </div>
                <div class="card-body pt-0">
                    
                    <br><br>
                    <table class="table table-hover" id="tblCourse" style="font-size: 0.7em" >
                        <thead>
                            <tr >
                                <th style="text-align:center">Category</th>
                                <th style="text-align:center">Teacher</th>
                                <th style="text-align:center">Start Date</th>
                                <th style="text-align:center">Duration</th>
                                <th style="text-align:center">Schedule</th>
                                <th style="text-align:center">Slots</th>
                                <th style="text-align:center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach($course->ClassSchedule->where('is_active',1) as $sched)
                                
                                <tr>
                                        <td>{{$sched->category->name}}</td>
                                        <td>{{$sched->user->fname}} @if(!empty( $sched->user->mname )) {{$sched->user->mname[0]}}. @else  @endif {{$sched->user->lname}}</td>
                                        <td>{{date('F d, Y',strtotime($sched->day_start))}}</td>
                                        <td>{{$sched->duration}} Sessions </td>
                                        <td>
                                                    @foreach(explode('|',$sched->week) as $row)
                                                        @if($row == 0)
                                                            Sunday,
                                                        @endif
                                                        @if($row == 1)
                                                            Monday,
                                                        @endif
                                                        @if($row == 2)
                                                            Tuesday,
                                                        @endif
                                                        @if($row == 3)
                                                            Wednesday,
                                                        @endif
                                                        @if($row == 4)
                                                            Thursday,
                                                        @endif
                                                        @if($row == 5)
                                                            Friday,
                                                        @endif
                                                        @if($row == 6)
                                                            Saturday,
                                                        @endif
                                                    @endforeach
                                            <br>
                                            {{date('h:s a',strtotime($sched->time_start))}} to {{date('h:s a',strtotime($sched->time_end))}}
                                    </td>
                                    <td>{{$sched->slot - $sched->enrollment->count()}}</td>
                                    <td>
                                        <a 
                                            onclick="checkConflict({{$sched->id}},1,{{$sched->amount}})"
                                            type="button"
                                            class="btn btn-primary"
                                            title="Book">
                                                <i class='bx bx-plus'></i>
                                        </a>
                                        <button hidden type="button"
                                            class="btn btn-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#basicModal"
                                            fdprocessedid="dyx4wr" id="ghostEnroll">
                                        </button>
                                        <a 
                                            onclick="checkConflict({{$sched->id}},2,{{$sched->amount}})"
                                            type="button"
                                            class="btn btn-primary"
                                            title="Redeem ">
                                            <i class='bx bxs-gift'></i>
                                        </a>
                                        <button hidden type="button"
                                            class="btn btn-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#redeemModal"
                                            fdprocessedid="dyx4wr" id="ghostRedeem">
                                        </button>
                                       
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
                                        <input tabindex ="-1" hidden type="text" name="ClassSchedule_id" id="ClassSchedule_id" />
                                        <input type="text" minlength="12" id="refno" name="refno" class="form-control" placeholder="Reference Number" required />
                                        <span class="text-danger error-text refno_error" > </span>
                                        <label for="amount" class="form-label">Course Price</label>
                                        <input type="text" readonly id="amount" name="amount" class="form-control" />
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
                                    <form hidden onsubmit="return redeem({{Auth::user()->id}});">
                                        @csrf
                                        <label for="refno2" class="form-label">Reference Number</label>
                                        <input tabindex ="-1"    type="text" name="ClassSchedule_id2" id="ClassSchedule_id2" />
                                        <input type="text" id="refno2" name="refno2" class="form-control" placeholder="Reference Number" value="Loyalty Points Redeem" />
                                        <input type="text" id="amount2" name="amount2" class="form-control" />
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
        function checkConflict(id,type,amount)
        {
            setCourseId(id,amount);
            var form = {
                _token: $('input[name=_token]').val(),
                class_schedule_id : id,
                ajax: 1
            }

            $.ajax({
                url : "{{route('checkConflict')}}",
                data :  form,
                type : "POST",
                success : function(msg){
                    if(msg['success']){
                        if(type == 1)
                            $('#ghostEnroll').click();
                        else
                            $('#ghostRedeem').click();
                    }else{
                        error(msg['message']);
                    }
                }
            })
            return false;
        }


        function setCourseId(id,amount)
        {
            $('#ClassSchedule_id').val(id);
            $('#amount1').val(amount);
            $('#ClassSchedule_id2').val(id);
            $('#amount').val(amount);
            
        }

        function enroll(id){
            var form = {
                _token: $('input[name=_token]').val(),
                user_id: id,
                class_schedule_id : $('#ClassSchedule_id').val(),
                referenceNo: $('#refno').val(),
                verified: "Pending",
                status: "New",
                amount: $('#amount').val(),
                ajax: 1
            }

            $.ajax({
                url : "{{route('enrollment.store')}}",
                data :  form,
                type : "POST",
                success : function(data){
                    if(data.code == 1){
                        success(data.msg);
                        setTimeout(function(){window.location.reload();},1500);
                        $('#mdClose').click();
                    }else{
                        $.each(data.error, function(prefix, val){
                            $(form).find('span.'+prefix+'_error').text(val[0]);
                        });
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