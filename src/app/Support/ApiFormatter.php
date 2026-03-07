<?php

namespace App\Support;

use Illuminate\Support\Collection;

class ApiFormatter
{
  /** 
   * Return the standard API response with it success flag, message and status code
  */
  public static function response(string $message, int $status, $data = []): array
  {
    return [
      'metadata' => [
        'success' => Collection::range(200, 299)->contains($status),
        'message' => $message,
        'status' => $status,
      ],
      'data' => $data,
    ];
  }
}