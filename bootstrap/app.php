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
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'isSupervisor' => \App\Http\Middleware\VerifyIsSupervisor::class,
            'isPimpinan' => \App\Http\Middleware\VerifyIsPimpinan::class,
            'isOperator' => \App\Http\Middleware\VerifyIsOperator::class,
            'isOperatorOrPimpinan' => \App\Http\Middleware\VerifyIsOperatorOrPimpinan::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
