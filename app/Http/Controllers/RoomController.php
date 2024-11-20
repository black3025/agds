<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use Auth;

class RoomController extends Controller
{
  public function index()
  {
    $rooms = Room::where('status', 1)->get();
    return view('content.admin.room.index', compact('rooms'));
  }

  public function store(request $request)
  {
    $validator = \Validator::make(
      $request->all(),
      [
        'add_name' => 'required|string|unique:rooms,name',
        'add_capacity' => 'required|integer|min:1',
      ],
      [
        'add_name.required' => 'Room name is required.',
        'add_name.string' => 'Room name must be a string.',
        'add_name.unique' => 'Room name already exists.',
        'add_capacity.required' => 'Capacity must not be empty.',
        'add_capacity.min' => 'Capacity must be more than 0.',
        'add_capacity.interger' => 'Capacity must be more than 0.',
      ]
    );

    if (!$validator->passes()) {
      return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
    } else {
      $room = Room::create([
        'name' => $request->add_name,
        'capacity' => $request->add_capacity,
      ]);
      return response()->json(['code' => 1, 'msg' => 'Room added successfully.']);
    }
  }

  public function getRoom()
  {
    $rooms = Room::all();
    $data = view('content.admin.room.all_room', compact('rooms'))->render();
    return response()->json(['code' => 1, 'result' => $data]);
  }

  public function updateStatus($id)
  {
    $room = Room::find($id);
    $newstat = !$room->status;
    $room->update([
      'status' => $newstat,
    ]);
    return response()->json(['result' => $id]);
  }

  public function updateRoom(request $request)
  {
    $validator = \Validator::make(
      $request->all(),
      [
        'add_name' => 'required|string|unique:rooms,name,{$request->id}',
        'add_capacity' => 'required|integer|min:1',
      ],
      [
        'add_name.required' => 'Room name is required.',
        'add_name.string' => 'Room name must be a string.',
        'add_name.unique' => 'Room name already exists.',
        'add_capacity.required' => 'Capacity must not be empty.',
        'add_capacity.min' => 'Capacity must be more than 0.',
        'add_capacity.interger' => 'Capacity must be more than 0.',
      ]
    );

    if (!$validator->passes()) {
      return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
    } else {
      $room = Room::find($request->id);
      $room->update([
        'name' => $request->add_name,
        'capacity' => $request->add_capacity,
      ]);
      return response()->json(['code' => 1, 'msg' => 'Room added successfully.']);
    }
  }
}
