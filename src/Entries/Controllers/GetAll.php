<?php

declare(strict_types=1);

namespace Terminal\Entries\Controllers;

use Terminal\Engine\ResponseEncoding\Encoder;
use Psr\Http\Message\ResponseInterface as response;
use Terminal\Entries\UseCases\Queries\GetAll\Handler;
use Psr\Http\Message\ServerRequestInterface as request;
use Terminal\Entries\UseCases\Queries\GetAll\Contract\Query;

class GetAll
{
    public function __construct(
        private readonly Handler $handler,
        private readonly Encoder $encoder
    ) {}

    public function __invoke(request $request, response $response): response
    {
        $query = Query::create($request);

        $result = $this->handler->handle($query);

        $response->getBody()->write($this->encoder->encode($result));

        return $this->encoder
            ->prepareResponse($response)
            ->withStatus($result->isEmpty() ? 204 : 200);
    }
}
