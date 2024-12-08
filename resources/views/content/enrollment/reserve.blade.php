 <script>
        $(document).ready( function () {
            $('#tblReservation').DataTable();
        });
                 
        function setCourseId(id,amount)
        {
            $('#id').val(id);
            $('#amount').val(amount);
        }

        function enrollUp(id){
                var form = {
                    _token: $('input[name=_token]').val(),
                    id : $('#id').val(),
                    referenceNo: $('#refno').val(),
                    amount: $('#amount').val(),
                    ajax: 1
                }
                $.ajax({
                url : "{{route('enrollUp')}}",
                data :  form,
                type : "POST",
                success : function(data){
                    if(data.code == 1){
                        success("Enrollment Posted.");
                        fetchAllReservation()
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

        function fetchAllReservation(){
            $.get('{{route("getReservation")}}',{},function(data){
                $('#all_reservation').html(data.result);
            },'json');
        }
        
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
                url : "/deleteEnrollment/" + id,
                dataType : "json",
                contentType: "application/json",
                success : function(data) {
                    fetchAllReservation();
                    success('This reservation has been Cancelled');
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
                        <a onclick="setCourseId({{$enrollment->id}},{{$enrollment->amount}})"
                             class="btn btn-icon me-2 btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#basicModal"
                            fdprocessedid="dyx4wr"
                            title="Enroll"
                        >
                            <i class='bx bx-book'></i>
                        </a>
                        <a onclick="return cancel({{$enrollment->id}})"
                            class="btn btn-icon me-2 btn-danger"
                            data-bs-toggle="tooltip"
                            data-bs-offset="0,4"
                            data-bs-placement="right"
                            title="Cancel Reservation"
                        >
                            <i class='bx bx-x-circle' ></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
     <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Enrollment Payment</h5>
                            <button type="button" id="mdClose" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <div class="row mb-3">
                            <img class="card-img-top" src={{ asset('assets/img/QR.png') }} alt='gcashQR'>
                                <div class="col mb-6">
                                    <form onsubmit="return enrollUp({{Auth::user()->id}})">
                                        @csrf
                                        <label for="refno" class="form-label">Reference Number</label>
                                        <input hidden tabindex ="-1"  type="text" name="id" id="id" />
                                        <input type="text" minlength="12" id="refno" name="refno" class="form-control" placeholder="Reference Number" required />
                                        <span class="text-danger error-text refno_error" > </span>
                                        <label for="amount" class="form-label">Course Price</label>
                                        <input type="text" readonly id="amount" name="amount" class="form-control" />
                                        <center><button type="submit" class="btn btn-primary right">Enroll now</button></center>
                                        </form>
                                </div>
                        </div>
                        </div>
                </div>
</div>