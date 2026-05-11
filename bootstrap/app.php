<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CheckRole;  
use App\Http\Middleware\GestorMiddleware;  // Importa o seu middleware

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Registar o alias 'gestor' para o middleware
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
            'gestor' => GestorMiddleware::class,
            'admin' => AdminMiddleware::class,
            

        ]);
        
        // Se quiser adicionar middlewares globais, use:
        // $middleware->append(\App\Http\Middleware\ExemploGlobal::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();