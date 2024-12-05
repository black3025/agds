<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class FrontController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $reviews = Review::latest()
      ->take(5)
      ->get();
    return view('content.front-pages.land', compact('reviews'));
  }

  public function review()
  {
    $reviews = Review::latest()
      ->take(5)
      ->get();
    return view('content.review.index', compact('reviews'));
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
}
