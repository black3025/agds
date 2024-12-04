<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassSchedule;
use App\Models\Event;
use Illuminate\Support\Str;

class ClassScheduleController extends Controller
{
  var $err_msg = '';
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
        'add_dateFrom' => 'date|required|after_or_equal:' . $now,
        'add_studio' => 'required',
        'add_slot' => 'required',
        'add_timeFrom' => 'date_format:H:i|required',
        'add_duration' => 'required',
        'add_timeTo' => 'date_format:H:i|required|after:' . date('H:i', strtotime($request->add_timeFrom)),
        'add_price' => 'required',
        'add_weekdays' => 'required',
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
        'add_price' => 'Amount for the course is required.',
        'add_timeTo.required' => 'Please select a valid time.',
        'add_timeTo.date_format' => 'Please select a valid time.',
        'add_timeTo.after' => 'The end time must not be before the starting time.',
      ]
    );
    if (!$validator->passes()) {
      return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
    } else {
      $dday = '';
      $days = $request->add_weekdays;
      foreach ($days as $d) {
        $dday = $dday . $d . '|';
      }

      $i = 1;
      $data = [];
      $tempDate = date($request->add_dateFrom);
      while ($i <= $request->add_duration) {
        $dayoftest = date('N', strtotime($tempDate));
        // if ($dayoftest == 'Sunday') {
        //   $numday = '0';
        // }
        // if ($dayoftest == 'Monday') {
        //   $numday = '1';
        // }
        // if ($dayoftest == 'Tuesday') {
        //   $numday = '2';
        // }
        // if ($dayoftest == 'Wednesday') {
        //   $numday = '3';
        // }
        // if ($dayoftest == 'Thursday') {
        //   $numday = '4';
        // }
        // if ($dayoftest == 'Friday') {
        //   $numday = '5';
        // }
        // if ($dayoftest == 'Saturday') {
        //   $numday = '6';
        // }
        if (Str::contains($dday, $dayoftest)) {
          array_push($data, $tempDate);
          $i++;
        }
        $tempDate = date('Y-m-d', strtotime($tempDate . '1 days'));
      }
      $schedChecker = $this->checkAvailable(
        $request->add_studio,
        $request->add_trainer,
        $request->add_timeFrom,
        $request->add_timeTo,
        $request->add_duration,
        $data
      );
      if ($schedChecker == 0) {
        $sched = ClassSchedule::create([
          'user_id' => $request->add_trainer,
          'course_id' => $request->course,
          'category_id' => $request->add_category,
          'day_start' => $request->add_dateFrom,
          'time_start' => $request->add_timeFrom,
          'time_end' => $request->add_timeTo,
          'room_id' => $request->add_studio,
          'duration' => $request->add_duration,
          'slot' => $request->add_slot,
          'amount' => $request->add_price,
          'week' => $dday,
        ]);

        foreach ($data as $date) {
          $from = date('y-m-d H:i:s', strtotime($date . ' ' . $request->add_timeFrom));
          $to = date('y-m-d H:i:s', strtotime($date . ' ' . $request->add_timeTo));
          Event::create([
            'class_schedule_id' => $sched->id,
            'start_time' => $from,
            'finish_time' => $to,
          ]);
        }
        return response()->json(['code' => 1, 'msg' => 'Schedule successfully added.']);
      } else {
        if ($schedChecker > 2) {
          return response()->json([
            'code' => 2,
            'msg' => 'The current selected teacher and room are currently not available in this said date and time.',
          ]);
        } elseif ($schedChecker > 1) {
          return response()->json([
            'code' => 2,
            'msg' => 'The current selected teacher is currently not available in this said date and time.',
          ]);
        } else {
          return response()->json([
            'code' => 2,
            'msg' => 'The current selected room is currently not available in this said date and time.',
          ]);
        }
      }
    }
  }

  public function updateStatus($id)
  {
    $sched = ClassSchedule::find($id);
    if ($sched->is_active == 1) {
      $newstat = 0;
    } else {
      $newstat = 1;
    }
    $sched->update([
      'is_active' => $newstat,
    ]);

    return response()->json(['result' => $id]);
  }

  public function checkAvailable($room, $teacher, $timestart, $timeend, $duration, $dates)
  {
    $roomError = 0;
    $teacherError = 0;
    foreach ($dates as $date) {
      $from = date('y-m-d H:i:s', strtotime($date . ' ' . $timestart));
      $to = date('y-m-d H:i:s', strtotime($date . ' ' . $timeend));
      // // check if room is availble for that day

      $roomCount = Event::wherehas('ClassSchedule', function ($q) use ($room) {
        $q->where('room_id', $room);
      })
        ->where('start_time', '<', $to)
        ->where('finish_time', '>', $from)
        ->count();

      $teacherCount = Event::wherehas('ClassSchedule', function ($q) use ($teacher) {
        $q->where('user_id', $teacher);
      })
        ->where('start_time', '<', $to)
        ->where('finish_time', '>', $from)
        ->count();
      $teacherError += $teacherCount;
      $roomError += $roomCount;
    }
    $errors = 0;
    if ($teacherError > 0 && $roomError > 0) {
      $errors = 3;
    } elseif ($teacherError > 0) {
      $errors = 2;
    } elseif ($roomError > 0) {
      $errors = 1;
    }

    return $errors;
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
