<?php

declare(strict_types=1);

namespace Terminal\Entries\Controllers;

use Terminal\Engine\ResponseEncoding\Encoder;
use Psr\Http\Message\ResponseInterface as response;
use Terminal\Entries\UseCases\Queries\GetOne\Handler;
use Psr\Http\Message\ServerRequestInterface as request;
use Terminal\Entries\UseCases\Queries\GetOne\Contract\Query;

class GetOne
{
    public function __construct(
        private readonly Handler $handler,
        private readonly Encoder $encoder
    ) {}

    public function __invoke(request $request, response $response, array $args): response
    {
        $query = new Query($args['entryId']);

        $result = $this->handler->handle($query);

        $response->getBody()->write($this->encoder->encode($result));

        return $this->encoder
            ->prepareResponse($response)
            ->withStatus($result->isEmpty() ? 204 : 200);
    }
}
