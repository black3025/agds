<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $teachers = Teacher::where('is_active', 1)->get();
    return view('content.admin.teacher.index', compact('teachers'));
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
        'email'=>'required|email|unique:users',

      ],
      [
        'fname.required' => 'Given name is required.',
        'lname.required' => 'Last name is already taken.',
        'bday.required' => 'Birthday is required.',
        'email.required' => 'Email is required.',
        'email.unique' => 'This Email is already taken.'
      ]
    );
    if (!$validator->passes()) {
      return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
    } else {
      if(empty($request->mname))
        $username = strtolower($request->fname[0] . $request->lname);
      else
        $username = strtolower($request->fname[0] . $request->mname[0] . $request->lname);

      $password = $username . "@1234";
      
      $user = User::create([
        'username' => $username,
        'fname' => $request->fname,
        'mname' => $request->mname,
        'lname' => $request->lname,
        'birthday' => $request->bday,
        'role_id' => 2,
        'email' => $request->email,
        'password' => Hash::make($password),        
        'email_verified_at'=> now(),
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

      $teacher = Teacher::create([
        'teacherID' => $teacher_id,
        'user_id' => $user->id,
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
