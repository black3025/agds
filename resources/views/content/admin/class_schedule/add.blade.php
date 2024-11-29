<div class="modal fade" id="addEnrollModal" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
    <form action="{{route('schedule.store')}}" method="post" enctype="multipart/form-data" id = "addSchedule">
        @csrf
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">{{$course->name}} - New Schedule</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <input type="text" id="course" name="course" value="{{$course->id}}" hidden/>
        <div class="modal-body">
            <div class="row">
                <div class="col mb-6">
                    <label for="add_category" class="form-label">Category</label>
                    <select class = "form-control" name="add_category" id="add_category">
                        <option disabled selected>Please Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                     <span class="text-danger error-text add_category_error" > </span>
                </div>
            </div>
            <div class="row">
                <div class="col mb-6">
                    <label for="add_studio" class="form-label">Studio</label>
                    <select class = "form-control" name="add_studio" id="add_studio" onchange="setMax()">
                        <option disabled selected>Please Select Studio</option>
                        @foreach($rooms as $room)
                            <option value="{{$room->id}}">{{$room->name}} | capacity: {{$room->capacity}}</option>
                        @endforeach
                    </select>
                     <span class="text-danger error-text add_studio_error" > </span>
                </div>
            </div>
            <div class="row mb-6">
                <div class="col mb-6">
                    <label for="add_slot" class="form-label">Slots</label>
                    <div class="row">
                        <div class="col lg-6"><input type="number" min ="1" class="form-control" name = "add_slot" id = "add_slot" ></div>
                        {{-- <div class="col lg-6"><input type="date" class="form-control" name = "add_dateTo" ></div> --}}
                    </div>
                    <span class="text-danger error-text add_slot_error" > </span>
                </div>
            </div>
            <div class="row">
                <div class="col mb-6">
                    <label for="add_trainer" class="form-label">Trainer</label>
                    <select class = "form-control" name="add_trainer" id="add_trainer">
                        <option disabled selected>Please Select Trainer</option>
                        @foreach($teachers as $teacher)
                            <option value="{{$teacher->user->id}}">{{$teacher->teacherID}}- {{$teacher->user->fname}} {{$teacher->user->lname}}</option>
                        @endforeach
                    </select>
                     <span class="text-danger error-text add_trainer_error" > </span>
                </div>
            </div>

            <div class="row mb-6">
                <div class="col mb-6">
                    <label for="add_dateFrom" class="form-label">Start Date</label>
                    <div class="row">
                        <div class="col lg-6"><input type="date" onchange="setDay(this.value)" class="form-control" name = "add_dateFrom" ></div>
                        {{-- <div class="col lg-6"><input type="date" class="form-control" name = "add_dateTo" ></div> --}}
                    </div>
                    <span class="text-danger error-text add_dateFrom_error add_dateTo_error" > </span>
                </div>
            </div>
            <div class="row mb-6">
                <div class="col mb-6">
                    <label for="add_duration" class="form-label">Duration</label>
                    <div class="row">
                        <div class="col lg-6"><input type="number" min ="1" max="30" class="form-control" name = "add_duration" ></div>
                        {{-- <div class="col lg-6"><input type="date" class="form-control" name = "add_dateTo" ></div> --}}
                    </div>
                    <span class="text-danger error-text add_duration_error" > </span>
                </div>
            </div>
            <div class="row">
                <label class="form-label" style ="margin-top:6px">Days of the Week</label>
                <div class="col mb-6" style="display:flex; justify-content:space-between;">
                    <input class="form-check-input" type="checkbox" name="add_weekdays[]" id="Monday" value="0">
                    <label for="Monday" class="form-label">Mon</label>  
                    <input class="form-check-input" type="checkbox" name="add_weekdays[]" id="Tuesday" value="1">
                    <label for="Tuesday" class="form-label">Tues</label>  
                    <input class="form-check-input" type="checkbox" name="add_weekdays[]" id="Wednesday" value="2">
                    <label for="Wednesday" class="form-label">Wed</label>  
                    <input class="form-check-input" type="checkbox" name="add_weekdays[]" id="Thursday" value="3">
                    <label for="Thursday" class="form-label">Thur</label>  
                    <input class="form-check-input" type="checkbox" name="add_weekdays[]" id="Friday" value="4">
                    <label for="Friday" class="form-label">Fri</label>  
                    <input class="form-check-input" type="checkbox" name="add_weekdays[]" id="Saturday" value="5">
                    <label for="Staturday" class="form-label">Sat</label>  
                    <input class="form-check-input" type="checkbox" name="add_weekdays[]" id="Sunday" value="6">
                    <label for="Sunday" class="form-label">Sun</label>  
                </div>
                    <span class="text-danger error-text add_weekdays_error" > </span>
            </div>
            <div class="row">
                <div class="col mb-6">
                    <label for="add_dateFrom" class="form-label">Time Slot</label>
                    <div class="row">
                        <div class="col lg-6"><input type="time" class="form-control" name = "add_timeFrom" ></div>
                        <div class="col lg-6"><input type="time" class="form-control" name = "add_timeTo" ></div>
                    </div>
                    <span class="text-danger error-text add_timeFrom_error add_timeTo_error" > </span>
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
</div>