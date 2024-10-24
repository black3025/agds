<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
    <form action="{{route('updateCourse')}}" method="post" enctype="multipart/form-data" id = "editCourse">
        @csrf
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Edit Course</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col mb-6">
                    <label for="id" class="form-label" hidden>ID</label>
                    <input type="text" id="id" name="id" class="form-control" hidden>
                </div>
            </div>
             <div class="row">
                <div class="col mb-6">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" onchange="toggleActive()">
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col mb-6">
                    <label for="name" class="form-label">Course Name</label>
                    <input type="text" id="name" name="name" class="form-control">
                    <span class="text-danger error-text name_error" > </span>

                </div>
            </div>
            <div class="row">
                <div class="col mb-6">
                    <label for="description" class="form-label">Description</label>
                    <textarea rows="10" class="form-control" id="description" name="description"></textarea>
                     <span class="text-danger error-text description_error" > </span>
                </div>
            </div>
            
             <div class="row">
               <div class="col-4 mb-8">
                    <img class="mt-3" width= "150 px" src="" alt="Course Image" name="img_prev" id="img_prev">
               </div>
                <div class="col-8 mb-8">
                    <label for="description" class="form-label">Display Image</label>
                    <input type="file" class="form-control" id="image_display" name="image_display" onchange="loadFile(event)"></input>
                    <span class="text-danger error-text image_display_error" > </span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="mdclosebutton">Close</button>
            <button type="submit" class="btn btn-primary" id="submit">Update</button>
        </div>
        </div>
    </form>
    </div>
</div>