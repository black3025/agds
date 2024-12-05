<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Auth;
class ReviewController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    if (Auth::user()->role->restriction > 2) {
      return view('content.front-pages.land');
    } elseif (Auth::user()->role->restriction > 1) {
      return view('content.front-pages.land');
    } else {
      $reviews = Review::all();
      return view('content.admin.review.index', compact('reviews'));
    }
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
    $review = Review::create([
      'class_schedule_id' => $request->class_schedule_id,
      'user_id' => Auth::user()->id,
      'comments' => $request->comment,
      'star_rating' => $request->rating,
      'is_private' => 1,
    ]);
    return response()->json(['code' => 1, 'msg' => 'Review added successfully.']);
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
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
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }

  public function fetchReview(string $id)
  {
    $review = Review::where('class_schedule_id', $id)
      ->where('user_id', Auth::user()->id)
      ->first();
    return response()->json(['result' => $review]);
  }
}
