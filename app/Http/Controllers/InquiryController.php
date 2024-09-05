<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inquiry;

class InquiryController extends Controller
{
  public function index()
  {

    return view('content.inquiry.index');
  }

  public function show($id)
  {
    $inq = Inquiry::findOrFail($id);
    return view('content.inquiry.index',compact('inq'));
  }
}
