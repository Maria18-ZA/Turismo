<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->tipo_user !== 'admin') {
            abort(403); // Proíbe acesso
        }

        return $next($request);
    }
}