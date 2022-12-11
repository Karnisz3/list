<?php

declare(strict_types=1);

namespace Terminal\Entries\UseCases\Queries\GetOne\Contract;

use Psr\Http\Message\ServerRequestInterface;
use Terminal\Entries\UseCases\Queries\GetOne\Query;

class Schema
{
    public static function createQuery(ServerRequestInterface $request): Query
    {
        $id = $request->getAttribute('entryId');
        self::validateEentryId($id);

        return new Query($id);
    }

    private static function validateEentryId(string $entryId): void
    {
        if ($entryId === '') {
            throw new \InvalidArgumentException('empty:entryId', 400);
        }

        if (!preg_match('/^E\-\d+$/', $entryId)) {
            throw new \InvalidArgumentException('invalid:entryId', 400);
        }
    }
}
