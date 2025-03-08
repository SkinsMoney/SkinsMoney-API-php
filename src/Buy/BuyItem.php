<?php

/**
 * Created with love by: Patryk Vizauer (wizjoner.dev)
 * Date: 28.03.2023 16:08
 */

namespace SkinsMoney\Buy;

use SkinsMoney\Action;
use SkinsMoney\Adapters\Guzzle;
use SkinsMoney\Exceptions\SkinsMoneyException;
use SkinsMoney\Responses\BuyOfferCreatedResponse;

class BuyItem extends Action
{
    private float $maxPrice;
    private int $itemId;
    private string $tradeUrl;

    public function __construct(Guzzle $guzzle, private string $serviceId)
    {
        parent::__construct($guzzle);
    }

    public function setMaxPrice(float $maxPrice): BuyItem
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }

    public function setItemId(int $itemId): BuyItem
    {
        $this->itemId = $itemId;
        return $this;
    }

    public function setTradeUrl(string $tradeUrl): BuyItem
    {
        $this->tradeUrl = $tradeUrl;
        return $this;
    }

    public function make(): BuyOfferCreatedResponse
    {
        $payload = [
            'itemId' => $this->itemId,
            'maxPrice' => $this->maxPrice,
            'tradeUrl' => $this->tradeUrl,
        ];

        if (!$request = $this->guzzle->request('services/' . $this->serviceId . '/buys', [
            'json' => $payload,
        ], 'POST')) {
            return false;
        }

        $json = json_decode($request->getBody());
        if ($request->getStatusCode() !== 200) {
            throw new SkinsMoneyException($json->message, $request->getStatusCode());
        }

        return new BuyOfferCreatedResponse($json);
    }
}