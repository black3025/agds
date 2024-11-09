<div class="modal fade" id="addCourseModal" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
    <form action="{{route('admin-course.store')}}" method="post" enctype="multipart/form-data" id = "addCourse">
        @csrf
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Add Course</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col mb-6">
                    <label for="add_name" class="form-label">Course Name</label>
                    <input type="text" id="add_name" name="add_name" class="form-control">
                    <span class="text-danger error-text add_name_error" > </span>

                </div>
            </div>
            <div class="row">
                <div class="col mb-6">
                    <label for="add_description" class="form-label">Description</label>
                    <textarea rows="10" class="form-control" id="add_description" name="add_description"></textarea>
                     <span class="text-danger error-text add_description_error" > </span>
                </div>
            </div>
            
             <div class="row">
               <div class="col-4 mb-8">
                    <img class="mt-3" width= "150 px" src="{{asset('storage/course_image/course_img.png')}}" alt="Course Image" name="add_img_prev" id="add_img_prev">
               </div>
                <div class="col-8 mb-8">
                    <label for="description" class="form-label">Display Image</label>
                    <input type="file" class="form-control" id="add_image_display" name="add_image_display" onchange="addloadFile(event)"></input>
                    <span class="text-danger error-text add_image_display_error" > </span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="mdaclosebutton">Close</button>
            <button type="submit" class="btn btn-primary" id="submit">Add</button>
        </div>
        </div>
    </form>
    </div>

    <script>
            var addloadFile = function(event) {
                var reader = new FileReader();
                reader.onload = function(){
                var output = document.getElementById('add_img_prev');
                output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            }
    </script>
</div>