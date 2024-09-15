<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Auth;
class CourseController extends Controller
{
  public function index()
  {
    $courses = Course::where('is_active', 1)->get();
    if (Auth::user()->role->restriction > 2) {
      return view('content.course.index', compact('courses'));
    } else {
      return view('content.admin.course.index', compact('courses'));
    }
  }

  public function show(string $id)
  {
    $course = Course::findOrFail($id);

    if (Auth::user()->role->restriction > 2) {
      return view('content.course.course', compact('course'));
    } else {
      return view('content.admin.course.course', compact('course'));
    }
  }

  public function create(request $request)
  {
    dd($request);
  }
}
