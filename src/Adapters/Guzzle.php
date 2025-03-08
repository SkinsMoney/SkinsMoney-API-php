<?php

/**
 * Created with love by: Patryk Vizauer (wizjoner.dev)
 * Date: 28.03.2023 15:49
 */

namespace SkinsMoney\Adapters;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use SkinsMoney\Exceptions\ValidationException;

class Guzzle
{
    private Client $client;

    private int $errorCode;
    private string $error;

    public function __construct(string $bearerToken, ?string $baseUrl = null)
    {
        if (!$baseUrl) {
            $baseUrl = 'https://api.skinsmoney.gg/v1/';
        }

        $this->client = new Client([
            'http_errors' => false,
            'base_uri' => $baseUrl,
            'headers' => [
                'Authorization' => 'Bearer ' . $bearerToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function request(string $uri, array $data = [], string $method = 'GET'): ResponseInterface|false
    {
        try {
            $request = $this->client->request($method, $uri, $data);

            if ($request->getStatusCode() == 422) {
                $payload = json_decode($request->getBody());
                throw new ValidationException($payload->data);
            }

            return $request;
        } catch (GuzzleException $exception) {
            $this->error = $exception->getMessage();
            $this->errorCode = $exception->getCode();

            return false;
        }
    }

    public function errorCode(): int
    {
        return $this->errorCode;
    }

    public function error(): string
    {
        return $this->error;
    }
}