<?php

namespace App\Http\Middleware;

use Closure;

class kadesmiddleware
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
        if (auth()->check() && $request->user()->roles == ‘kades’ && $request->user()->status == ‘aktif’)
        {
        return redirect()->guest('adminkades');
        }
        return $next($request);
    }
}
