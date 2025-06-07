<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (\Throwable $e, $request) {
            if ($request->is('api/*') || $request->expectsJson()) {
                $status = $e instanceof HttpExceptionInterface ? $e->getStatusCode() : 500;

                return response()->json([
                    'message' => $e->getMessage(),
                    'exception' => class_basename($e),
                    'code' => $status,
                ], $status);
            }

            return null; // fallback to Laravel's default rendering
        });
    })
    ->create();
