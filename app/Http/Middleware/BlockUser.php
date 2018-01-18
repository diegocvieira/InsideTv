<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class BlockUser
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
        if(!Auth::check() || Auth::user()->access_level == 0){
            return redirect('/');
        }

        return $next($request);
    }
}
