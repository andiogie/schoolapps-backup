<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Response;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($this->isHttpException($exception)) {
            $code = $exception->getStatusCode();
            
            // Prioritaskan view spesifik seperti 503.blade.php
            if (view()->exists("errors.{$code}")) {
                 return response()->view("errors.{$code}", ['exception' => $exception], $code);
            }

            // Fallback ke error.blade.php generik
            if (view()->exists('errors.error')) {
                $message = $exception->getMessage();
                if (empty($message) && isset(\Symfony\Component\HttpFoundation\Response::$statusTexts[$code])) {
                    $message = \Symfony\Component\HttpFoundation\Response::$statusTexts[$code];
                }

                return Response::view('errors.error', [
                    'code'      => $code,
                    'message'   => $message,
                    'exception' => $exception,
                ], $code);
            }
        }

        return parent::render($request, $exception);
    }
}
