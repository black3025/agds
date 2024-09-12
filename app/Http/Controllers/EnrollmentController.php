<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
  public function index()
  {
    $enrollments = Enrollment::all();
    return view('content.enrollment.index', compact('enrollments'));
  }

  public function store(request $request)
  {
    $enroll = Enrollment::create($request->all());
    if ($enroll) {
      return ['success' => true, 'message' => 'Enrollment Posted.'];
    } else {
      return ['success' => false, 'message' => 'Something went wrong please contact the administrator.'];
    }
  }

  public function enrolled()
  {
    $enrollments = Enrollment::where('user_id', Auth::user()->id)->get();
    return view('content.enrollment.index', compact('enrollments'));
  }
}
