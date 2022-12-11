<?php

declare(strict_types=1);

namespace Terminal\Entries\UseCases\Queries\GetAll;

use Terminal\Engine\Application\CanBeSorted;
use Psr\Http\Message\ServerRequestInterface;
use Terminal\Engine\Application\CanBePaginated;

class Query
{
    use CanBeSorted;
    use CanBePaginated;

    public function __construct(ServerRequestInterface $request) {
        self::extractPagination($request);
        self::extractSorting($request);
    }
}
