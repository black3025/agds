<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
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
      'fname' => ['required', 'string', 'min:6', 'max:20'],
      'lname' => ['required', 'string', 'min:6', 'max:20'],
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
      'role_id' => 2,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect(route('dashboard'));
  }
}
