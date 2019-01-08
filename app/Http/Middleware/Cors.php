<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /*
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request)
//            ->Header("Access-Control-Allow-Origin", "*")
              ->Header("Access-Control-Allow-Credentials", "true");
//            ->Header("Access-Control-Allow-Methods", "GET,HEAD,OPTIONS,POST,PUT")
//            ->Header("Access-Control-Allow-Headers", "Access-Control-Allow-Headers,
//            Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method,
//            Access-Control-Request-Headers");
    }
}
