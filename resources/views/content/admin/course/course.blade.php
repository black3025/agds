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
            <div class="card mb-10" id ="all_schedule">
            <div class="card-header row">
    <div class="col col-8"><h7 class="card-title mb-0">Available Class:</h5></div>
    <div class="col col-4 text-end mb-10"><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEnrollModal"><i class='bx bxs-message-square-add'></i>&nbsp; Add</button></div>
</div>
<div class="card-body pt-0">
    <table class="table table-hover" id="tblSched" >
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
                    <td>{{date('F d, Y',strtotime($sched->day_start))}} to {{date('F d, Y',strtotime($sched->day_end))}}</td>
                    <td>{{date('h:s a',strtotime($sched->time_start))}} to {{date('h:s a',strtotime($sched->time_end))}}</td>
                    <td>
                        <a onclick="setCourseId({{$sched->id}})" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal" fdprocessedid="dyx4wr">
                            <i class='bx bx-edit-alt'></i>
                        </a>
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