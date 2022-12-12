<?php

declare(strict_types=1);

namespace Terminal\Entries\UseCases\Queries\GetOne;

use Terminal\Entries\Domain\QueryRepository;
use Terminal\Entries\UseCases\Queries\GetOne\Contract\Query;
use Terminal\Entries\UseCases\Queries\GetOne\Contract\Result;

class Handler
{
    public function __construct(
        private readonly QueryRepository $entries
    ) {}

    public function handle(Query $query): Result
    {
        $entry = $this->entries->oneById($query->id);

        return Result::create($entry);
    }
}
