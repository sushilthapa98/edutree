<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $isAdmin = auth()->user()->is_admin;
        $uri = $request->route()->uri;
        $isAdminUri = explode('/',$uri)[0] == 'admin';

        // block frontend authenticated routes for admin
        if($isAdmin && !$isAdminUri){
            return redirect()->route('admin.dashboard');
        }else{
            return $next($request);
        }
    }
}
