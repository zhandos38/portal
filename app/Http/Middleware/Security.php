<?php

namespace App\Http\Middleware;

use Carbon\CarbonImmutable;
use Closure;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class Security
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
            if(Auth::user()->role_id == 1){
                $security = \App\Security::where("user_id",Auth::id())->first();
                if($security){
                    if($security->active == 0){
                        $security_key = Str::random(16);
                        Session::put('security_key', $security_key);
                        $security->user_id = Auth::id();
                        $security->active = 1;
                        $security->last_activity = Carbon::now();
                        $security->session_date = Carbon::now()->addDay();
                        $security->security_key = $security_key;
                        $security->save();
                        return $next($request);
                    }
                    if($security->active == 1){
                        if(Session::get('security_key') == $security->security_key){
                            return $next($request);
                        }
                        else{
                            if(Carbon::now() > $security->session_date){
                                $security_key = Str::random(16);
                                Session::put('security_key', $security_key);
                                $security->user_id = Auth::id();
                                $security->active = 1;
                                $security->last_activity = Carbon::now();
                                $security->session_date = Carbon::now()->addDay();
                                $security->security_key = $security_key;
                                $security->save();
                                return $next($request);
                            }
                            else{
                                abort(404);
                            }
                        }

                    }
                }
                else{
                    $security_key = Str::random(16);
                    Session::put('security_key', $security_key);
                    \App\Security::create(["user_id"=>Auth::id(),
                        "active"=>1, "last_activity"=>Carbon::now(), "session_date"=>Carbon::now()->addDay(),
                        "security_key" =>$security_key
                    ]);
                    return $next($request);
                }
            }
            else{
                return $next($request);
            }

        }
        else{
            return redirect('/login');
        }
    }

}
