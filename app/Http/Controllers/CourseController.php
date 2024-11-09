<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Category;
use App\Models\ClassSchedule;
use Auth;
class CourseController extends Controller
{
  public function index()
  {
    if (Auth::user()->role->restriction > 2) {
      $courses = Course::where('is_active', 1)->get();
      return view('content.course.index', compact('courses'));
    } elseif (Auth::user()->role->restriction > 1) {
      return view('content.teacher.course.index');
    } else {
      $courses = Course::paginate(5);
      return view('content.admin.course.index', compact('courses'));
    }
  }

  public function getCourse()
  {
    if (Auth::user()->role->restriction > 2) {
      $courses = Course::where('is_active', 1)->get();
      $data = view('content.course.all_course', compact('courses'))->render();
      return response()->json(['code' => 1, 'result' => $data]);
    } elseif (Auth::user()->role->restriction > 1) {
      $classess = ClassSchedule::where('user_id', Auth::user()->id)->get();
      $data = view('content.teacher.course.all_course', compact('classess'))->render();
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
      $teachers = Teacher::whereHas('user', function ($query) {
        $query->where('is_active', 1);
      })->get();
      $categories = Category::all();
      return view('content.admin.course.course', compact('course', 'teachers', 'categories'));
    }
  }

  public function create(request $request)
  {
    dd($request);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $data = [
      'name' => $request->add_name,
      'image_display' => $request->add_image_display,
    ];

    $validator = \Validator::make(
      $request->all(),
      [
        'add_name' => 'required|unique:courses,name|string',
        'add_image_display' => 'image',
      ],
      [
        'add_name.required' => 'Course name is required.',
        'add_name.unique' => 'Course name is already taken',
        'add_aname.string' => 'Course name is already taken',
        'add_image_display' => 'Please select a valid image file.',
      ]
    );
    if (!$validator->passes()) {
      return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
    } else {
      if (empty($request->file('add_image_display'))) {
        $add = [
          'name' => $request->add_name,
          'description' => $request->add_description,
        ];
        $new = Course::create($add);
        return response()->json(['code' => 1, 'msg' => 'Course added successfully.']);
      } else {
        $path = 'course_image/';
        $file = $request->file('add_image_display');
        $course_id = Course::max('ID') + 1;
        $file_name = time() . '_course_img_' . $course_id . '.' . $file->getClientOriginalExtension();
        $upload = $file->storeAs($path, $file_name, 'public');
        $add = [
          'name' => $request->add_name,
          'description' => $request->add_description,
          'image_display' => $file_name,
        ];

        if ($upload) {
          $new = Course::create($add);
          return response()->json(['code' => 1, 'msg' => 'Course added successfully']);
        }
      }
    }
  }

  public function updateCourse(Request $request)
  {
    if ($request->is_active == 'on') {
      $validator = \Validator::make(
        $request->all(),
        [
          'name' => "required|string|unique:courses,name,{$request->id}",
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
