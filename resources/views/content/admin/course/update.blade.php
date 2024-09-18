<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
    <form onsubmit="updateForm()" name="editCourse" id = "editCourse">
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
                    <label for="name" class="form-label">Course Name</label>
                    <input type="text" id="name" name="name" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col mb-6">
                    <label for="description" class="form-label">Description</label>
                    <textarea rows="10" class="form-control" id="description" name="description"></textarea>
                </div>
            </div>
             <div class="row">
               <div class="col-4 mb-8">
                    <img class="mt-3" width= "150 px" src="" alt="Course Image" name="img_prev" id="img_prev">
               </div>
                <div class="col-8 mb-8">
                    <label for="description" class="form-label">Display Image</label>
                    <input type="file" class="form-control" id="img_display" name="img_display" onchange="loadFile(event)"></input>
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

    <script>
            var loadFile = function(event) {
                var reader = new FileReader();
                reader.onload = function(){
                var output = document.getElementById('img_prev');
                output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            };

            function updateForm(){
                var form = $('#editCourse').serialize();
                $.ajax({
                    url : "{{route('updateCourse')}}",
                    data :  form,
                    type : "POST",
                    success : function(msg){
                        console.log(msg);
                        if(msg['success']){
                            success(msg['message']);
                            setTimeout(function(){window.location.reload();},1500);
                        }else{
                            error(msg['message']);
                        }
                    }
                });
                return false;
            }
    </script>
</div>