<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\ClassSchedule;
use App\Models\Enrollment;
use Auth;

class StudentController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $id = Auth::user()->id;
    if (Auth::user()->role->restriction > 1) {
      $students = Enrollment::wherehas('ClassSchedule', function ($q) use ($id) {
        $q->where('user_id', $id);
      })->get();
      return view('content.teacher.student.index', compact('students'));
    } else {
      $students = Student::where('is_active', 1)->get();
      return view('content.admin.student.index', compact('students'));
    }
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
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    $student = Student::findOrFail($id);

    return view('content.admin.student.student', compact('student'));
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
