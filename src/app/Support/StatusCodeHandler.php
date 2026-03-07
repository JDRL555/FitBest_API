<?php

namespace App\Support;

use Throwable;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StatusCodeHandler
{
    /**
     * Determina el código de estado HTTP basándose en el tipo de excepción.
     */
    public static function getStatusCode(Throwable $e): int
    {
        return match (true) {
            $e instanceof ValidationException => 422,
            $e instanceof AuthenticationException => 401,
            $e instanceof ModelNotFoundException => 404,
            $e instanceof HttpExceptionInterface => $e->getStatusCode(),
            self::isValidStatusCode($e->getCode()) => $e->getCode(),
            default => 500,
        };
    }

    /**
     * Verifica si un código está dentro del rango válido de HTTP.
     */
    private static function isValidStatusCode(mixed $code): bool
    {
        return is_int($code) && $code >= 100 && $code < 600;
    }
}