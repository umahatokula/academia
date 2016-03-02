<?php

namespace App\Http\Middleware;

use Closure;

class HeadTeacher
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

        if($user->inRole('head_teacher')){
            return $next($request);
        } else{
            session()->flash('flash_message', 'You do not have the permission to access this page');
            session()->flash('flash_message_important', true);
            return \Redirect::back();
        } 
    }
}
