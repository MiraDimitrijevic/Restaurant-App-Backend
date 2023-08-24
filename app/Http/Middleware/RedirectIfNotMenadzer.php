<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RedirectIfNotMenadzer
{
    /**
     * Handle an incoming request.
     *
   * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'menadzer')
	{
		if (!Auth::guard($guard)->check()) {
			return redirect('/menadzer/login');
		}
	
		return $next($request);
	}
   
}
