@extends('layouts/contentNavbarLayout')

@section('title', 'Class Schedule')
@php
date_default_timezone_set('Asia/Singapore'); 
@endphp
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

        function resched(id)
        {
            Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, reschedule it!"
            }).then((result) => {
            if (result.isConfirmed) {
                reresched(id);
            }
            });
        }

         function closeCourse(id,events)
        {
            
            if(events['finish_time'] > new Date())
            {
                error('This course has session past today.')
            }else{
                Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Mark as Done!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type : "GET",
                            url : "/class/close/" + id,
                            dataType : "json",
                            contentType: "application/json",
                            crossDomain: true,
                            success : function(data) {
                                success('This course has been marked as close.');
                                setTimeout(function(){window.history.back();},1000);
                            },
                            error : function(data) {
                                console.log("Fialed to get the data");
                            }
                        });
                    }
                
                });
            }
        }

        function reresched(id){
            $.ajax({
                type : "GET",
                url : "/teacher/resched/" + id,
                dataType : "json",
                contentType: "application/json",
                success : function(data) {
                    success('This schedule has been reschedule to: '. data);
                    setTimeout(function(){window.location.reload();},1000);
                },
                error : function(data) {
                    error('There was an error during the re-scheduling of the this date.')
                    console.log("Failed to get the data");
                }
            });
           
        }
    </script>
@endsection

@section('content')
    <div class="row mb-12">
        <div class="col-md-3">
            <div class="card">
            <img class="card-img-top" src={{asset('storage/course_image/' .$ClassSchedule->course->image_display) }} alt={{ $ClassSchedule->course->name.' image' }}>
            <div class="card-body">
                <h5 class="card-title">{{$ClassSchedule->course->name}} | {{$ClassSchedule->category->name}}</h5>
                <p class="card-text">
                    Teacher: {{$ClassSchedule->user->fname}} {{$ClassSchedule->user->lname}}
                    Every: 
                    @foreach(explode('|',$ClassSchedule->week) as $row)
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
                </p>
                @if($ClassSchedule->is_active == 0)
                        <span class="text-danger">Class Closed</span>
                @else
                        <button  onclick="closeCourse({{$ClassSchedule->id}}, {{ $ClassSchedule->event->last() }})" class="btn btn-info" > Mark Schedule as Done </button>
                @endif
            </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card mb-10">
                <div class="card-header">
                    <h7 class="card-title mb-0">Course Schedule:</h5>
                </div>
                <div class="card-body pt-0">
                    <br><br>
                    <table class="table table-hover" id="tblCourse" >
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Days of the Week</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach($ClassSchedule->event as $sched)
                                <tr>
                                    <td>{{date('F d, Y',strtotime($sched->start_time))}}</td>
                                    <td>{{date('h:s a',strtotime($sched->start_time))}} to {{date('h:s a',strtotime($sched->finish_time))}}</td>
                                    <td>
                                    {{date('l',strtotime($sched->start_time))}}
                                    </td>
                                    <td>
                                        @if($sched->comments == "")    
                                            <button class="btn btn-primary" onclick="resched({{$sched->id}});"
                                                @if($sched->finish_time <= date('Y-m-d H:i:s') || $ClassSchedule->is_active == 0) disabled @endif
                                            >
                                            Resched
                                            </button>
                                        @else
                                            <span class="text-danger">{{$sched->comments}}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
</div> 
@endsection