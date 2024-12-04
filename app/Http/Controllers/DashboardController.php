<?php

namespace App\Http\Controllers;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassSchedule;
use App\Models\Enrollment;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Event;

class DashboardController extends Controller
{
  public function index()
  {
    $id = Auth::user()->id;
    $events = [];
    $scheds = Enrollment::where('user_id', $id)->get();
    foreach($scheds as $sched){
      $id2 = $sched->id;
      $appointments = Event::wherehas('ClassSchedule', function ($q) use ($id2) {
        $q->where('user_id', $id2);
      })->get();
  
      foreach ($appointments as $appointment) {
        $events[] = [
          'title' => $appointment->ClassSchedule->Course->name . ' | ' . $appointment->ClassSchedule->Category->name,
          'teacher' => $appointment->ClassSchedule->user->fname . ' ' . $appointment->ClassSchedule->user->lname,
          'id' => $appointment->ClassSchedule->id,
          'start' => date('Y-m-d H:i:s', strtotime($appointment->start_time)),
          'end' => date('Y-m-d H:i:s', strtotime($appointment->finish_time)),
        ];
      }
    }
    
    if (Auth::user()->role->restriction > 2) {

      return view('content.dashboard.dashboards-student',compact('events'));
    } elseif (Auth::user()->role->restriction > 1) {
      return redirect('teacher/Dashboard');
    } else {
      return redirect('admin/Dashboard');
    }
  }
  public function teacherIndex()
  {
    $id = Auth::user()->id;
    $enrollements = Enrollment::all();
    $courses = Course::all();
    $students = Enrollment::wherehas('ClassSchedule', function ($q) use ($id) {
      $q->where('user_id', $id);
    })->get();
    $teachers = Teacher::all();

    $events = [];
    $id = Auth::user()->id;

    $appointments = Event::wherehas('ClassSchedule', function ($q) use ($id) {
      $q->where('user_id', $id);
    })->get();

    foreach ($appointments as $appointment) {
      $events[] = [
        'title' => $appointment->ClassSchedule->Course->name . ' | ' . $appointment->ClassSchedule->Category->name,
        'teacher' => $appointment->ClassSchedule->user->fname . ' ' . $appointment->ClassSchedule->user->lname,
        'id' => $appointment->ClassSchedule->id,
        'start' => date('Y-m-d H:i:s', strtotime($appointment->start_time)),
        'end' => date('Y-m-d H:i:s', strtotime($appointment->finish_time)),
      ];
    }
    return view('content.teacher.dashboards-teacher', compact('events', 'students'));
  }

  public function adminIndex()
  {
    $enrollements = Enrollment::all();
    $courses = Course::all();
    $students = Student::all();
    $teachers = Teacher::all();

    $events = [];

    $appointments = Event::all();
    foreach ($appointments as $appointment) {
      $events[] = [
        'title' => $appointment->ClassSchedule->Course->name . ' | ' . $appointment->ClassSchedule->Category->name,
        'teacher' => $appointment->ClassSchedule->user->fname . ' ' . $appointment->ClassSchedule->user->lname,
        'id' => $appointment->ClassSchedule->id,
        'start' => date('Y-m-d H:i:s', strtotime($appointment->start_time)),
        'end' => date('Y-m-d H:i:s', strtotime($appointment->finish_time)),
      ];
    }
    return view('content.admin.dashboards-admin', compact('enrollements', 'students', 'teachers', 'courses', 'events'));
  }
}
