<?php

declare(strict_types=1);

use Phalcon\Mvc\Micro;
use Terminal\Entries as entries;
use Phalcon\Mvc\Micro\Collection;

return function (Micro $app) {
    $requestContext = explode('/', $_SERVER['REQUEST_URI'])[1] ?? '';
    switch ($requestContext) {
        case 'entries':
            $app->mount(
                (new Collection())
                    ->setHandler(entries\Controller::class)
                    ->setLazy(true)
                    ->setPrefix('/entries')
                    ->get('/', 'getAll', 'entries.all')
                    ->post('/', 'createOne', 'entries.create')
            );
            break;
        default:
            exit("NIMAND");
    }
};
