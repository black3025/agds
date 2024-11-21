<script>
        $(document).ready( function () {
            $('#tblRoom').DataTable();
        });        
        function toggleActive(id)
        {
            $.ajax({
                type : "GET",
                url : "/admin/room-status/" + id,
                dataType : "json",
                contentType: "application/json",
                crossDomain: true,
                success : function(data) {
                    $.get('{{route("getRoom")}}',{},function(data){
                        $('#all_room').html(data.result);
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
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoom">
                <i class='bx bxs-message-square-add'></i> &nbsp; Add
            </button>
        </div>
    </div>
</div>
<div class="card-body pt-0">
    <table class="table table-hover" id="tblRoom" >
        <thead>
            <tr>
                <th style="text-align:center;">Room name</th>
                <th style="text-align:center;">Capacity</th>
                <th style="text-align:center;">Action</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach($rooms as $room)
                <tr>
                    <td>{{$room->name}}</td>                    
                    <td align="center">{{$room->capacity}}</td>
                    <td>
                        <div class="row col-lg-12">
                            <div class="col-lg-6 mb-6 text-end">
                                <a 
                                type="button"
                                class="btn btn-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#basicModal"
                                title ="Edit"
                                onclick="setsUroom({{$room}})"
                                >
                                        <i class='bx bx-edit-alt'></i>
                                </a>
                            </div>
                            <div class="col-lg-6 mb-6">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="is_active.{{$room->id}}" name="is_active"  {{$room->status == "1" ? "checked" : ""}} onchange="toggleActive({{$room->id}})">
                                    <label class="form-check-label" for="is_active.{{$room->id}}">
                                        <span style = 'color:{{$room->status == "1" ? "green": "red"}};'>
                                            {{$room->status == "1" ? "Active": "Inactive"}}
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
