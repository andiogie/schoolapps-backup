<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        apiPrefix: 'api',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            \App\Http\Middleware\RequestResponseLogger::class,
        ]);
        $middleware->api(append: [
            \App\Http\Middleware\RequestResponseLogger::class,
        ]);

        $middleware->alias([
            'role'     => \App\Http\Middleware\RoleMiddleware::class,
            'auth'     => \App\Http\Middleware\Authenticate::class,
            'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Penanganan error kustom sementara dinonaktifkan untuk debugging.
        // Kode ini akan diaktifkan kembali saat production.
        /*
        $exceptions->render(function (Throwable $e, Request $request) {

            if ($e instanceof HttpExceptionInterface) {
                $code = $e->getStatusCode();

                // KHUSUS untuk error 503 (Maintenance), biarkan Laravel menggunakan 503.blade.php
                if ($code == 503) {
                    return;
                }

                $defaultTitle = Response::$statusTexts[$code] ?? 'Error';

                return response()->view('errors.error', [
                    'code'      => $code,
                    'title'     => $defaultTitle,
                    'message'   => $e->getMessage() ?: "Terjadi kendala ($defaultTitle) pada layanan kami.",
                    'exception' => $e
                ], $code);
            }

            // Untuk semua error lainnya (Internal Server Error, dll)
            return response()->view('errors.error', [
                'code'      => 500,
                'title'     => 'Internal Server Error',
                'message'   => 'Maaf, terjadi kesalahan pada server. Tim kami sedang memperbaikinya.',
                'exception' => $e
            ], 500);
        });
        */
    })->create();
