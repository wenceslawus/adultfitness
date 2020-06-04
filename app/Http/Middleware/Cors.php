<?php

namespace App\Http\Middleware;

use Closure;

class Cors
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
    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
    header("Access-Control-Allow-Headers: Origin, Cache-Control, Content-Type, X-Auth-Token, Authorization, x-requested-with" );
    // ALLOW OPTIONS METHOD

    $headers = [
        'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE',
        'Access-Control-Allow-Headers' => 'Content-Type, X-Auth-Token, Origin, Authorization'
    ];
/*
    if ($request->getMethod() == "OPTIONS") {
        // The client-side application can set only headers allowed in Access-Control-Allow-Headers
        return \Response::make('OK', 200, $headers);
    }//*/

    $response = $next($request);
/*   foreach ($headers as $key => $value)
      $response->header($key, $value);//*/

    return $response;
  }
}
