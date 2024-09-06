<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enrollment;

class EnrollmentController extends Controller
{
  //

  public function index()
  {
    $enrollments = Enrollment::all();
    return view('content.enrollment.index', compact('enrollments'));
  }

  public function store(request $request)
  {
    $enroll = Enrollment::create($request->all());
  }
}
