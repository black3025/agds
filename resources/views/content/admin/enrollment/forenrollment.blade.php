<script>
     $(document).ready( function () {
            $('#tblEnrollment').DataTable();
        });  

</script>
<div class="card-header">
   
</div>
<div class="card-body pt-0">
    <table class="table table-hover" id="tblEntrollment" >
        <thead>
            <tr>
                <th style="text-align:center;">Student's Full name</th>
                <th style="text-align:center;">Course</th>
                <th style="text-align:center;">Category</th>
                <th style="text-align:center;">Duration</th>
                <th style="text-align:center;">Timeslot</th>
                <th style="text-align:center;">Trainer</th>
                <th style="text-align:center;">Reference No.</th>
                <th style="text-align:center;">Action</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach($enrollments as $enrollment)
                <tr style="text-align:center;">
                    <td>{{$enrollment->user->fname}} {{$enrollment->user->mname}} {{$enrollment->user->lname}}</td>
                    <td>{{$enrollment->classSchedule->course->name}}</td>
                    <td>{{$enrollment->classSchedule->category->name}}</td>
                    <td>{{date('M. d, Y',strtotime($enrollment->classSchedule->day_start))}}-{{date('M. d, Y',strtotime($enrollment->classSchedule->day_end))}}</td>
                    <td>{{date('h:s a',strtotime($enrollment->classSchedule->time_start))}}-{{date('h:s a',strtotime($enrollment->classSchedule->time_end))}}</td>
                    <td>{{$enrollment->classSchedule->user->fname }} {{$enrollment->classSchedule->user->mname }} {{$enrollment->classSchedule->user->lname }}</td>
                    <td>{{$enrollment->referenceNo}}</td>
                    <td><a href='#'><i class='bx bx-check-circle' ></i></a> | <a href='#'><i class='bx bxs-x-circle'></i></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>