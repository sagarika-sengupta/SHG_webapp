<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\viewMiddleware;
use App\Http\Middleware\userLogin;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
     //   $middleware->append(viewMiddleware::class);
       // $middleware->append(userLogin::class);
     //   $middleware->append(\App\Http\Middleware\userLogin::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
