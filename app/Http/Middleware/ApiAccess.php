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
        $business = \App\Business::where('api_token', $request->api_token)->with('responsibleAgent')->first();
        $user = $business->responsibleAgent;

        //TODO:: create scopes in user model
        if($business){
            \Auth::login($user, true);
            return $next($request);
        }else{
            //TODO:: return a blank view of some sort.
            abort(403, 'Unable to authenticate API');
        }
    }
}
