<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
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
      return response()->json(['code' => 1, 'msg' => 'Course added successfully.']);
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
