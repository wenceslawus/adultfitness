<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App;

use Closure;

class setLanguage
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
        if($user){
          App::setLocale($user->locale);
        } else {
          App::setLocale(App::getLocale());
        }

        return $next($request);
    }
}
