<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GestorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->tipo_user !== 'gestor') {
            abort(403); // Proíbe acesso
        }

        return $next($request);
    }
}