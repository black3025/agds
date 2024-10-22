<div class="modal fade" id="addTeacher" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
    <form action="{{route('teacher.store')}}" method="post" enctype="multipart/form-data" id = "addTeacher">
        @csrf
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Add Teacher</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="mb-3">
                    <label for="fname" class="form-label">Given name</label>
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter your Given Name">
                    @error('fname')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="mname" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="mname" name="mname" placeholder="Enter your Middle Name">
                    @error('mname')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="lname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter your Last Name">
                    @error('lname')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="bday" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="bday" name="bday" placeholder="Enter Birth Day">
                    @error('bday')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email">
                    @error('email')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-3 form-password-toggle">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-group input-group-merge">
                      <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                    @error('password')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-3 form-password-toggle">
                    <label class="form-label" for="password_confirmation">Re-enter Password</label>
                    <div class="input-group input-group-merge">
                      <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password_confirmation" />
                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                    @error('password_confirm')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
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