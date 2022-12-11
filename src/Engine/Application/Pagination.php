<?php

declare(strict_types=1);

namespace Terminal\Engine\Application;

class Pagination
{
    public function __construct(
        public readonly int $page = 0,
        public readonly int $perPage = 0
    ) {}
}
