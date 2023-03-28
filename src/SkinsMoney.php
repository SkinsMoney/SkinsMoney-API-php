<?php

/**
 * Created with love by: Patryk Vizauer (wizjoner.dev)
 * Date: 28.03.2023 15:37
 */

namespace SkinsMoney;

use SkinsMoney\Adapters\Guzzle;

class SkinsMoney
{
    private Guzzle $guzzle;

    public function __construct(?string $baseUrl = null)
    {
        $this->guzzle = new Guzzle($baseUrl);
    }

    public function service(string $serviceId, string $hash): Service
    {
        return new Service($this->guzzle, $serviceId, $hash);
    }

    public function currencies(): Currencies
    {
        return new Currencies($this->guzzle);
    }
}