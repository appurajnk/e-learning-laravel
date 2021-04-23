<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Course;

class CheckIfUserIsAuthor
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
        $course = Course::where('uuid', $request->uuid)->first();
        if(! $request->user()){
            return redirect('/');
        }
        if(! $request->user()->isCourseAuthor($course)){
            return redirect('/');
        }

        return $next($request);
    }
}
