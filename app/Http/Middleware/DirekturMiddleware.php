<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DirekturMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            abort(401);
        }

        if (Auth::user()->role !== 'direktur') {
            abort(403);
        }

        return $next($request);
    }
}
