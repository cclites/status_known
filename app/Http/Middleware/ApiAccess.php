<?php

namespace App\Http\Middleware;

use Closure;

class ApiAccess
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
        if($user = \App\User::where('token', $request->token)->where('active', true)){
            \Log::info("user is valid");
            return $next($request);
        }else{
            \Log::info("User is not valid");
            //Clear out the form, or leave a message indicating that the business is no longer active
            return "";
        }

    }
}
