<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassSchedule;
class DashboardController extends Controller
{
  public function index()
  {
    return view('content.dashboard.dashboards-student');
  }
}
