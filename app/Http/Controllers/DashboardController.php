<?php

namespace App\Http\Controllers;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassSchedule;
class DashboardController extends Controller
{
  public function index()
  {
    // if($request->ajax()) {

    //   $data = Event::whereDate('start', '>=', $request->start)
    //             ->whereDate('end',   '<=', $request->end)
    //             ->get(['id', 'title', 'start', 'end']);

    //   return response()->json($data);
    // }
    if (Auth::user()->role->restriction > 2) {
      return view('content.dashboard.dashboards-student');
    } elseif (Auth::user()->role->restriction > 1) {
      return redirect('teacher/Dashboard');
    } else {
      return redirect('admin/dashboard');
    }
  }
  public function teacherIndex()
  {
    return view('content.teacher.dashboards-teacher');
  }

  public function adminIndex()
  {
    return view('content.admin.dashboards-admin');
  }
}
