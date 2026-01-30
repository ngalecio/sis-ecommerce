<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Session\TokenMismatchException; // <--- Importante agregar esto
use Illuminate\Http\Request;
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

    $middleware->trustProxies(
        at: '*',  // Confiar en todos los proxies
        headers: Request::HEADER_X_FORWARDED_FOR |
            Request::HEADER_X_FORWARDED_HOST |
            Request::HEADER_X_FORWARDED_PORT |
            Request::HEADER_X_FORWARDED_PROTO |
            Request::HEADER_X_FORWARDED_AWS_ELB
    );

    // Opcional: Si el error persiste, añade esto para asegurar las cookies
    //$middleware->validateCsrfTokens(except: []); // Asegúrate de que no haya errores aquí
    //
    $middleware->encryptCookies(except: []);
})
    ->withExceptions(function (Exceptions $exceptions): void {

    $exceptions->reportable(function (TokenMismatchException $e) {
        \Illuminate\Support\Facades\Log::error('Error CSRF Detectado: ' . $e->getMessage(), [
            'url' => request()->fullUrl(),
            'input' => request()->except(['password', '_token']),
            'session_id' => request()->session()->getId(),
        ]);
    });
    })->create();
