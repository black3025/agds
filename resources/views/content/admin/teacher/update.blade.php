<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true" style="display: none;">
  <div class="modal-dialog" role="document">
    <form action="{{route('updateTeacher')}}" method="post" enctype="multipart/form-data" id = "editTeacherForm">
        @csrf
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel1">Update Teacher</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="mb-3">
                <input type="text" class="form-control" id="edit_uid" name="edit_uid" hidden>
                <input type="text" class="form-control" id="edit_tid" name="edit_tid" hidden>
                <label for="edit_fname" class="form-label">Given name</label>
                <input type="text" class="form-control" id="edit_fname" name="edit_fname" placeholder="Enter Given Name">
                <span class="text-danger error-text edit_fname_error" > </span>
            </div>
            <div class="mb-3">
                <label for="edit_mname" class="form-label">Middle Name</label>
                <input type="text" class="form-control" id="edit_mname" name="edit_mname" placeholder="Enter Middle Name">
                <span class="text-danger error-text edit_mname_error" > </span>
            </div>
            <div class="mb-3">
                <label for="edit_lname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="edit_lname" name="edit_lname" placeholder="Enter Last Name">
                <span class="text-danger error-text edit_lname_error" > </span>
            </div>
            <div class="mb-3">
                <label for="edit_bday" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="edit_bday" name="edit_bday" placeholder="Enter Birth Day">
                <span class="text-danger error-text edit_bday_error" > </span>
            </div>
            <div class="mb-3">
                <label for="edit_email" class="form-label">Email</label>
                <input type="text" class="form-control" id="edit_email" name="edit_email" placeholder="Enter email">
                <span class="text-danger error-text edit_email_error" > </span>
            </div>
            <div class="mb-3">
                <span class = "form-label" style="margin-bottom: 5px;">Mastery</span>
                <div class="row mb-3" >
                    @foreach( $courses as $course)
                        <div class="col-md-3">
                            <input class="form-check-input" type="checkbox" name="edit_mastery[]" id="edit_{{$course->id}}" value={{$course->id}}>
                            <label for="edit_{{$course->id}}" class="form-label">{{$course->name}}</label>  
                        </div>
                    @endforeach
                    <span class="text-danger error-text edit_mastery_error" > </span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="mdaclosebutton2">Close</button>
                <button type="submit" class="btn btn-primary" id="submit">Edit</button>
            </div>
        </div>
      </div>
    </form>
  </div>
</div>