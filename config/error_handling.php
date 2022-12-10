<?php

declare(strict_types=1);

use Phalcon\Mvc\Micro;
use Phalcon\Http\Response;
use Phalcon\Logger\Logger;
use Phalcon\Logger\Adapter\Stream;
use Terminal\Common\Helpers\Error;
use Phalcon\Http\Message\ResponseStatusCodeInterface as http;

return function (Micro $app) {
    $app->error(function (Exception $exception): never {
        ini_set('error_reporting', false);
        $logger = new Logger('exceptions', [new Stream(__DIR__ . '/../var/logs/phalcon.log')]);
        $logger->error(Error::messageForLog($exception));

        (new Response())
            ->setStatusCode(match (\get_class($exception)) {
                InvalidArgumentException::class => http::STATUS_BAD_REQUEST,
                RuntimeException::class => http::STATUS_UNPROCESSABLE_ENTITY,
                default => http::STATUS_INTERNAL_SERVER_ERROR
            })
            ->setJsonContent(Error::messageForHttp($exception))
            ->send();

        exit;
    });
};
