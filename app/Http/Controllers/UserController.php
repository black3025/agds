<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Notifications\Notifiable;
class UserController extends Controller
{
  use Notifiable;
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $users = User::all();
    return view('content.admin.users.index', compact('users'));
  }

  public function updateStatus($id)
  {
    $user = User::find($id);
    if ($user->is_active == 1) {
      $newstat = 0;
    } else {
      $newstat = 1;
    }
    $user->update([
      'is_active' => $newstat,
    ]);
    return response()->json(['result' => $id]);
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
    $user = User::findorfail($id);
    return view('content.user.user', compact('user'));
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
  public function update(Request $request)
  {
    return 'bolaga';
  }

  public function updateUser(Request $request)
  {
    $user = User::find(Auth::user()->id);
    $validator = \Validator::make(
      $request->all(),
      [
        'firstName' => 'required|string',
        'lastName' => 'required|string',
        'bday' => 'required',
        'email' => "required|email|unique:users,email,{$user->id}",
      ],
      [
        'firstName.required' => 'First name is required.',
        'lastName.required' => 'Last name is required.',
        'bday.required' => 'Birthday is required.',
        'email.required' => 'Email address is required.',
        'email.unique' => 'This email is already been used.',
      ]
    );
    if (!$validator->passes()) {
      return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
    } else {
      $user->update([
        'fname' => $request->firstName,
        'mname' => $request->middleName,
        'lname' => $request->lastName,
        'birthday' => $request->bday,
        'email' => $request->email,
      ]);
      return response()->json(['code' => 1, 'msg' => 'User has been update']);
    }
    //return response()->json(['code' => 1, 'msg' => 'Course has been update']);
  }

  public function updatePic(Request $request)
  {
    $user = User::find(Auth::user()->id);
    $path = 'profile-photos/';
    $file = $request->file('upload');
    $file_name = time() . '_' . $user->id . '.' . $file->getClientOriginalExtension();
    $upload = $file->storeAs($path, $file_name, 'public');
    $user->update([
      'profile_pic' => $file_name,
    ]);
    return response()->json(['code' => 1, 'msg' => 'Profile Picture has been update']);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
