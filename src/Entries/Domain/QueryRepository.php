<?php

declare(strict_types=1);

namespace Terminal\Entries\Domain;

use Terminal\Engine\Application\Sorting;
use Terminal\Engine\Application\Filters;
use Terminal\Engine\Application\Pagination;
use Terminal\Entries\Domain\QueryModel\Entry;

interface QueryRepository
{
    /**
     * @return Entry[]
     */
    public function all(
        ?Pagination $pagination = null,
        ?Sorting $sorting = null,
        ?Filters $filters = null
    ): array;

    public function oneById(string $id): ?Entry;
}
