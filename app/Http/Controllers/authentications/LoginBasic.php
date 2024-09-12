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
      return redirect()->intended('/Dashboard');
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

  public function logout()
  {
    Session::flush();
    Auth::logout();
    return redirect('/');
  }
}
