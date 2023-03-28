<?php

/**
 * Created with love by: Patryk Vizauer (wizjoner.dev)
 * Date: 28.03.2023 15:47
 */

namespace SkinsMoney;

use SkinsMoney\Adapters\Guzzle;
use SkinsMoney\Deposit\CreateDeposit;
use SkinsMoney\Exceptions\DepositException;
use SkinsMoney\Exceptions\SkinsMoneyException;

class Service extends Action
{
    public function __construct(Guzzle $guzzle, private string $serviceId, private string $hash)
    {
        parent::__construct($guzzle);
    }

    public function createDeposit(): CreateDeposit
    {
        return new CreateDeposit($this->guzzle, $this->serviceId, $this->hash);
    }

    public function getDepositInfo(string $depositId): object
    {
        $request = $this->guzzle->request('deposits/' . $depositId, [
            'query' => [
                'signature' => hash('sha256', $depositId . '|' . $this->serviceId . '|' . $this->hash),
            ],
        ]);

        $json = json_decode($request->getBody());
        if ($request->getStatusCode() != 200) {
            throw new DepositException($json->message, $request->getStatusCode());
        }

        return $json->data;
    }

    public function getWithdrawValue(): float
    {
        $request = $this->guzzle->request('services/' . $this->serviceId . '/withdraw', [
            'query' => [
                'signature' => hash('sha256', $this->serviceId . '|' . $this->hash),
            ],
        ]);

        $json = json_decode($request->getBody());
        if ($request->getStatusCode() != 200) {
            throw new SkinsMoneyException($json->message, $request->getStatusCode());
        }

        return $json->data->usd_value;
    }
}