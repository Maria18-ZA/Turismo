<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GestorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->role !== 'gestor') {
            abort(403, 'Acesso negado. Apenas gestores.');
        }
        return $next($request);
    }
}