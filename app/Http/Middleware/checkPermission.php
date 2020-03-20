<?php

namespace App\Http\Middleware;

use Closure;
class checkPermission
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
        if(session()->has('member')){
            // Session::put("req",$request);
            return $next($request);
        }
        // return $next($request);
        return redirect('login');
    }
}
