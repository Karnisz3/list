<?php

declare(strict_types=1);

namespace Terminal\Entries\Infrastructure\Repositories;

use Terminal\Engine\Application\Sorting;
use Terminal\Engine\Application\Filters;
use Terminal\Engine\Application\Pagination;
use Terminal\Entries\Domain\QueryRepository;
use Terminal\Entries\Domain\QueryModel\Entry;

class InMemoryQueryRepository implements QueryRepository
{
    private array $entries;

    public function __construct()
    {
        $this->entries = [
            'E-1' => [ 'id' => 'E-1',  'title' => "Odkurzyć"     , 'createdAt' => "2023-01-02"],
            'E-2' => [ 'id' => 'E-2',  'title' => "Zrobić pranie", 'createdAt' => "2023-01-03"],
            'E-3' => [ 'id' => 'E-3',  'title' => "Pozmywać"     , 'createdAt' => "2023-01-04"],
            'E-4' => [ 'id' => 'E-4',  'title' => "Zrobić zakupy", 'createdAt' => "2023-01-05"],
            'E-5' => [ 'id' => 'E-5',  'title' => "Twoja stara"  , 'createdAt' => "2023-01-06"],
            'E-6' => [ 'id' => 'E-6',  'title' => "Ryby"         , 'createdAt' => "2023-01-06"],
            'E-7' => [ 'id' => 'E-7',  'title' => "Jajka"        , 'createdAt' => "2023-01-07"],
            'E-8' => [ 'id' => 'E-8',  'title' => "Cebula"       , 'createdAt' => "2023-01-07"],
            'E-9' => [ 'id' => 'E-9',  'title' => "Kostka"       , 'createdAt' => "2023-01-07"],
            'E-10' => ['id' => 'E-10', 'title' => "Bąki"         , 'createdAt' => "2023-01-07"],
            'E-11' => ['id' => 'E-11', 'title' => "Pszczółki"    , 'createdAt' => "2023-01-07"],
            'E-12' => ['id' => 'E-12', 'title' => "Gady"         , 'createdAt' => "2023-01-08"],
        ];
    }

    /**
     * @inheritDoc
     */
    public function all(
        ?Pagination $pagination = null,
        ?Sorting $sorting = null,
        ?Filters $filters = null
    ): array
    {
        $inMemoryEntries = $this->entries;

        // filter
        if ($filters !== null) {
            // not implemented yet
        }

        // sort
        if ($sorting !== null && in_array($sorting->variable, ['id', 'title', 'createdAt'])) {
            usort($inMemoryEntries, function (array $a1, array $a2) use ($sorting) {
                return ($a1[$sorting->variable] <=> $a2[$sorting->variable]) * ($sorting->order === 'asc' ? 1 : -1);
            });
        }

        // paginate
        if ($pagination !== null && $pagination->page > 0 && $pagination->perPage > 0) {
            $inMemoryEntries = array_slice(
                $inMemoryEntries,
                ($pagination->page - 1) * $pagination->perPage,
                $pagination->perPage
            );
        }

        $entries = [];
        foreach ($inMemoryEntries as $entry) {
            $entries[] = new Entry($entry['id'], $entry['title'], $entry['createdAt']);
        }

        return $entries;
    }

    public function oneById(string $id): ?Entry
    {
        $entry = $this->entries[$id] ?? null;

        if ($entry === null) {
            return null;
        }

        return new Entry($entry['id'], $entry['title'], $entry['createdAt']);
    }
}
