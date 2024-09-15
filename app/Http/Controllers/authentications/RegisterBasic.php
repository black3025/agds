<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Student;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;

class RegisterBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-register-basic');
  }

  public function store(Request $request)
  {
    $request->validate([
      'username' => ['required', 'string', 'min:6', 'max:20', 'unique:users'],
      'fname' => ['required', 'string', 'min:2', 'max:20'],
      'lname' => ['required', 'string', 'min:2', 'max:20'],
      'bday' => ['required', 'string'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'confirmed'],
    ]);

    $user = User::create([
      'username' => $request->username,
      'fname' => $request->fname,
      'mname' => $request->mname,
      'lname' => $request->lname,
      'birthday' => $request->bday,
      'role_id' => 3,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

    $student_id = Student::max('studentID');
    $year = date('Y');
    if ($student_id == '') {
      $student_id = $year . '-0001';
    } else {
      $temp = explode('-', $client_id);
      $year_n = $temp[0];
      $number = (int) $temp[1] + 1;
      if ($year == $year_n) {
        $student_id = $year_n . '-' . str_pad($number, 4, '0', STR_PAD_LEFT);
      } else {
        $student_id = $year . '-0001';
      }
    }

    try {
      event(new Registered($user));
    } catch (\Exception $e) {
    }

    Auth::login($user);

    $student = Student::create([
      'studentID' => $student_id,
      'user_id' => Auth::user()->id,
    ]);

    return redirect(route('dashboard'));
  }
}
