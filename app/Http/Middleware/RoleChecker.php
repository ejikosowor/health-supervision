<?php

namespace App\Http\Middleware;

use Closure;

class RoleChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (!$request->user()->hasRole($role))
		{
			return redirect('/');
		}

		return $next($request);
    }
}
