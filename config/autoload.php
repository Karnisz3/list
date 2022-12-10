<?php

declare(strict_types=1);

use Phalcon\Autoload\Loader;

return function (string $appRoot) {
    (new Loader())
        ->addNamespace('Terminal', $appRoot . '/app')
        ->register(true);
};
