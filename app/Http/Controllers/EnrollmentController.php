<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\LoyaltyPoints;
use App\Models\ClassSchedule;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewEnrollmentNotification;
use Illuminate\Notifications\Notifiable;
class EnrollmentController extends Controller
{
  use Notifiable;

  public function index()
  {
    $enrollments = Enrollment::all();
    return view('content.enrollment.index', compact('enrollments'));
  }

  public function markAsRead()
  {
    Auth::user()->unreadNotifications->markAsRead();
    return redirect()->back();
  }

  public function checkConflict(request $request)
  {
    $id = Auth::user()->id;
    $conflict = 0;
    //check for same course
    $exists = Enrollment::where('user_id', $id)
      ->where('class_schedule_id', $request->class_schedule_id)
      ->count();

    //check for same date/timeslot
    $enrollments = Enrollment::where('user_id', $id)
      ->where('status', 'new')
      ->get();
    $newEvents = Event::where('class_schedule_id', $request->class_schedule_id)->get();

    foreach ($newEvents as $event) {
      $from = $event->start_time;
      $to = $event->finish_time;

      $count = Enrollment::where('user_id', $id)
        ->where('status', 'new')
        ->wherehas('ClassSchedule', function ($q) use ($id, $from, $to) {
          $q->wherehas('event', function ($q) use ($from, $to) {
            $q->where('start_time', '<', $to)->where('finish_time', '>', $from);
          });
        })
        ->count();
      $conflict = $count;
    }
    //check for slots
    $csid = $request->class_schedule_id;
    $slot = ClassSchedule::where('id', $csid)->value('slot');
    $enrollees = Enrollment::wherehas('ClassSchedule', function ($q) use ($csid) {
      $q->where('id', $csid);
    })->count();

    if ($exists > 0) {
      return ['success' => false, 'message' => 'You are already enrolled in this course.'];
    } elseif ($conflict > 0) {
      return [
        'success' => false,
        'message' => 'You are currently enrolled in a course that has a conflict with this new course.',
      ];
    } elseif ($slot - $enrollees < 1) {
      return ['success' => false, 'message' => 'There is no available slot for this course.'];
    } else {
      return ['success' => true, 'message' => 'Clear'];
    }
  }

  public function redeem(request $request)
  {
    $points = Auth::user()->loyalty->sum('amount');
    if ($points < 500) {
      return ['success' => false, 'message' => 'Insuficient Points.'];
    } else {
      $enroll = Enrollment::create($request->all());

      if ($enroll) {
        LoyaltyPoints::create([
          'user_id' => Auth::user()->id,
          'amount' => -500,
          'details' => 'redeem',
        ]);
        $admins = User::whereHas('role', function ($q) {
          $q->where('id', 1);
        })->get();
        \Notification::send($admins, new NewEnrollmentNotification($enroll));
        return response()->json(['code' => 1, 'msg' => 'Enrollment posted.']);
      } else {
        return response()->json(['code' => 0, 'msg' => 'Something went wrong please contact the administrator.']);
      }
    }
  }

  public function enrollUp(request $request)
  {
    $enroll = Enrollment::find($request->id);
    $enroll->update([
      'referenceNo' => $request->referenceNo,
      'verified' => 'Pending',
    ]);
    if ($enroll) {
      $admins = User::whereHas('role', function ($q) {
        $q->where('id', 1);
      })->get();
      \Notification::send($admins, new NewEnrollmentNotification($enroll));

      return response()->json(['code' => 1, 'msg' => 'Enrollment posted.']);
    } else {
      return response()->json(['code' => 0, 'msg' => 'Something went wrong please contact the administrator.']);
    }
  }
  public function store(request $request)
  {
    $enroll = Enrollment::create($request->all());

    if ($enroll) {
      $admins = User::whereHas('role', function ($q) {
        $q->where('id', 1);
      })->get();
      \Notification::send($admins, new NewEnrollmentNotification($enroll));

      return response()->json(['code' => 1, 'msg' => 'Enrollment posted.']);
    } else {
      return response()->json(['code' => 0, 'msg' => 'Something went wrong please contact the administrator.']);
      // return ['success' => false, 'message' => 'Something went wrong please contact the administrator.'];
    }
  }

  public function enrolledsched(string $id)
  {
    $enrollment = Enrollment::findorfail($id);
    return view('content.enrollment.enroll', compact('enrollment'));
  }

  public function enrolled()
  {
    $enrollments = Enrollment::whereHas('ClassSchedule', function ($q) {
      $q->where('is_active', 1);
    })
      ->where('verified', '<>', 'Reservation')
      ->where('user_id', Auth::user()->id)
      ->get();
    return view('content.enrollment.index', compact('enrollments'));
  }

  public function reservation()
  {
    return view('content.enrollment.reservation');
  }

  public function getReservation()
  {
    $enrollments = Enrollment::where('verified', 'Reservation')
      ->where('user_id', Auth::user()->id)
      ->get();
    $data = view('content.enrollment.reserve', compact('enrollments'))->render();
    return response()->json(['code' => 1, 'result' => $data]);
  }

  public function deleteEnrollment($id)
  {
    $enroll = Enrollment::find($id);
    $enroll->delete();
    if ($enroll) {
      return response()->json([
        'success' => true,
        'result' => $enroll,
      ]);
    } else {
      return response()->json(['success' => false, 'result' => $enroll]);
    }
  }

  public function completed()
  {
    $enrollments = Enrollment::whereHas('ClassSchedule', function ($q) {
      $q->where('is_active', 0);
    })
      ->where('user_id', Auth::user()->id)
      ->where('verified', 'Approved')
      ->get();
    return view('content.enrollment.completed', compact('enrollments'));
  }
}
