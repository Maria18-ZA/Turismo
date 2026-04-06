<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->tipo_user !== 'user') {
            abort(403); // Usuário não tem acesso
        }

        return $next($request);
    }
}