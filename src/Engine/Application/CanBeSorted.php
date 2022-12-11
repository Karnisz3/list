<?php

declare(strict_types=1);

namespace Terminal\Engine\Application;

use Psr\Http\Message\ServerRequestInterface as request;

trait CanBeSorted
{
    protected static Sorting $sorting;

    protected static function extractSorting(request $request): void
    {
        $sortString = $request->getParsedBody()['sort'];
        list($variable, $order) = explode(':', $sortString);
        self::$sorting = new Sorting($variable, $order);
    }

    public function sorting(): Sorting
    {
        if (!isset(self::$sorting)) {
            return new Sorting('', '');
        }

        return self::$sorting;
    }
}
