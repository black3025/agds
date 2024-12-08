<script>
    $(document).ready( function () {
            $('#tblEntrollment').DataTable();

    });
        function cancel(id)
        {
            Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, cancel it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteEnroll(id);
                }
            });
        }
        function deleteEnroll(id){
            $.ajax({
                type : "GET",
                url : "/admin/deleteEnrollment/" + id,
                dataType : "json",
                contentType: "application/json",
                success : function(data) {
                    success('This enrollment has been rejected');
                    fetchAllEnrollments();
                },
                error : function(data) {
                    error('There was an error during the cancellation of the this date.')
                }
            });
        }
            function fetchAllEnrollments(){
                $.get('{{route("getEnrollments")}}',{},function(data){
                    $('#all_enrollment').html(data.result);
                },'json');
            }
            function approve(id)
            {
                $.ajax({
                    type : "GET",
                    url : "/admin/approveEnrollment/" + id,
                    dataType : "json",
                    contentType: "application/json",
                    crossDomain: true,
                    success : function(data) {
                        success("Approved!");
                        $.get('{{route("getEnrollments")}}',{},function(data){
                            $('#all_enrollment').html(data.result);
                        },'json');
                    },
                    error : function(data) {
                        console.log("Fialed to get the data");
                    }
                });
            }
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
                    <td>
                        <a 
                            onclick="return approve({{$enrollment->id}})"
                            type="button"
                            class="btn btn-icon me-2 btn-primary"
                            data-bs-toggle="tooltip"
                            data-bs-offset="0,4"
                            data-bs-placement="right"
                            data-bs-html="true"
                            title="Approve this course">
                            <i class='bx bxs-check-circle'></i>
                        </a>
                        <a onclick="return cancel({{$enrollment->id}})"
                            class="btn btn-icon me-2 btn-danger"
                            data-bs-toggle="tooltip"
                            data-bs-offset="0,4"
                            data-bs-placement="right"
                            title="Decline this enrollment"
                        >
                            <i class='bx bx-x-circle' ></i>
                        </a>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>