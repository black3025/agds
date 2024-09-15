<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class isStudent
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    if (Auth::User()->role->restriction < 3) {
      return response()->view('errors.401');
    }
    return $next($request);
  }
}
