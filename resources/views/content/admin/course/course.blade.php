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
            $('#tblSched').DataTable();
        });

        function toggleActive(id)
        {
            $.ajax({
                type : "GET",
                url : "/admin/sched-status/" + id,
                dataType : "json",
                contentType: "application/json",
                crossDomain: true,
                success : function(data) {
                    // alert(data.result);
                    setTimeout(function(){window.location.reload();},1000);
                },
                error : function(data) {
                    console.log("Fialed to get the data");
                }
            });
        };  

        function setMax()
        {           
            maxi = $("#add_studio option:selected").text().split(":")[1];
            maxi = maxi.trim();
            $("#add_slot").attr({
                "min":2, 
                "max" : maxi
            });
        }

        function setDay(picker)
        {           
           today = new Date(picker);
           dday = today.getDay()
           $('#Sunday').prop('checked', false);
           $('#Monday').prop('checked', false);
           $('#Tuesday').prop('checked', false);
           $('#Wednesday').prop('checked', false);
           $('#Thursday').prop('checked', false);
           $('#Friday').prop('checked', false);
           $('#Saturday').prop('checked', false);
           if(dday == 0 )
             $('#Sunday').prop('checked', true);
           if(dday == 1 )
             $('#Monday').prop('checked', true);
           if(dday == 2 )
             $('#Tuesday').prop('checked', true);
           if(dday == 3 )
             $('#Wednesday').prop('checked', true);
           if(dday == 4 )
             $('#Thursday').prop('checked', true);
           if(dday == 5 )
             $('#Friday').prop('checked', true);
           if(dday == 6 )
             $('#Saturday').prop('checked', true);
        }

   </script>



@endsection

@section('content')
    <div class="row mb-12">
        <div class="col-md-2">
            <div class="card">
            <img class="card-img-top" src={{ asset('storage/course_image/' .$course->image_display) }} alt={{ $course->name.' image' }}>
            <div class="card-body">
                <h5 class="card-title">{{$course->name}}</h5>
                {{-- <p class="card-text">
                    {{$course->description}}
                </p> --}}
            </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="card mb-10" id ="all_schedule">
            <div class="card-header row">
    <div class="col col-8"><h7 class="card-title mb-0">Available Class:</h5></div>
    <div class="col col-4 text-end mb-10"><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEnrollModal"><i class='bx bxs-message-square-add'></i>&nbsp; Add</button></div>
</div>
<div class="card-body pt-0">
    <table class="table table-hover" id="tblSched" style="font-size: 0.7em" >
        <thead>
            <tr>
                <th style="text-align:center">Category</th>
                <th style="text-align:center">Teacher</th>
                <th style="text-align:center">Start Date</th>
                <th style="text-align:center">Duration</th>
                <th style="text-align:center">Days</th>
                <th style="text-align:center">Room</th>
                <th style="text-align:center">Timeslot</th>
                <th style="text-align:center">Action</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach($course->ClassSchedule as $sched)
                <tr>
                    <td>{{$sched->category->name}}</td>
                    <td>{{$sched->user->fname}} @if(!empty( $sched->user->mname )) {{$sched->user->mname[0]}}. @else  @endif {{$sched->user->lname}}</td>
                    <td>{{date('F d, Y',strtotime($sched->day_start))}}</td>
                    <td>{{$sched->duration}}</td>
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

                        </td>
                    <td>{{$sched->room->name}}</td>
                    <td>{{date('h:s a',strtotime($sched->time_start))}} to {{date('h:s a',strtotime($sched->time_end))}}</td>
                    <td>
                        <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="is_active.{{$sched->id}}" name="is_active"  {{$sched->is_active == "1" ? "checked" : ""}} onchange="toggleActive({{$sched->id}})">
                                    <label class="form-check-label" for="is_active.{{$sched->id}}">
                                        <span style = 'color:{{$sched->is_active == "1" ? "green": "red"}};'>
                                            {{$sched->is_active == "1" ? "Active": "Inactive"}}
                                        </span>
                                    </label>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
            </div>
        </div>
</div> 
@include('content/admin/class_schedule/add')
 <script>
    $(function(){
      $('#addSchedule').on('submit', function(e){
                e.preventDefault();
                var form = this;
                $.ajax({
                    url:$(form).attr('action'),
                    method:$(form).attr('method'),
                    data: new FormData(form),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend:function(){
                        $(form).find('span.error-text').text('');
                    },
                    success:function(data){
                        if(data.code==0){
                            $.each(data.error, function(prefix, val){
                                $(form).find('span.'+prefix+'_error').text(val[0]);
                            });
                        }else if(data.code==2){
                            $('#mdaclosebutton').click();
                            error(data.msg);
                            
                        }else{
                            $('#mdaclosebutton').click();
                            $(form)[0].reset();
                            success(data.msg);
                            setTimeout(function(){window.location.reload();},1500);
                        }

                    }

                })
        });
    });
  </script>
@endsection