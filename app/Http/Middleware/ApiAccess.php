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
        $user = \App\User::where('token', $request->token)->where('active', true)->first();

        //TODO:: create scopes in user model
        if($user){
            \Auth::login($user, true);
            return $next($request);
        }else{
            abort(500, 'Unable to authenticate API');
        }
    }
}
