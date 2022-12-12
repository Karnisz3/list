<?php

declare(strict_types=1);

namespace Terminal\Entries\UseCases\Queries\GetAll\Contract;

use Terminal\Engine\Application\CanBeSorted;
use Psr\Http\Message\ServerRequestInterface;
use Terminal\Engine\Application\CanBePaginated;

class Query
{
    use CanBeSorted;
    use CanBePaginated;

    public static function create(ServerRequestInterface $request): Query
    {
        $instance = new self();
        $instance::extractPagination($request);
        $instance::extractSorting($request);

        return $instance;
    }

    private function __construct() {}
}
