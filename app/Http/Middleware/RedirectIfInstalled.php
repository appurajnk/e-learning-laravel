<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfInstalled
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
        // if(installed()){
        //     return redirect('/');
        // }
        return $next($request);
    }
}
