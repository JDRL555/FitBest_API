<?php

namespace App\Enums\Http;

enum HttpStatusMessage: int
{
    case UNAUTHORIZED = 401;
    case FORBIDDEN = 403;
    case NOT_FOUND = 404;
    case UNPROCESSABLE_ENTITY = 422;
    case INTERNAL_SERVER_ERROR = 500;

    public function message(): string
    {
        return match ($this) {
            self::UNAUTHORIZED => 'No tienes autorización para acceder a este recurso',
            self::FORBIDDEN => 'No tienes permiso para acceder a este recurso',
            self::NOT_FOUND => 'Recurso no encontrado',
            self::UNPROCESSABLE_ENTITY => 'Existen errores en las validaciones de tu solicitud',
            self::INTERNAL_SERVER_ERROR => 'Error interno del servidor',
        };
    }
}
