<?php

declare(strict_types=1);

namespace Terminal\Entries\UseCases\Queries\GetAll\Contract;

use Terminal\Engine\Application\QueryResult;
use Terminal\Entries\Domain\QueryModel\Entry;

class Result implements QueryResult
{
    /**
     * @param Entry[] $entries
     */
    private function __construct(
        private readonly array $entries
    ) {}

    public static function create(array $entries): Result
    {
        return new Result($entries);
    }

    public function toArray(): array
    {
        $array = [];
        foreach ($this->entries as $entry) {
            $array[] = [
                'id' => $entry->id,
                'title' => $entry->title,
                'createdAt' => $entry->createdAt
            ];
        }

        return $array;
    }

    public function isEmpty(): bool
    {
        return count($this->entries) < 1;
    }
}
