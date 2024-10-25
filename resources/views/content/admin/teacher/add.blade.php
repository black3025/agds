<div class="modal fade" id="addTeacher" tabindex="-1" aria-hidden="true" style="display: none;">
  <div class="modal-dialog" role="document">
    <form action="{{route('teacher.store')}}" method="post" enctype="multipart/form-data" id = "addTeacherForm">
        @csrf
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel1">Add Teacher</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
                <label for="fname" class="form-label">Given name</label>
                <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter Given Name">
                <span class="text-danger error-text fname_error" > </span>
            </div>
            <div class="mb-3">
                <label for="mname" class="form-label">Middle Name</label>
                <input type="text" class="form-control" id="mname" name="mname" placeholder="Enter Middle Name">
                <span class="text-danger error-text mname_error" > </span>
            </div>
            <div class="mb-3">
                <label for="lname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Last Name">
                <span class="text-danger error-text lname_error" > </span>
            </div>
            <div class="mb-3">
                <label for="bday" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="bday" name="bday" placeholder="Enter Birth Day">
                <span class="text-danger error-text bday_error" > </span>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
                <span class="text-danger error-text email_error" > </span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="mdaclosebutton">Close</button>
                <button type="submit" class="btn btn-primary" id="submit">Add</button>
            </div>
      </div>
    </form>
  </div>
</div>