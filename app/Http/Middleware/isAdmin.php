<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class isAdmin
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
    if (Auth::User()->role->restriction > 2) {
      return redirect('/Dashboard');
    }
    return $next($request);
  }
}
