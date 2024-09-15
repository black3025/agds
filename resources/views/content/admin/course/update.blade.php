<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
    <form >
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Edit Course</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
            <div class="col mb-6">
                <label for="name" class="form-label">Course Name</label>
                <input type="text" id="name" name="name" class="form-control">
            </div>
            </div>
            <div class="row">
                <div class="col mb-6">
                    <label for="description" class="form-label">Course Name</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>
            </div>
             <div class="row">
                <div class="col mb-6">
                    <label for="description" class="form-label">Display Image</label>
                    <input type="file" class="form-control" id="description" name="description"></input>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
        </div>
    </form>
    </div>
</div>