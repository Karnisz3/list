<?php

declare(strict_types=1);

namespace Terminal\Engine\Application;

use Psr\Http\Message\ServerRequestInterface as request;

trait CanBePaginated
{
    protected static Pagination $pagination;

    protected static function extractPagination(request $request): void
    {
        self::$pagination = new Pagination(
            $request->getParsedBody()['pagination']['page'] ?? 0,
            $request->getParsedBody()['pagination']['perPage'] ?? 0
        );
    }

    public function pagination(): Pagination
    {
        if (!isset(self::$pagination)) {
            return new Pagination();
        }

        return self::$pagination;
    }
}
