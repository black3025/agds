@extends('layouts/blankLayout')

@section('title', 'Student Registration')

@section('page-style')
<!-- Page -->
  <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
  <script src="{{asset('assets/js/sweetalert2.all.min.js')}}"></script>
  <script src="{{asset('assets/js/swal.js')}}"></script>
@endsection


@section('content')
<div class="container-xxl">
    <div class="authentication-inner">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <!-- Register Card -->
            <div class="card">
              <div class="card-body">
                <form id="formAuthentication" class="mb-3" action="{{route('students.store')}}" method="POST">
                @csrf
                  <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" autofocus>
                    @error('username')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
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

                  <div class="mb-3">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms">
                      <label class="form-check-label" for="terms-conditions">
                        I agree to
                        <a data-bs-toggle="modal" data-bs-target="#termsCondition" href="javascript:void(0);">privacy policy & terms</a>
                      </label>
                    </div>
                  </div>
                  <button class="btn btn-primary d-grid w-100">
                    Sign up
                  </button>
                </form>

                <p class="text-center">
                  <span>Already have an account?</span>
                  {{-- <span><a href="{{ route('google.redirect') }}" class="btn btn-primary"> Login with Google </a></span> --}}
                  <a href="{{url('auth/login')}}">
                    <span>Sign in instead</span>
                  </a>
                </p>
              </div>
            </div>
      <!-- Register Card -->
    </div>
  </div>
 <div class="modal fade" id="termsCondition" tabindex="-1" aria-hidden="true">
            <div class="modal-content">
                <div class="modal-dialog modal-dialog-center modal-md">
                  <div class="modal-body">
                        <div class="modal-header">
                            <h5 class="modal-title" id="termsCondition"><i class='bx bx-book-open' ></i> Terms & Conditions</h5>
                            {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>  --}}
                        </div>
                          Dance Studio No Show/Cancellation Policy
                          No Show
                          Dance studio reservations are confirmed 30 minutes from the event start time. If the group or individual fails to show up after 30 minutes, the Office of Event Services staff will consider that a no show and reserves the right to reassign the room if the need arises.

                          Cancellations
                          Dance Studios Reservations must be cancelled by 12:00pm the day before the event (12:00pm on Friday for events occurring Saturday, Sunday or Monday). Cancellations received after this deadline will be considered late cancellations.

                          First and Second Offense

                          A warning email will be sent to the offending individual or organization after each no show or late cancellation offense.
                          Third Offense

                          All remaining dance studio reservations for the individual or organization in the current semester will be cancelled.
                          Individual or organization will be permitted to make reservations for future semesters.
                          Three offenses each in two consecutive semesters will result in the cancellation of all remaining reservations and the suspension of AGDS reservation privileges through the end of the following semester.
                  </div>
                </div>
            </div>  
        </div>  

        <!-- Button trigger modal -->
</div>
@endsection
