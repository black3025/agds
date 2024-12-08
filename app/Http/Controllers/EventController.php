<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\ClassSchedule;
use App\Models\User;
use Illuminate\Support\Str;
use App\Notifications\RescheduledEventNotification;
use Illuminate\Notifications\Notifiable;

class EventController extends Controller
{
  use Notifiable;

  public function resched($id)
  {
    $event = Event::findorfail($id);
    $sched = ClassSchedule::where('id', $event->class_schedule_id)->first();
    //start looking for the next day
    $last = Event::where('class_schedule_id', $event->class_schedule_id)
      ->latest()
      ->pluck('finish_time')
      ->last();

    $i = 1;
    $tempDate = date($last);
    $data = '';
    while ($i == 1) {
      $tempDate = date('Y-m-d', strtotime($tempDate . '1 days'));
      $dayoftest = date('w', strtotime($tempDate));
      if (Str::contains($sched->week, $dayoftest)) {
        $data = $tempDate;
        $schedChecker = $this->checkAvailable(
          $sched->room_id,
          $sched->user_id,
          $sched->time_start,
          $sched->time_end,
          $data
        );
        if ($schedChecker == 0) {
          $i++;
        }
      }
    }

    $eventNew = Event::create([
      'class_schedule_id' => $sched->id,
      'start_time' => date('y-m-d H:i:s', strtotime($data . ' ' . $sched->time_start)),
      'finish_time' => date('y-m-d H:i:s', strtotime($data . ' ' . $sched->time_end)),
    ]);

    $event->update([
      'comments' => 'Rescheduled to ' . date('F d, y', strtotime($data)),
    ]);

    //send notification
    $users = User::whereHas('enrollments', function ($q) use ($event) {
      $q->where('class_schedule_id', $event->class_schedule_id)->where('verified', 'approved');
    })->first();
    if ($users) {
      \Notification::send($users, new RescheduledEventNotification($event, $eventNew));
    }
    return response()->json([
      'success' => 'true',
      'message' => 'Re-Schedule to: ' . date('F d, Y H:i:s a', strtotime($eventNew->start_time)),
    ]);
  }

  public function checkAvailable($room, $teacher, $timestart, $timeend, $date)
  {
    $roomError = 0;
    $teacherError = 0;

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
    // $roomCount = 0;
    // $teacherCount = 0;
    $teacherError += $teacherCount;
    $roomError += $roomCount;

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
}
