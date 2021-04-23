<?php

namespace App\Http\Middleware;

use Closure;

class RestrictIfDemo
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
        if(installed()){
            if(is_envato()) {
                return $next($request);
            }

            if( (int)setting('site.enable_demo_mode') == 1 && $this->forbidRequest($request)) {
                return response(['type' => 'demo', 'message' => 'Action not allowed in Demo Site'], 403);
            }
        }

        return $next($request);
    }

    private function forbidRequest($request)
    {
        $method =$request->method();
        $uri = $request->route()->uri();
        foreach(config('demo-forbidden-routes') as $route) {
            if($method === $route['method'] && trim($uri) === trim($route['uri'])) {
                return true;
            }
        }

        return false;
    }
}
