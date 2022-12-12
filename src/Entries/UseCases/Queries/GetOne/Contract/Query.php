<?php

declare(strict_types=1);

namespace Terminal\Entries\UseCases\Queries\GetOne\Contract;

use Psr\Http\Message\ServerRequestInterface as request;

class Query
{
    private function __construct(
        public readonly string $id
    ) {}

    public static function create(request $request): Query
    {
        self::validateRequest($request);

        $id = $request->getAttribute('entryId');

        return new self($id);
    }

    private static function validateRequest(request $request): void
    {
        $entryId = (string)$request->getAttribute('entryId');

        if ($entryId === '') {
            throw new \InvalidArgumentException('empty:entryId', 400);
        }

        if (!preg_match('/^E\-\d+$/', $entryId)) {
            throw new \InvalidArgumentException('invalid:entryId', 400);
        }
    }
}
