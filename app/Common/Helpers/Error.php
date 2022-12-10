<?php

declare(strict_types=1);

namespace Terminal\Common\Helpers;

class Error
{
    public static function messageForHttp(\Exception $exception): array
    {
        return [
            'code' => (string)$exception->getCode(),
            'message' => (string)$exception->getMessage(),
        ];
    }

    public static function messageForLog(\Exception $exception): string
    {
        return (string)$exception;
    }
}
