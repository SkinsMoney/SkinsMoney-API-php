<?php

namespace SkinsMoney;

use SkinsMoney\Adapters\Guzzle;

class SkinsMoney
{
    private Guzzle $guzzle;

    public function __construct(string $bearerToken, ?string $baseUrl = null)
    {
        $this->guzzle = new Guzzle($bearerToken, $baseUrl);
    }

    public function service(string $serviceId): Service
    {
        return new Service($this->guzzle, $serviceId);
    }

    public function currencies(): Currencies
    {
        return new Currencies($this->guzzle);
    }
}