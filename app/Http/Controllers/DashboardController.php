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
use App\Models\Post;

class DashboardController extends Controller
{
  public function index()
  {
    $id = Auth::user()->id;
    $events = [];
    $scheds = Enrollment::wherehas('ClassSchedule', function ($q) {
      $q->where('is_active', 1);
    })
      ->where('user_id', $id)
      ->where('verified', '<>', 'Pending')
      ->get();

    $ClassSched = ClassSchedule::wherehas('enrollment', function ($q) use ($id) {
      $q->where('user_id', $id);
    })->get();
    $posts = Post::where('is_active', 1)
      ->get()
      ->take(2);
    foreach ($scheds as $sched) {
      $id2 = $sched->class_schedule_id;
      $appointments = Event::wherehas('ClassSchedule', function ($q) use ($id2) {
        $q->where('id', $id2);
      })
        ->where('comments', null)
        ->get();
      foreach ($appointments as $appointment) {
        array_push($events, [
          'title' => $appointment->ClassSchedule->Course->name . ' | ' . $appointment->ClassSchedule->Category->name,
          'teacher' => $appointment->ClassSchedule->user->fname . ' ' . $appointment->ClassSchedule->user->lname,
          'id' => $appointment->ClassSchedule->id,
          'start' => date('Y-m-d H:i:s', strtotime($appointment->start_time)),
          'end' => date('Y-m-d H:i:s', strtotime($appointment->finish_time)),
        ]);
      }
    }

    if (Auth::user()->role->restriction > 2) {
      return view('content.dashboard.dashboards-student', compact('events', 'ClassSched', 'posts'));
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
    $posts = Post::where('is_active', 1)
      ->get()
      ->take(2);
    $events = [];
    $id = Auth::user()->id;

    $appointments = Event::wherehas('ClassSchedule', function ($q) use ($id) {
      $q->where('user_id', $id)->where('is_active', 1);
    })
      ->where('comments', null)
      ->get();

    foreach ($appointments as $appointment) {
      $events[] = [
        'title' => $appointment->ClassSchedule->Course->name . ' | ' . $appointment->ClassSchedule->Category->name,
        'teacher' => $appointment->ClassSchedule->user->fname . ' ' . $appointment->ClassSchedule->user->lname,
        'id' => $appointment->ClassSchedule->id,
        'start' => date('Y-m-d H:i:s', strtotime($appointment->start_time)),
        'end' => date('Y-m-d H:i:s', strtotime($appointment->finish_time)),
        'extendedProps' => [
          'teacher' => $appointment->ClassSchedule->user->fname . ' ' . $appointment->ClassSchedule->user->lname,
          'id' => $appointment->ClassSchedule->id,
        ],
        'rendering' => '#ae52e3',
      ];
    }
    return view('content.teacher.dashboards-teacher', compact('events', 'students', 'posts'));
  }

  public function adminIndex()
  {
    $enrollements = Enrollment::where('verified', 'Pending')->get();
    $courses = Course::all();
    $students = Student::all();
    $teachers = Teacher::all();

    $events = [];
    $posts = Post::where('is_active', 1)
      ->get()
      ->take(2);
    $appointments = Event::wherehas('ClassSchedule', function ($q) {
      $q->where('is_active', 1);
    })
      ->where('comments', null)
      ->get();

    foreach ($appointments as $appointment) {
      $events[] = [
        'title' => $appointment->ClassSchedule->Course->name . ' | ' . $appointment->ClassSchedule->Category->name,
        'start' => date('Y-m-d H:i:s', strtotime($appointment->start_time)),
        'end' => date('Y-m-d H:i:s', strtotime($appointment->finish_time)),
        'extendedProps' => [
          'teacher' => $appointment->ClassSchedule->user->fname . ' ' . $appointment->ClassSchedule->user->lname,
          'id' => $appointment->ClassSchedule->id,
        ],
        'rendering' => '#ae52e3',
      ];
    }
    return view(
      'content.admin.dashboards-admin',
      compact('enrollements', 'students', 'teachers', 'courses', 'events', 'posts')
    );
  }
}
