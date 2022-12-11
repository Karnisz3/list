<?php

declare(strict_types=1);

use Slim\App;
use Terminal\Entries\Controllers as entries;

return function (App $app) {
    $app->get('/entries', entries\GetAll::class);
    $app->get('/entries/{entryId:E\-\d+}', entries\GetOne::class);
};
