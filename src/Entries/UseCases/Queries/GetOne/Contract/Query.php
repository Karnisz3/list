<?php

declare(strict_types=1);

namespace Terminal\Entries\UseCases\Queries\GetOne\Contract;

class Query
{
    public function __construct(
        public readonly string $id
    ) {}
}
