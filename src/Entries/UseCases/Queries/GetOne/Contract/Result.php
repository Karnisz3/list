<?php

declare(strict_types=1);

namespace Terminal\Entries\UseCases\Queries\GetOne\Contract;

use Terminal\Engine\Application\QueryResult;
use Terminal\Entries\Domain\QueryModel\Entry;

class Result implements QueryResult
{
    private function __construct(
        private readonly ?Entry $entry
    ) {}

    public static function create(?Entry $entry): Result
    {
        return new Result($entry);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        if ($this->entry === null) {
            return [];
        }

        return [
            'id' => $this->entry->id,
            'title' => $this->entry->title
        ];
    }

    public function isEmpty(): bool
    {
        return $this->entry === null;
    }
}
