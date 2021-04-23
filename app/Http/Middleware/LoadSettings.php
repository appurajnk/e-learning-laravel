<?php

namespace App\Http\Middleware;

use Closure;
use App\Utilities\Overrider;

class LoadSettings
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
        //Overrider::load('settings');
        return $next($request);
    }
}
