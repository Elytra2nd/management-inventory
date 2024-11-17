<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticatePengelola
{
    public function handle($request, Closure $next)
    {
        if (!session()->has('pengelola_gudang_id')) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }
    return $next($request);
    }
}
