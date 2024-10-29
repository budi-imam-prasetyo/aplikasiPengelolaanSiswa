<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles) // Mendapatkan parameter role
    {
        // Cek jika pengguna terautentikasi dan memiliki salah satu role
        if (!Auth::check() || !Auth::user()->hasAnyRole($roles)) {
            // Jika tidak, redirect ke halaman yang sesuai
            return redirect('/'); // Ganti dengan URL yang tepat
        }
        
        return $next($request); // Lanjutkan ke request selanjutnya
    }
}
