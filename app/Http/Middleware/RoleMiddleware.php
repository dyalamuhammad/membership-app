<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect('/login'); // Arahkan ke login jika belum login
        }

        $user = Auth::user();

        // Periksa apakah role user cocok dengan role yang diperlukan
        if ($user->role != $role) { // Ganti 'role' dengan nama kolom yang sesuai, misal 'user_type', 'is_admin', dsb.
            abort(403, 'Unauthorized'); // Tampilkan error 403 jika role tidak sesuai
        }

        return $next($request);
    }
}