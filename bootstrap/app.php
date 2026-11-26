<?php

use App\Http\Middleware\EnsureUserRole;
use App\Http\Middleware\LogRequestMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // 1. Mendaftarkan alias agar bisa dipanggil singkat di routes/web.php
        $middleware->alias([
            'role' => EnsureUserRole::class,
            'log.request' => LogRequestMiddleware::class,
        ]);

        // 2. Mendaftarkan global middleware untuk semua rute web
        $middleware->web(append: [
            LogRequestMiddleware::class,
        ]);

        // 3. Menentukan tujuan redirect otomatis
        $middleware->redirectGuestsTo(fn (Request $request) => route('login'));
        $middleware->redirectUsersTo(function (Request $request) {
            return $request->user()?->isAdmin()
                ? route('pc-assets.index')
                : route('pc-assets.index');
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
