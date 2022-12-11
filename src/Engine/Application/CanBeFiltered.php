<?php

declare(strict_types=1);

namespace Terminal\Engine\Application;

use Psr\Http\Message\ServerRequestInterface as request;

trait CanBeFiltered
{
    protected static Filters $filters;

    protected static function extractFilters(request $request): Filters
    {
        return new Filters();
    }

    public function filters(): Filters
    {
        if (!isset(self::$filters)) {
            return new Filters();
        }

        return self::$filters;
    }
}
