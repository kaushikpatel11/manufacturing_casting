<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticate
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
        if (!Auth::check()) 
        {
            if ($request->ajax()) 
            {
                return response('Unauthorized.', 401);
            } 
            else 
            {
                return redirect()->route('admin_login');
            }
        }

        return $next($request);
    }
}
