<?php

declare(strict_types=1);

use Slim\App;
use GuzzleHttp\Psr7\ServerRequest;

require __DIR__ . '/../vendor/autoload.php';

/** @var App $app */
$app = (require __DIR__ . '/../app/bootstrap.php')(__DIR__ . '/..', 'dev');

// define middleware
(require __DIR__ . '/../app/middleware.php')($app);
// define routes
(require __DIR__ . '/../app/routes.php')($app);

// run application
$app->run(ServerRequest::fromGlobals());
