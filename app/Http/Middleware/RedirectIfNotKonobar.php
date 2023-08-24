<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RedirectIfNotKonobar
{
    /**
     * Handle an incoming request.
     *
      * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'konobar')
	{
		if (!Auth::guard($guard)->check()) {
			return redirect('/konobar/login');
		}
	
		return $next($request);
	}
}
