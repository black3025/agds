<script>
        $(document).ready( function () {
            $('#tblTeacher').DataTable();
        });        
        function toggleActive(id)
        {
            $.ajax({
                type : "GET",
                url : "/admin/user-status/" + id,
                dataType : "json",
                contentType: "application/json",
                crossDomain: true,
                success : function(data) {
                    $.get('{{route("getTeacher")}}',{},function(data){
                        $('#all_teacher').html(data.result);
                    },'json');
                },
                error : function(data) {
                    console.log("Fialed to get the data");
                }
            });
        };      
</script>
<div class="card-header">
    <div class="row mb-12">
        <div class="text-end mb-12">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTeacher">
                <i class='bx bxs-message-square-add'></i> &nbsp; Add
            </button>
        </div>
    </div>
</div>
<div class="card-body pt-0">
    <table class="table table-hover" id="tblTeacher" >
        <thead>
            <tr>
                <th style="text-align:center;">Teacher ID</th>
                <th style="text-align:center;">Full name</th>
                <th style="text-align:center;">Number of active Course</th>
                <th style="text-align:center;">Action</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach($teachers as $teacher)
                <tr>
                    <td>{{$teacher->teacherID}}</td>
                    <td><a href="{{route('student.show',$teacher->id)}}">{{$teacher->user->fname}} {{$teacher->user->mname}} {{$teacher->user->lname}}</a></td>
                    <td>{{$teacher->user->ClassSchedules->where('is_active',1)->count()}}</td>
                    <td>
                        <div class="row">
                            <div class="col mb-6">
                                <a onclick="#"
                                type="button"
                                class="btn btn-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#basicModal"
                                title ="Edit"
                                >
                                        <i class='bx bx-edit-alt'></i>
                                </a>
                            </div>
                            <div class="col mb-6">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"  {{$teacher->user->is_active == "1" ? "checked" : ""}} onchange="toggleActive({{$teacher->user->id}})">
                                    <label class="form-check-label" for="is_active">
                                        <span style = 'color:{{$teacher->user->is_active == "1" ? "green": "red"}};'>
                                            {{$teacher->user->is_active == "1" ? "Active": "Inactive"}}
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
