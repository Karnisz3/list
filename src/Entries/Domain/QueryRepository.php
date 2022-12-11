<?php

declare(strict_types=1);

namespace Terminal\Entries\Domain;

use Terminal\Entries\Domain\QueryModel\Entry;

interface QueryRepository
{
    /**
     * @return Entry[]
     */
    public function all(): array;

    public function oneById(string $id): ?Entry;
}
