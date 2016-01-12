<?php

namespace App\Http\Middleware;

use Closure;

class Login
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){

        if (!\Sentinel::check()){
            return \Redirect::to('login');
        }

        return $next($request);
    }
}
