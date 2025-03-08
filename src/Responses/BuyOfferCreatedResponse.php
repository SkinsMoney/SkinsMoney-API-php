<?php

namespace SkinsMoney\Responses;

class BuyOfferCreatedResponse
{
    private string $buyId;
    private float $buyPrice;
    private string $steamOfferId;

    public function __construct(object $payload)
    {
        $this->buyId = $payload->data->buyId;
        $this->buyPrice = $payload->data->buyPrice;
        $this->steamOfferId = $payload->data->steamOfferId;
    }

    public function getBuyId(): string
    {
        return $this->buyId;
    }

    public function getBuyPrice(): float
    {
        return $this->buyPrice;
    }

    public function getSteamOfferId(): string
    {
        return $this->steamOfferId;
    }
}