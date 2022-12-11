<?php

declare(strict_types=1);

namespace Terminal\Engine\ResponseEncoding;

use Terminal\Engine\Application\QueryResult;
use Psr\Http\Message\ResponseInterface as response;

class Json implements Encoder
{
    public function encode(QueryResult $result): string
    {
        $array = $result->toArray();

        if (count($array) < 1) {
            return '';
        }

        return (string)json_encode($array, JSON_THROW_ON_ERROR|JSON_PRETTY_PRINT);
    }

    public function prepareResponse(response $response): response
    {
        return $response
            ->withHeader('Content-Type', 'application/json;charset=UTF-8')
            ->withHeader('Content-Length', (string)$response->getBody()->getSize());
    }
}
