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
        $validator = \Validator::make(
            $request->all(),
            [
              'add_category' => 'required',
              'add_trainer' => 'required',
              'add_dateFrom' => 'date|required|after_or_equal:'. $now,
              'add_dateTo' => 'date|required|after_or_equal:' . date('Y-m-d',strtotime($request->add_dateFrom)),
              'add_timeFrom' => 'date_format:H:i|required',
              'add_timeTo' => 'date_format:H:i|required|after:'.date('H:i', strtotime($request->add_timeFrom)),
            ],
            [
                'add_category.required' => 'Please select a category.',
                'add_trainer.required' => 'Please select a Trainer.',

                'add_dateFrom.required' => 'Please select a valid date.',
                'add_dateFrom.date' => 'Please select a valid date.',
                'add_dateFrom.after_or_equal' => 'The start date must be a date after or equal today.',

                'add_dateTo.required' => 'Please select a valid date.',
                'add_dateTo.date' => 'Please select a valid date.',
                'add_dateTo.after_or_equal' => 'The end date must be a date after or equal to starting day.',

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
            $exists = ClassSchedule::where('user_id', $request->add_trainer)->where('category_id', $request->add_category)->where('course_id',$request->course)->
                where('day_start', $request->add_dateFrom)->where('day_end',$request->add_dateTo)->
                where('time_start', $request->add_timeFrom)->where('time_end', $request->add_timeTo)->where('is_active',1)->count();

            $overlap = ClassSchedule::where('user_id',$request->add_trainer)->
                                        where(function ($query) use ($request){
                                            $query->where(function ($query) use ($request) {
                                                $query->where('day_start','<=',$request->add_dateFrom)
                                                    ->where('day_end','>=', $request->add_dateFrom);
                                            })
                                            ->orWhere(function ($query) use ($request) {
                                                $query->where('day_start','>',$request->add_dateFrom)
                                                    ->where('day_start','<=', $request->add_dateTo);
                                            });
                                        })->
                                        where(function ($query) use ($request) {
                                            $query->where(function ($query) use ($request) {
                                                $query->where('time_start','<=',$request->add_timeFrom)
                                                    ->where('time_end','>', $request->add_timeFrom);
                                            })
                                            ->orWhere(function ($query) use ($request){
                                                $query->where('time_start','>',$request->add_timeFrom)
                                                    ->where('time_start','<', $request->add_timeTo);
                                            });
                                        })->count();

            if($exists > 0 || $overlap > 0){
                if($exists > 0)
                    return response()->json(['code' => 2, 'msg' =>'This set schedule already exist for the said trainer.']);
                elseif($overlap > 0)
                    return response()->json(['code' => 2, 'msg' =>'This schedule will overlap to the trainers existing scheduled class.']);
            }else{
                $sched = ClassSchedule::create([
                    'user_id' => $request->add_trainer,
                    'course_id' => $request->course,
                    'category_id'=> $request->add_category,
                    'day_start'=> $request->add_dateFrom,
                    'day_end'=> $request->add_dateTo,
                    'time_start'=> $request->add_timeFrom,
                    'time_end'=> $request->add_timeTo,
                ]);
                return response()->json(['code'=>1, 'msg'=>"Schedule successfully added.", 'id'=>$request->course]);
            }
        }
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
