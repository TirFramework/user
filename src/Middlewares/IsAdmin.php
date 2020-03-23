<?php

namespace Tir\User\Middlewares;

use Closure;
use Gate;
use Illuminate\Support\Facades\Auth;

class IsAdmin
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
        if(Auth::check()){
            if(Auth::user()->type != 'admin'){
                return abort('403');
            }
        } else {
            return redirect(route('login'));
        }
        return $next($request);
    }

}
