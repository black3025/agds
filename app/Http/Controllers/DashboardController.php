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

    }else{
      return redirect('admin/Dashboard');
    }
  }

  public function adminIndex()
  {
    return view('content.admin.dashboards-admin');
  }
}
