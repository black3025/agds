@forelse($courses as $course)
    <div class="mb-12 col-md-3 g-6" style="margin-bottom:15px">
            <a href="{{ route('course.show',$course->id) }}" >
                <div class="card h-100">
                    <img class="card-img-top" src={{ asset('storage/course_image/' .$course->image_display) }} alt={{ $course->name.' image' }}>
                    <div class="card-body">
                       <h5 class="card-title">{{$course->name}}</h5>
                        <p class="card-text">
                           {{ Str::limit($course->description, 50)}} <p class="right">read more...</p>
                        </p>
                    </div>
                </div>
            </a>
    </div>
@empty
    <code>No Course Available</code>
@endforelse