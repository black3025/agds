@forelse($classess as $class)
    <div class="col-md-6 col-lg-3" style="margin-bottom:15px">
        <div class="mb-12 card h-100">
            <div class="card-header">
                <a class = "mb-10" style="align:right" data-bs-toggle="modal" data-bs-target="#basicModal" href="#" onclick="setss({{$class->course}},'{{asset('storage/course_image/' .$class->course->image_display)}}');">Edit</a>
                <a href="{{ route('admin-course.show',$class->course->id) }}">
                <img class="card-img-top" src={{ asset('storage/course_image/' .$class->course->image_display) }} alt={{ $class->course->name.' image' }}>
            </div>
            <div class="card-body">
                <div class="row mb-3 card-title">
                    <h5 class="col">{{$class->course->name}}</h5> 
                    @if($class->course->is_active == 1)    
                        <span class="col text-end text-success">[ACTIVE]</span> 
                    @else
                        <span class="col text-end text-danger">[INACTIVE]</span> 
                    @endif
                </div>
                <p class="card-text">
                    {{ $class->course->description}} <p class="right"> read more...</p>
                </p>
            </div>
            </a>
        </div>
    
    </div>
@empty
    <code>No Course Available</code>
@endforelse