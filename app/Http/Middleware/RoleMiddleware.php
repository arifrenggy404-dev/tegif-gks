<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!in_array(Auth::user()->role, $roles)) {
            // Arahkan ke dashboard sesuai role masing-masing
            return match (Auth::user()->role) {
                'admin'     => redirect()->route('admin.dashboard'),
                'bendahara' => redirect()->route('bendahara.dashboard'),
                'pengurus'      => redirect()->route('pengurus.dashboard'),
                default     => abort(403, 'Akses ditolak.'),
            };
        }

        return $next($request);
    }
}
