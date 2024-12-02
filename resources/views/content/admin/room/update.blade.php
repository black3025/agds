<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
    <form action="{{route('updateRoom')}}" method="post" enctype="multipart/form-data" id = "editRoom" name = "editRoom">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Edit Room</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input hidden class="form-control" name = "e_id" id="e_id" />
                <div class="row">
                    <div class="col mb-6">
                        <label for="e_name" class="form-label">Room Name</label>
                        <input  class="form-control" name = "e_name" id="e_name" />
                        <span class="text-danger error-text e_name_error" > </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-6">
                        <label for="e_capacity" class="form-label">Capacity</label>
                        <input class="form-control" name="e_capacity" id="e_capacity" />
                        <span class="text-danger error-text e_capacity_error" > </span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="mdaclosebutton2">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>