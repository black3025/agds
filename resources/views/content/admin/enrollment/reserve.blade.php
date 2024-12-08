 <script>
        $(document).ready( function () {
            $('#tblReservation').DataTable();
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
        function fetchAllReservation(){
                $.get('{{route("AgetReservation")}}',{},function(data){
                    $('#all_reservation').html(data.result);
                },'json');
        }
        function deleteEnroll(id){
            $.ajax({
                type : "GET",
                url : "/deleteEnrollment/" + id,
                dataType : "json",
                contentType: "application/json",
                success : function(data) {
                    success('This reservation has been Cancelled');
                    fetchAllReservation();
                },
                error : function(data) {
                    error('There was an error during the cancellation of the this date.')
                }
            });
        }
    </script>
<div class="card-header">
   
</div>
<div class="card-body pt-0">
    <table class="table table-hover" id="tblReservation" >
        <thead>
            <tr>
                <th style="text-align:center;">Course</th>
                <th style="text-align:center;">Category</th>
                <th style="text-align:center;">Date of Reservation</th>
                <th style="text-align:center;">Date of Forfeit</th>
                <th style="text-align:center;">Action</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach($enrollments as $enrollment)
                <tr style="text-align:center;">
                    <td>{{$enrollment->ClassSchedule->course->name}}</td>
                    <td>{{$enrollment->ClassSchedule->category->name}}</td>
                    <td>{{date('F d, y', strtotime($enrollment->created_at))}}</td>
                    <td>{{date('F d, y', strtotime($enrollment->ClassSchedule->day_start.  '-2 days'))}}</td>
                    <td>
                        <a onclick="return cancel({{$enrollment->id}})"
                            class="btn btn-icon me-2 btn-danger"
                            data-bs-toggle="tooltip"
                            data-bs-offset="0,4"
                            data-bs-placement="right"
                            data-bs-html="true"
                            title="Cancel Reservation"
                        >
                            <i class='bx bx-x-circle' ></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>