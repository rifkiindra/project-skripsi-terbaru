<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = Auth::user()->role;

        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        if ($userRole === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($userRole === 'member') {
            return redirect()->route('member.dashboard');
        }

        if ($userRole === 'tim') {
            return redirect()->route('tim.artworks.index');
        }

        if ($userRole === 'direktur') {
            return redirect()->route('direktur.dashboard');
        }  

        abort(403, 'Unauthorized');
    }
}
