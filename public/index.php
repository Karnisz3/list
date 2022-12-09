<?php

declare(strict_types=1);

use Phalcon\Mvc\Micro;
use Phalcon\Autoload\Loader;

(new Loader())
    ->addNamespace('Terminal', '../app')
    ->register(true);

$container = (require __DIR__ . '/../config/container.php')();
$app = new Micro($container);
(require __DIR__ . '/../config/routes.php')($app);

$app->handle($_SERVER['REQUEST_URI']);