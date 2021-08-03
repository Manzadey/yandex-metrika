<?php

namespace Manzadey\YandexMetrika;

use Psr\Http\Message\ResponseInterface;

class Response
{
    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    private $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getResponse() : ResponseInterface
    {
        return $this->response;
    }

    public function toArray() : array
    {
        return json_decode($this->getBody(), true);
    }

    public function getBody() : string
    {
        return $this->response->getBody();
    }
}