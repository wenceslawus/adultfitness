<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class ifPaid
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
            if($user->subscribed_to > now())
            {
               
                $request->user = $user;

                return $next($request);
            }
            else
            {
                return response()->json(['error' => 'no_subscription'], 403);
            }
        }
        else
        {
            return response(null, 401);
        }
    }
}
