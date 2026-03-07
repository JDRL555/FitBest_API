<?php

use App\Enums\Http\HttpStatusMessage;
use App\Support\StatusCodeHandler;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->api(append: [
            App\Http\Middleware\ToJsonResponse::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(function ($request, $e) {
            if ($request->is('api/*')) {
                return true;
            }
            return $request->expectsJson();
        });
        
        $exceptions->render(function (Throwable $e, Request $request) {
            if ($request->is('api/*')) {
                
                $status = StatusCodeHandler::getStatusCode($e);
                $message = HttpStatusMessage::tryFrom($status)?->message() ?? 'Error desconocido';
            }

            $responseData = [
                'success' => false,
                'message' => $status === 500 ? "$message: " . $e->getMessage() : $message ?? $e->getMessage(),
                'status' => $status ?? 500,
            ];

            if($e instanceof ValidationException) {
                $responseData['errors'] = $e->errors();
            }

            return response()->json($responseData, $status ?? 500);
        });
    })->create();
