<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GuestPengelola
{
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('pengelola_gudang_id')) {
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
