<?php


namespace App\Utils;


use GuzzleHttp\Client;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;

class ApiClient
{

    protected $client;

    public function __construct () {
        $handler = HandlerStack::create();
        $this->client = new Client([
            'base_uri' => env('BASE_URL'),
            'headers' => [
                'Accept'        => 'application/json',
                'Authorization' => 'Bearer ' . (string) session()->get('bearer_token') ?? null,
                'Content-Type' => 'application/json',
                'http_errors' => false
            ]
        ]);
    }

    public function getClient () {
        return $this->client;
    }
}
