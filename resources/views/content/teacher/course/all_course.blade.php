@forelse($classess as $class)
   <div class="col-md-6 col-lg-3" style="margin-bottom:15px">
        <a href="{{route('Teacher Schedule',$class->id)}}"
        <div class="mb-12 card h-100">
            <div class="card-header">
                <img class="card-img-top" src={{ asset('storage/course_image/' . $class->course->image_display) }} alt={{ $class->course->name.' image' }}>
            </div>
            <div class="card-body">
                <div class="row mb-3 card-title">
                    <h5 class="col">{{$class->course->name}} | {{$class->course->category->name}}</h5> 
                    @if($class->course->is_active == 1)    
                        <span class="col text-end text-success">[ACTIVE]</span> 
                    @else
                        <span class="col text-end text-danger">[CLOSE]</span> 
                    @endif
                </div>
                <p class="card-text">
                  <strong>{{date('M. d, Y',strtotime($class->day_start))}}</strong> ({{$class->duration}} Session)<br>
                  {{date('h:i a',strtotime($class->time_start))}} to{{date('h:i a',strtotime($class->time_end))}}<br>
                  @foreach (explode("|", $class->week) as $day)
                        @if($day == 0)
                                    Sunday,
                                @endif
                                @if($day == 1)
                                    Monday,
                                @endif
                                @if($day == 2)
                                    Tuesday,
                                @endif
                                @if($day == 3)
                                    Wednesday,
                                @endif
                                @if($day == 4)
                                    Thursday,
                                @endif
                                @if($day == 5)
                                    Friday,
                                @endif
                                @if($day == 6)
                                    Saturday,
                                @endif
                  @endforeach
                </p>
            </div>
            </a>
        </div>
    </div>
@empty
    <code>No Course Available</code>
@endforelse