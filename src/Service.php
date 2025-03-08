<?php

/**
 * Created with love by: Patryk Vizauer (wizjoner.dev)
 * Date: 28.03.2023 15:47
 */

namespace SkinsMoney;

use SkinsMoney\Adapters\Guzzle;
use SkinsMoney\Buy\BuyItem;
use SkinsMoney\Deposit\CreateDeposit;
use SkinsMoney\Exceptions\DepositException;

class Service extends Action
{
    public function __construct(Guzzle $guzzle, private string $serviceId)
    {
        parent::__construct($guzzle);
    }

    public function createDeposit(): CreateDeposit
    {
        return new CreateDeposit($this->guzzle, $this->serviceId);
    }

    public function getDepositInfo(string $depositId): object
    {
        $request = $this->guzzle->request('services/' . $this->serviceId . '/deposits/' . $depositId);

        $json = json_decode($request->getBody());
        if ($request->getStatusCode() !== 200) {
            throw new DepositException($json->message, $request->getStatusCode());
        }

        return $json->data;
    }

    public function getItemsForSale(): array
    {
        $request = $this->guzzle->request('services/' . $this->serviceId . '/buys/for-sale');

        $json = json_decode($request->getBody());
        if ($request->getStatusCode() !== 200) {
            throw new DepositException($json->message, $request->getStatusCode());
        }

        return $json->data->items;
    }

    public function buyItem(): BuyItem
    {
        return new BuyItem($this->guzzle, $this->serviceId);
    }

    public function getBuyStatus(string $buyId): object
    {
        $request = $this->guzzle->request('services/' . $this->serviceId . '/buys/' . $buyId);

        $json = json_decode($request->getBody());
        if ($request->getStatusCode() !== 200) {
            throw new DepositException($json->message, $request->getStatusCode());
        }

        return $json->data;
    }
}