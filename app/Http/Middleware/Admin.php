<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
        //get currrnt user
        $user = \Sentinel::getUser();

        if($user->inRole('coder')){
            return $next($request);
        } else{
            return \Redirect::back()->with('message', 'You do not have the permission to access this page');
        } 
    }
}
