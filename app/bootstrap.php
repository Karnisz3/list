<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;

return function (string $appRoot, string $env = 'dev') {
    if (!\in_array($env, ['dev', 'test', 'prod'])) {
        throw new RuntimeException('Bad env: ' . $env);
    }

    $container = (new ContainerBuilder())
        ->useAutowiring(true)
        ->useAnnotations(false)
        ->addDefinitions([
            \Terminal\Entries\Domain\QueryRepository::class => \DI\get(\Terminal\Entries\Infrastructure\Repositories\InMemoryQueryRepository::class),
            \Terminal\Engine\ResponseEncoding\Encoder::class => \DI\get(\Terminal\Engine\ResponseEncoding\Json::class)
        ]);

    if ($env === 'prod') {
        $container->enableCompilation($appRoot . '/var/container');
    }

    return AppFactory::createFromContainer($container->build());
};
