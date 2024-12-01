<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role = null)
    {
        // Contoh logika pemeriksaan role
        if ($role && (!$request->user() || $request->user()->role !== $role)) {
            return redirect('/'); // Redirect jika role tidak sesuai
        }

        return $next($request);
    }
}
