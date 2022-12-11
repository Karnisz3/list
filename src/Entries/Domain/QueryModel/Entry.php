<?php

declare(strict_types=1);

namespace Terminal\Entries\Domain\QueryModel;

class Entry
{
    public function __construct(
        public readonly string $id,
        public readonly string $title
    ) {}
}
