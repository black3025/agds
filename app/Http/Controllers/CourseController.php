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
}
