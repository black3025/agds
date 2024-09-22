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
    if (Auth::user()->role->restriction > 2) {
      $courses = Course::where('is_active', 1)->get();
      return view('content.course.index', compact('courses'));
    } else {
      $courses = Course::all();
      return view('content.admin.course.index', compact('courses'));
    }
  }

  public function getCourse()
  {
    if (Auth::user()->role->restriction > 2) {
      $courses = Course::where('is_active', 1)->get();
      $data = view('content.course.all_course', compact('courses'))->render();
      return response()->json(['code' => 1, 'result' => $data]);
    } else {
      $courses = Course::all();
      $data = view('content.admin.course.all_course', compact('courses'))->render();
      return response()->json(['code' => 1, 'result' => $data]);
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

  public function updateCourse(Request $request)
  {
    if ($request->is_active == 'on') {
      $validator = \Validator::make(
        $request->all(),
        [
          'name' => 'required|string',
          'image_display' => 'image',
        ],
        [
          'name.required' => 'Course name is required.',
          'image_display' => 'Please select a valid image file.',
        ]
      );

      if (!$validator->passes()) {
        return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
      } else {
        if (empty($request->file('image_display'))) {
          $Course = Course::find($request->id);

          $Course->update([
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => 1,
          ]);
          return response()->json(['code' => 1, 'msg' => 'Course has been update']);
        } else {
          $path = 'course_image/';
          $file = $request->file('image_display');
          $file_name = time() . '_course_img_' . $request->id . '.' . $file->getClientOriginalExtension();
          $upload = $file->storeAs($path, $file_name, 'public');
          if ($upload) {
            $Course = Course::find($request->id);

            $Course->update([
              'name' => $request->name,
              'description' => $request->description,
              'image_display' => $file_name,
              'is_active' => 1,
            ]);

            return response()->json(['code' => 1, 'msg' => 'Course has been update']);
          }
        }
      }
    } else {
      $Course = Course::find($request->id);
      $Course->update(['is_active' => 0]);
      return response()->json(['code' => 1, 'msg' => 'Course has been deactivated']);
    }
  }
}
