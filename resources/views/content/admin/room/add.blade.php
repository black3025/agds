<div class="modal fade" id="addRoom" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
    <form action="{{route('room.store')}}" method="post" enctype="multipart/form-data" id = "addRoomForm">
        @csrf
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">New Room</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col mb-6">
                    <label for="add_name" class="form-label">Room Name</label>
                    <input class="form-control" name = "add_name" id="add_name" />
                     <span class="text-danger error-text add_name_error" > </span>
                </div>
            </div>
            <div class="row">
                <div class="col mb-6">
                    <label for="add_capacity" class="form-label">Capacity</label>
                    <input class="form-control" name="add_capacity" id="add_capacity" />
                     <span class="text-danger error-text add_capacity_error" > </span>
                </div>
            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="mdaclosebutton">Close</button>
            <button type="submit" class="btn btn-primary" id="submit">Add</button>
        </div>
        </div>
    </form>
    </div>
</div>