<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;

class ContactUsController extends Controller
{

  public function index()
  {

  }

  public function store(request $request)
  {
        // return ['success'=>true,'message'=>$request];
        $contact = ContactUs::create($request->all());
        if($contact)
            return ['success'=>true,'message'=> 'Inquiry Submitted.'];
        else
            return ['success'=>false, 'message'=> 'Something went wrong please contact the administrator.'];
  }

}
