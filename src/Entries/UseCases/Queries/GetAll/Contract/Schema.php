<?php

declare(strict_types=1);

namespace Terminal\Entries\UseCases\Queries\GetAll\Contract;

use Psr\Http\Message\ServerRequestInterface as request;
use Terminal\Entries\UseCases\Queries\GetAll\Query;

class Schema
{
    public static function createQuery(request $request): Query
    {
        return new Query($request);
    }
}
