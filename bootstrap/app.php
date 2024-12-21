<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->alias([
            'isNotLogin' => App\Http\Middleware\isNotLogin::class,
            'isLogin' => App\Http\Middleware\isLogin::class,
            'isGuest' => App\Http\Middleware\isGuest::class,
            'isStaff' => App\Http\Middleware\isStaff::class,
            'isHead' => App\Http\Middleware\isHead::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
