<?php

declare(strict_types=1);

use Phalcon\Mvc\Micro;

define('APP_ROOT', dirname(__DIR__));
define('CONFIG_DIR', APP_ROOT . '/config');

// register autoloader
(require CONFIG_DIR . '/autoload.php')(APP_ROOT);

// create di container
$di = (require CONFIG_DIR . '/container.php')();
// instantiate application
$app = new Micro($di);

// define routes
(require CONFIG_DIR . '/routes.php')($app);
// ser error handler
(require CONFIG_DIR . '/error_handling.php')($app);

//run application
$app->handle($_SERVER['REQUEST_URI']);
