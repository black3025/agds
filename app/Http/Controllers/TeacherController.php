<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $teachers = Teacher::where('is_active', 1)->get();
    $courses = Course::where('is_active', 1)->get();
    return view('content.admin.teacher.index', compact('teachers', 'courses'));
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
    $validator = \Validator::make(
      $request->all(),
      [
        'fname' => 'required|string',
        'lname' => 'required|string',
        'bday' => 'required',
        'email' => 'required|email|unique:users',
        'mastery' => 'required',
      ],
      [
        'fname.required' => 'Given name is required.',
        'lname.required' => 'Last name is already taken.',
        'bday.required' => 'Birthday is required.',
        'email.required' => 'Email is required.',
        'email.unique' => 'This Email is already taken.',
        'mastery.required' => 'Please select at least one course mastery.',
      ]
    );
    if (!$validator->passes()) {
      return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
    } else {
      if (empty($request->mname)) {
        $username = strtolower($request->fname[0] . $request->lname);
      } else {
        $username = strtolower($request->fname[0] . $request->mname[0] . $request->lname);
      }

      $password = $username . '@1234';

      $user = User::create([
        'username' => $username,
        'fname' => $request->fname,
        'mname' => $request->mname,
        'lname' => $request->lname,
        'birthday' => $request->bday,
        'role_id' => 2,
        'email' => $request->email,
        'password' => Hash::make($password),
        'email_verified_at' => now(),
      ]);

      $teacher_id = Teacher::max('teacherID');
      $year = date('Y');
      if ($teacher_id == '') {
        $teacher_id = $year . '-0001';
      } else {
        $temp = explode('-', $teacher_id);
        $year_n = $temp[0];
        $number = (int) $temp[1] + 1;
        if ($year == $year_n) {
          $teacher_id = $year_n . '-' . str_pad($number, 4, '0', STR_PAD_LEFT);
        } else {
          $teacher_id = $year . '-0001';
        }
      }
      $master = '|';
      $masteries = $request->mastery;
      foreach ($masteries as $mastery) {
        $master = $master . $mastery . '|';
      }

      $teacher = Teacher::create([
        'teacherID' => $teacher_id,
        'user_id' => $user->id,
        'mastery' => $master,
      ]);
      return response()->json(['code' => 1, 'msg' => 'Teacher added successfully.']);
    }
  }

  public function getTeacher()
  {
    $teachers = Teacher::all();
    $data = view('content.admin.teacher.all_teacher', compact('teachers'))->render();
    return response()->json(['code' => 1, 'result' => $data]);
  }

  public function updateTeacher(request $request)
  {
    $validator = \Validator::make(
      $request->all(),
      [
        'edit_fname' => 'required|string',
        'edit_lname' => 'required|string',
        'edit_bday' => 'required',
        'edit_email' => 'required|email|unique:users,email,'. $request->edit_uid,
        'edit_mastery' => 'required',
      ],
      [
        'edit_fname.required' => 'Given name is required.',
        'edit_lname.required' => 'Last name is already taken.',
        'edit_bday.required' => 'Birthday is required.',
        'edit_email.required' => 'Email is required.',
        'edit_email.unique' => 'This Email is already taken. '. $request->edit_uid,
        'edit_mastery.required' => 'Please select at least one course mastery.',
      ]
    );
    
    if (!$validator->passes()) {
       return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
    } else {
      $user = User::find($request->edit_uid);
      $user->update([
        'fname' => $request->edit_fname,
        'mname' => $request->edit_mname,
        'lname' =>$request->edit_lname,
        'bday' =>$request->edit_bday,
        'email' =>$request->edit_email,
      ]);
      
      $teacher = Teacher::find($request->edit_tid);

      $master = '|';
      $masteries = $request->edit_mastery;
      foreach ($masteries as $mastery) {
        $master = $master . $mastery . '|';
      }

      $teacher->update(['mastery'=>$master]);

      return response()->json(['code' => 1, 'msg' => 'Teacher updated.']);
    }
    
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
