<?php

declare(strict_types=1);

namespace Terminal\Entries\UseCases\Queries\GetAll;

use Terminal\Entries\Domain\QueryRepository;
use Terminal\Entries\UseCases\Queries\GetAll\Contract\Query;
use Terminal\Entries\UseCases\Queries\GetAll\Contract\Result;

class Handler
{
    public function __construct(
        private readonly QueryRepository $entries
    ) {}

    public function handle(Query $query): Result
    {
        $allEntries = $this->entries->all();

        return Result::create($allEntries);
    }
}
