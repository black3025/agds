<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\LoyaltyPoints;
use App\Models\ClassSchedule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;

class EnrollmentAdminController extends Controller
{
  use Notifiable;

  public function approveEnrollment($id)
  {
    $enrollment = Enrollment::find($id);
    $user = User::where('id', $enrollment->user_id);
    $enrollment->update([
      'verified' => 'Approved',
    ]);

    $loyalty = LoyaltyPoints::create([
      'user_id' => $user->user_id,
      'amount' => 50,
      'details' => $user->ClassSchedule->course->name,
    ]);
    Notification::sendNow($user, new EnrollApproved($enrollment));
    return response()->json(['result' => $id]);
  }
  public function getEnrollments()
  {
    $enrollments = Enrollment::where('verified', 'Pending')->get();
    $data = view('content.admin.enrollment.forenrollment', compact('enrollments'))->render();
    return response()->json(['code' => 1, 'result' => $data]);
  }
  /**
   * Display a listing of the resource.
   */
  public function coursesched(string $id)
  {
    $ClassSchedule = ClassSchedule::findorfail($id);
    return view('content.teacher.course.course', compact('ClassSchedule'));
  }

  public function index()
  {
    return view('content.admin.enrollment.index');
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
    //
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
