<?php

namespace Tir\User\Middlewares;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Closure;
use Gate;
use Illuminate\Support\Facades\Auth;

class IsGuest
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
        if (Sentinel::check()) {
            return redirect()->guest('/account');
        }
        return $next($request);
    }

}
