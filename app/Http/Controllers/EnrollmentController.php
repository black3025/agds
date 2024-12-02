<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\LoyaltyPoints;
use App\Models\ClassSchedule;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
  public function index()
  {
    $enrollments = Enrollment::all();
    return view('content.enrollment.index', compact('enrollments'));
  }

  public function checkConflict(request $request)
  {
    $exists = Enrollment::where('user_id', Auth::user()->id)
      ->where('class_schedule_id', $request->class_schedule_id)
      ->count();
    $shed = '';
    if ($exists > 0) {
      return ['success' => false, 'message' => 'You are already enrolled in this course.'];
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
        $loyalty = LoyaltyPoints::create([
          'user_id' => Auth::user()->id,
          'amount' => -500,
          'details' => 'Redeem Course',
        ]);
        return ['success' => true, 'message' => 'Enrollment Redeemed.'];
      } else {
        return ['success' => false, 'message' => 'Something went wrong please contact the administrator.'];
      }
    }
  }

  public function store(request $request)
  {
    $enroll = Enrollment::create($request->all());
    if ($enroll) {
      return response()->json(['code' => 1, 'msg' => 'Enrollment posted.']);
      // return ['success' => true, 'message' => 'Enrollment Posted.'];
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
    $enrollments = Enrollment::where('user_id', Auth::user()->id)->get();
    return view('content.enrollment.index', compact('enrollments'));
  }
}
