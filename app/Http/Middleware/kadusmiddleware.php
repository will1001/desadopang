<?php

namespace App\Http\Middleware;

use Closure;

class kadusmiddleware
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
        if (auth()->check() && $request->user()->roles == ‘kadus’ && $request->user()->status == ‘aktif’)
        {
        return redirect()->guest('adminkadus');
        }
        return $next($request);
    }
}
