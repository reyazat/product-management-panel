<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckDev
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check() && auth()->user()->role == 'Dev' && auth()->user()->status == 1){
            return $next($request);
        }
        auth()->guard()->logout();

        return redirect()->back()->with('warning', __('Sorry! You are not authorized to access this page.'));

    }
}
