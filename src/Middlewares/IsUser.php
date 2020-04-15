<?php

namespace Tir\User\Middlewares;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Closure;
use Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class IsUser
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
            return $next($request);
        }
            return Redirect::to(route('login'));
    }

}
