<?php

declare(strict_types=1);

namespace Terminal\Engine\Application;

interface QueryResult
{
    public function toArray(): array;

    public function isEmpty(): bool;
}
