<?php

declare(strict_types=1);

namespace Terminal\Entries;

use Phalcon\Http\ResponseInterface;

class Controller extends \Phalcon\Mvc\Controller
{
    public function getAll(): ResponseInterface
    {
        $content = (string)\json_encode(['no' => 'elo, trzymaj']);

        $this->response->setContent($content);
        $this->response->setContentLength(\strlen($content));
        $this->response->setContentType('application/json');

        return $this->response;
    }

    public function createOne(): ResponseInterface
    {
        $content = (string)\json_encode(['no' => 'elo, zrobione']);

        $this->response->setContent($content);
        $this->response->setContentLength(\strlen($content));
        $this->response->setContentType('application/json');

        return $this->response;
    }
}
