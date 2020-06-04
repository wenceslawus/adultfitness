<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class ifAdmin
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
        $user = Auth::user();

        if($user != null)
        {
            if($user->role == 'admin')
            {
                return $next($request);
            }
            else
            {
                return response(null, 403);
            }
        }
        else
        {
            return response(null, 401);
        }
       
    }
}
