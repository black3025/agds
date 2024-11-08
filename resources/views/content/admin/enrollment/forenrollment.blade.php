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
                <th style="text-align:center;">Schedule</th>
                <th style="text-align:center;">Trainor</th>
                <th style="text-align:center;">Action</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach($enrollments as $enrollment)
                <tr style="text-align:center;">
                    <td>{{$enrollment->user->fname}} {{$enrollment->user->mname}} {{$enrollment->user->lname}}</td>
                    <td>{{$enrollment->classSchedule->course->name}}</td>
                    <td>{{$enrollment->classSchedule->course->category}}</td>
                    <td>{{$enrollment->classSchedule->user->fname }} {{$enrollment->classSchedule->user->mname }} {{$enrollment->classSchedule->user->lname }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>