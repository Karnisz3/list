<?php

declare(strict_types=1);

namespace Terminal\Entries;

use Phalcon\Http\ResponseInterface;

class Controller extends \Phalcon\Mvc\Controller
{
    public function getAll(): ResponseInterface
    {
        if (\rand(0, 1) === 1) {
            throw new \Exception('RAND_IS_1');
        } else {
            throw new \InvalidArgumentException('RAND_IS_0');
        }

        return $this->response->setJsonContent(['no' => 'elo, trzymaj']);
    }

    public function createOne(): ResponseInterface
    {
        return $this->response->setJsonContent(['no' => 'elo, zrobione']);
    }
}
