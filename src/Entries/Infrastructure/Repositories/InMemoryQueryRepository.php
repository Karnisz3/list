<?php

declare(strict_types=1);

namespace Terminal\Entries\Infrastructure\Repositories;

use Terminal\Entries\Domain\QueryRepository;
use Terminal\Entries\Domain\QueryModel\Entry;

class InMemoryQueryRepository implements QueryRepository
{
    private array $entries;

    public function __construct()
    {
        $this->entries = [
            'E-1' => ['id' => 'E-1', 'title' => "Odkurzyć"],
            'E-2' => ['id' => 'E-2', 'title' => "Zrobić pranie"],
            'E-3' => ['id' => 'E-3', 'title' => "Pozmywać"]
        ];
    }

    /**
     * @inheritDoc
     */
    public function all(): array
    {
        $entries = [];
        foreach ($this->entries as $id => $entry) {
            $entries[] = new Entry($entry['id'], $entry['title']);
        }

        return $entries;
    }

    public function oneById(string $id): ?Entry
    {
        $entry = $this->entries[$id] ?? null;

        if ($entry === null) {
            return null;
        }

        return new Entry($entry['id'], $entry['title']);
    }
}
