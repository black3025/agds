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

            <div class="row">
                <div class="col mb-6">
                    <label for="add_dateFrom" class="form-label">Inclusive Date</label>
                    <div class="row">
                        <div class="col lg-6"><input type="date" class="form-control" name = "add_dateFrom" ></div>
                        <div class="col lg-6"><input type="date" class="form-control" name = "add_dateTo" ></div>
                    </div>
                    <span class="text-danger error-text add_dateFrom_error add_dateTo_error" > </span>
                </div>
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