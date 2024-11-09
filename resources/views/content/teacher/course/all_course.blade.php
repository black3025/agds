@forelse($classess as $class)
   <div class="col-md-6 col-lg-3" style="margin-bottom:15px">
        <div class="mb-12 card h-100">
            <div class="card-header">
                <img class="card-img-top" src={{ asset('storage/course_image/' . $class->course->image_display) }} alt={{ $class->course->name.' image' }}>
            </div>
            <div class="card-body">
                <div class="row mb-3 card-title">
                    <h5 class="col">{{$class->course->name}}</h5> 
                    @if($class->course->is_active == 1)    
                        <span class="col text-end text-success">[ACTIVE]</span> 
                    @else
                        <span class="col text-end text-danger">[CLOSE]</span> 
                    @endif
                </div>
                <p class="card-text">
                  {{date('M. d, Y',strtotime($class->day_start))}} to {{date('M. d, Y',strtotime($class->day_end))}}<br>
                  {{date('h:s a',strtotime($class->time_start))}} to{{date('h:s a',strtotime($class->time_end))}}
                </p>
            </div>
            </a>
        </div>
    
    </div>
@empty
    <code>No Course Available</code>
@endforelse