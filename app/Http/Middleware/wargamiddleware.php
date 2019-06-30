<?php

namespace App\Http\Middleware;

use Closure;

class wargamiddleware
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
        if (auth()->check() && $request->user()->roles == "member" && $request->user()->status == "aktif")
        {
        return redirect()->guest("adminwarga");
        }
        if (auth()->check() && $request->user()->roles == "member" && $request->user()->status == "tidak aktif")
        {
        return redirect()->guest("login");
        }
        return $next($request);
    }
}
