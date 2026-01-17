<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah user sudah login?
        if (Auth::check()) {
            
            // 2. Cek apakah level usernya 'admin'?
            // PENTING: Ganti 'usertype' dengan 'role' jika nama kolom di databasemu 'role'
            if (Auth::user()->usertype === 'admin') { 
                return $next($request); // Silakan masuk pak Eko!
            }
            
            // 3. Kalau login tapi BUKAN admin, tendang ke halaman user (home)
            return redirect('/')->with('error', 'Anda tidak punya akses ke halaman ini.');
        }

        // 4. Kalau belum login sama sekali, tendang ke halaman login
        return redirect('/login');
    }
}