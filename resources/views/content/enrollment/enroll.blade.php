@extends('layouts/contentNavbarLayout')

@section('title', 'Courses')

@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/DataTables/datatables.min.css') }}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
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
            <img class="card-img-top" src={{asset('storage/course_image/' .$enrollment->ClassSchedule->course->image_display) }} alt={{ $enrollment->ClassSchedule->course->name.' image' }}>
            <div class="card-body">
                <h5 class="card-title">{{$enrollment->ClassSchedule->course->name}} | {{$enrollment->ClassSchedule->category->name}}</h5>
                <p class="card-text">
                    Teacher: {{$enrollment->ClassSchedule->user->fname}} {{$enrollment->ClassSchedule->user->lname}}
                    Every: 
                    @foreach(explode('|',$enrollment->ClassSchedule->week) as $row)
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
                                <th>Notice</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach($enrollment->ClassSchedule->event as $sched)
                                <tr class="text-danger">
                                    <td @if($sched->comments != NULL) class="text-danger" @endif>
                                            {{date('F d, Y',strtotime($sched->start_time))}}
                                    </td>
                                    <td @if($sched->comments != NULL) class="text-danger" @endif>{{date('h:s a',strtotime($sched->start_time))}} to {{date('h:s a',strtotime($sched->finish_time))}}</td>
                                    <td @if($sched->comments != NULL) class="text-danger" @endif>
                                    {{date('l',strtotime($sched->start_time))}}
                                    </td>
                                     <td @if($sched->comments != NULL) class="text-danger" @endif>
                                            @if($sched->comments != NULL)
                                                {{$sched->comments}}
                                            @endif
                                    </td>
                                    {{-- <td>Drop</td> --}}
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <div class="row mb-3">
                                <img class="card-img-top" src={{ asset('assets/img/QR.png') }} alt='gcashQR'>
                                <div class="col mb-6">
                                    <form onsubmit="return enroll({{$enrollment}},{{Auth::user()->id}});">
                                        @csrf
                                        <label for="refno" class="form-label">Reference Number</label>
                                        <input type="text" id="refno" class="form-control" placeholder="Reference Number" required>
                                </div>
                            </div>
                                        <center><button type="button" class="btn btn-primary right">Enroll now</button></center>
                                    </form>
                            </div>
                        </div>
                        </div>
                </div>
            </div>
        </div>
</div> 
@endsection