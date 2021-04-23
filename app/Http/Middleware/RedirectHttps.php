<?php

namespace App\Http\Middleware;

use Closure;

class RedirectHttps
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
        if(app()->environment() === 'production' && installed()) {
            if(! $request->secure() && (int)setting('site.redirect_https')==1){
                return redirect()->secure($request->getRequestUri());
            }
        }

        return $next($request);
        
    }
}
