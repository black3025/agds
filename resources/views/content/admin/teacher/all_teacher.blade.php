<script>
        $(document).ready( function () {
            $('#tblTeacher').DataTable();
        });
</script>
<div class="card-header">
    <div class="row mb-12">
        <div class="text-end mb-12">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTeacher"><i class='bx bxs-message-square-add'></i>&nbsp; Add</button>
        </div>
    </div>
</div>
<div class="card-body pt-0">
    <br><br>
    <table class="table table-hover" id="tblTeacher" >
        <thead>
            <tr>
                <th>Teacher ID</th>
                <th>Full name</th>
                <th>Number of active Course</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach($teachers as $teacher)
                <tr>
                    <td>{{$teacher->teacherID}}</td>
                    <td><a href="{{route('student.show',$teacher->id)}}">{{$teacher->user->fname}} {{$teacher->user->mname}} {{$teacher->user->lname}}</a></td>
                    <td>{{$teacher->ClassSchedule}}</td>
                    <td><a onclick="setCourseId({{$teacher->user->id}})" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal" fdprocessedid="dyx4wr"><i class='bx bxs-comment-add'></i>Book</a></td>
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
                <button type="button" id="mdClose" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <img class="card-img-top" src={{ asset('assets/img/QR.png') }} alt='gcashQR'>
                    <div class="col mb-6">
                        <form onsubmit="return enroll( {{Auth::user()->id}} );">
                            @csrf
                            <label for="refno" class="form-label">Reference Number</label>
                            <input hidden tabindex ="-1"    type="text" name="ClassSchedule_id" id="ClassSchedule_id" />
                            <input type="text" id="refno" name="refno" class="form-control" placeholder="Reference Number" required />
                    </div>
                </div>
                        <center><button type="submit" class="btn btn-primary right">Enroll now</button></center>
                    </form>
            </div>
        </div>
    </div>
</div>