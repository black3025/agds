<script>
     $(document).ready( function () {
        $('#tblSched').DataTable();
    });
    
</script>
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
                    <td><a onclick="setCourseId({{$sched->id}})" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal" fdprocessedid="dyx4wr"><i class='bx bxs-comment-add'></i>Book</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>