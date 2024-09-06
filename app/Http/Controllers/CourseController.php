<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
class CourseController extends Controller
{
  public function index()
  {
    $courses = Course::where('is_active', 1)->get();
    return view('content.course.index', compact('courses'));
  }

  public function show(string $id)
  {
    $course = Course::findOrFail($id);
    return view('content.course.course', compact('course'));
  }

  public function create(request $request)
  {
    dd($request);
  }
}
