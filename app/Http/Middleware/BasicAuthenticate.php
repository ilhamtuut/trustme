<?php

namespace App\Http\Middleware;

use Closure;

class BasicAuthenticate
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
        $collect = collect(config('auth.baseauth'));
        if($collect['username'] == $request->getUser() && $collect['password'] == $request->getPassword()){
            return $next($request);
        }
        return response()->json(['success'=>false,'message'=>'Unauthenticated'],401);
    }
}
