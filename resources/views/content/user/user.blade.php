@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Student')


@section('page-script')
<script>
      $(function(){
              $('#updateProfile').on('submit', function(e){
                  e.preventDefault();
                  var form = this;
                  $.ajax({
                      url:$(form).attr('action'),
                      method:$(form).attr('method'),
                      data: new FormData(form),
                      processData: false,
                      dataType: 'json',
                      contentType: false,
                      beforeSend:function(){
                          $(form).find('span.error-text').text('');
                      },
                      success:function(data){
                        if(data.code==0){
                              $.each(data.error, function(prefix, val){
                                  $(form).find('span.'+prefix+'_error').text("TESTING");
                                  alert("madsli!!!!");
                              });
                          }else{                              
                              $(form)[0].reset();
                              success(data.msg);
                              setTimeout(window.location.reload.bind(window.location), 1000);
                          }

                      }

                  })
              });
      });
  </script>
@endsection

@section('content')
    <div class="row">
  <div class="col-md-12">
    <div class="card mb-6">
      <!-- Account -->
      <div class="card-body">
        <form action="{{route('userUpdate')}}" method="post" enctype="multipart/form-data" id="updateProfile">
          @csrf
        <div class="d-flex align-items-start align-items-sm-center gap-6 pb-4 border-bottom">
          <img src="{{ asset('storage/profile-photos/1.png') }}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" name="uploadedAvatar" id="uploadedAvatar">
          <div class="button-wrapper">
            <label for="upload" class="btn btn-primary me-3 mb-4" tabindex="0">
              <span class="d-none d-sm-block">Upload new photo</span>
              <i class="bx bx-upload d-block d-sm-none"></i>
              <input type="file" id="upload" name="upload" class="account-file-input" hidden="" accept="image/png, image/jpeg" onchange="addloadFile(event)">
            </label>
            <div>Allowed JPG, GIF or PNG.</div>
          </div>
        </div>
      </div>
      <div class="card-body pt-4">
          <div class="row g-6">
            <div class="col-md-4" style="margin-bottom:10px">
              <label for="firstName" class="form-label">First Name</label>
              <input class="form-control" type="text" id="firstName" name="firstName" value="{{$user->fname}}" autofocus="">
              <span class="text-danger error-text firstName_error" > </span>
            </div>
             <div class="col-md-4" style="margin-bottom:10px">
              <label for="lastName" class="form-label">Middle Name</label>
              <input class="form-control" type="text" name="middleName" id="middleName" value="{{$user->mname}}">
              <span class="text-danger error-text middleName_error" > </span>
            </div>
            <div class="col-md-4" style="margin-bottom:10px">
              <label for="lastName" class="form-label">Last Name</label>
              <input class="form-control" type="text" name="lastName" id="lastName" value="{{$user->lname}}">
              <span class="text-danger error-text lastName_error" > </span>
            </div>
            <div class="col-md-6" style="margin-bottom:10px">
              <label for="bday" class="form-label">Birthday</label>
              <input class="form-control" type="date" id="bday" name="bday" value="{{$user->birthday}}">
              <span class="text-danger error-text bday_error" > </span>
            </div>
            <div class="col-md-6" style="margin-bottom:10px">
              <label for="email" class="form-label">E-mail</label>
              <input class="form-control" type="text" id="email" name="email" value="{{$user->email}}"" placeholder="john.doe@example.com">
              <span class="text-danger error-text email_error" > </span>
            </div>
          </div>
          <div class="mt-6">
            <button type="submit" class="btn btn-primary me-3">Save changes</button>
            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
          </div>
       
      </div>
      </form>
      <!-- /Account -->
    </div>
    <div class="card" style="margin-top:15px;">
      <h5 class="card-header">Deactivate Account</h5>
      <div class="card-body">
        <div class="mb-6 col-12 mb-0">
          <div class="alert alert-warning">
            <h5 class="alert-heading mb-1">Are you sure you want to deactivate your account?</h5>
            <p class="mb-0">Once you deactivated your account, there is no going back. Please be certain.</p>
          </div>
        </div>
        <form id="formAccountDeactivation" onsubmit="return false">
          <div class="form-check my-8 ms-2">
            <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation">
            <label class="form-check-label" for="accountActivation">I confirm my account deactivation</label>
          </div>
          <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
 <script>
            var addloadFile = function(event) {
                var reader = new FileReader();
                reader.onload = function(){
                var output = document.getElementById('uploadedAvatar');
                output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            }
    </script>