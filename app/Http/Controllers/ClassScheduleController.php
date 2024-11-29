<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassSchedule;

class ClassScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $now = date('Y-m-d');
        // 'add_dateTo' => 'date|required|after_or_equal:' . date('Y-m-d',strtotime($request->add_dateFrom)),'add_dateTo.required' => 'Please select a valid date.',
        // 'add_dateTo.date' => 'Please select a valid date.',
        // 'add_dateTo.after_or_equal' => 'The end date must be a date after or equal to starting day.',
        $validator = \Validator::make(
            $request->all(),
            [
              'add_category' => 'required',
              'add_trainer' => 'required',
              'add_dateFrom' => 'date|required|after_or_equal:'. $now,
              'add_studio' => 'required',
              'add_slot' => 'required',
              'add_timeFrom' => 'date_format:H:i|required',
              'add_duration' => 'required',
              'add_timeTo' => 'date_format:H:i|required|after:'.date('H:i', strtotime($request->add_timeFrom)),
              'add_weekdays' => 'required'
            ],
            [
                'add_category.required' => 'Please select a category.',
                'add_trainer.required' => 'Please select a Trainer.',
                'add_studio.required' => 'Please select a studio.',
                'add_dateFrom.required' => 'Please select a valid date.',
                'add_dateFrom.date' => 'Please select a valid date.',
                'add_dateFrom.after_or_equal' => 'The start date must be a date after or equal today.',
                'add_duration' => 'Please set the number of days for this course',
                'add_slot.required' => 'Please input the maximum allowed student in this course.',
                'add_weekdays' => 'Please set the set day(s) of the week.',
                'add_timeFrom.required' => 'Please select a valid time.',
                'add_timeFrom.date_format' => 'Please select a valid time.',
                
                
                'add_timeTo.required' => 'Please select a valid time.',
                'add_timeTo.date_format' => 'Please select a valid time.',
                'add_timeTo.after' => 'The end time must not be before the starting time.',

            ]
        );
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        }else{
            if($this->checkAvailable($request->add_studio,$request->add_trainer, $request->add_dateFrom, $request->add_duration)){
                $dday = '';
                $days = $request->add_weekdays;
                foreach ($days as $d) {
                  $dday = $dday . $d . '|';
                }
                $sched = ClassSchedule::create([
                    'user_id' => $request->add_trainer,
                    'course_id' => $request->course,
                    'category_id'=> $request->add_category,
                    'day_start'=> $request->add_dateFrom,
                    'time_start'=> $request->add_timeFrom,
                    'time_end'=> $request->add_timeTo,
                    'room_id' => $request->add_studio,
                    'duration' => $request->add_duration,
                    'slot' => $request->add_slot,
                    'week' => $dday,
                ]);
                return response()->json(['code'=>1, 'msg'=>"Schedule successfully added.", 'id'=>$request->course]);
            }else{
                return response()->json(['code' => 2, 'msg'=>"There was a conflict in availability of schedule" ]);
            }
               
        }
    }

    public function checkAvailable($room, $teacher, $date, $duration)
    {
        return true;
    }
    public function getTeachSchedule(string $id)
    {
        $course = Course::findOrFail($id);
        $data = view('content.admin.class_schedule.all_schedule', compact('course'))->render();
        return response()->json(['code' => 1, 'result' => $data]);
  
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
