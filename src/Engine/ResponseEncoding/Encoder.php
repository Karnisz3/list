<?php

declare(strict_types=1);

namespace Terminal\Engine\ResponseEncoding;

use Psr\Http\Message\ResponseInterface as response;
use Terminal\Engine\Application\QueryResult;

interface Encoder
{
    public function encode(QueryResult $result): string;

    public function prepareResponse(response $response): response;
}
