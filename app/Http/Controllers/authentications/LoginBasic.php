<?php

namespace App\Http\Controllers\authentications;

use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-login-basic');
  }

  public function admin()
  {
    return view('content.authentications.admin-login-basic');
  }

  public function signin(Request $request)
  {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
      if (Auth::user()->is_active != 1) {
        return redirect('auth/login')->with('error', 'Active issue.');
      }

      if (Auth::user()->role->restriction == 3) {
        return redirect()->intended('/Dashboard');
      } elseif (Auth::user()->role->restriction == 2) {
        return redirect()->intended('/teacher/Dashboard');
      } else {
        return redirect()->intended('/admin/Dashboard');
      }
    }

    //rename routes from sign in to log in
    return redirect('auth/login')->with('error', 'Invalid credentials. Please try again.');
  }

  public function emailVerify()
  {
    if (Auth::user()->email_verified_at == '') {
      return view('content.authentications.verify-email');
    } else {
      return redirect('/Dashboard');
    }
  }

  public function resendVerify(Request $request)
  {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
  }

  public function logout()
  {
    Session::flush();
    Auth::logout();
    return redirect('/');
  }
}
