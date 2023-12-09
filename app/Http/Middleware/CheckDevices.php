<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckDevices
{
 
    public function handle(Request $request, Closure $next)
    {
        $agent = new \Jenssegers\Agent\Agent;
        if(auth()->check() && auth()->user()->hasRole('student') && $agent->isDesktop() && auth()->user()->desktop_ip !== request()->ip())
        {
            return auth()->logout();
        }
        
        if(auth()->check() && auth()->user()->hasRole('student') && $agent->isMobile() && auth()->user()->mobile_ip !== request()->ip())
        {
            return auth()->logout();
        }
        return $next($request);
    }
}
