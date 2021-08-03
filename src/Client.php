<?php

namespace Manzadey\YandexMetrika;

use GuzzleHttp\Client as GuzzleClient;
use Psr\Http\Message\ResponseInterface;

class Client
{
    private $url = 'https://api-metrika.yandex.net';

    /**
     * @var string[]
     */
    private $data = [];

    /**
     * @var string
     */
    private $oauth;

    /**
     * @var \GuzzleHttp\Client
     */
    private $guzzleClient;

    public function __construct(string $ids, string $oauth)
    {
        $this->data['ids']  = $ids;
        $this->oauth        = $oauth;
        $this->guzzleClient = $this->makeClient();
    }

    private function makeClient() : GuzzleClient
    {
        $this->guzzleClient = new GuzzleClient([
            'base_uri' => $this->getUrl(),
            'headers'  => [
                'Authorization' => 'OAuth ' . $this->oauth,
            ],
        ]);

        return $this->guzzleClient;
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request(string $uri, array $data) : ResponseInterface
    {
        return $this->guzzleClient->get($uri, ['query' => array_merge($data, $this->data)]);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $uri, array $data) : Response
    {
        return new Response($this->request($uri, $data));
    }

    /**
     * @return string
     */
    public function getUrl() : string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url) : void
    {
        $this->url = $url;
    }
}