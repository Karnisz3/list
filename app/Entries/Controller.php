<?php

declare(strict_types=1);

namespace Terminal\Entries;

use Phalcon\Http\ResponseInterface;

class Controller extends \Phalcon\Mvc\Controller
{
    public function getAll(): ResponseInterface
    {
        throw new \Exception('dlaczego nie ma 500');
        return $this->response->setJsonContent(['no' => 'elo, trzymaj']);
    }

    public function createOne(): ResponseInterface
    {
        return $this->response->setJsonContent(['no' => 'elo, zrobione']);
    }
}
