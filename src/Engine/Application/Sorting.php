<?php

declare(strict_types=1);

namespace Terminal\Engine\Application;

class Sorting
{
    public function __construct(
        public readonly string $variable,
        public readonly string $order = 'asc'
    ) {}
}
