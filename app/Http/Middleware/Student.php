<?php

namespace App\Http\Middleware;

use App\ExpelledStudent;
use Closure;
use Illuminate\Support\Facades\Auth;

class Student
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
        if (Auth::user()->role_id == 5) {
            if(ExpelledStudent::where("student_id",Auth::id())->first() == null){
                return $next($request);
            }
            else{
                abort(404);
            }

        }
        abort(404);
    }
}
