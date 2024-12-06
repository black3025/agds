<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
  public function AdminIndex()
  {
    return view('content.admin.post.index');
  }
  public function getPosts()
  {
    $posts = Post::all();
    $data = view('content.admin.post.all_post', compact('posts'))->render();
    return response()->json(['code' => 1, 'result' => $data]);
  }
}
