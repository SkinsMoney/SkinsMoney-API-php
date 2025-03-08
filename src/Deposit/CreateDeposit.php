<?php

/**
 * Created with love by: Patryk Vizauer (wizjoner.dev)
 * Date: 28.03.2023 16:08
 */

namespace SkinsMoney\Deposit;

use SkinsMoney\Action;
use SkinsMoney\Adapters\Guzzle;
use SkinsMoney\Exceptions\DepositException;
use SkinsMoney\Responses\DepositCreatedResponse;

class CreateDeposit extends Action
{
    private float $minValue;
    private string $currencyCode = 'USD';
    private string $custom;
    private string $redirectUrl;
    private string $tradeUrl;
    private string $steamId;

    public function __construct(Guzzle $guzzle, private string $serviceId)
    {
        parent::__construct($guzzle);
    }

    public function setMinValue(float $minValue): CreateDeposit
    {
        $this->minValue = $minValue;
        return $this;
    }

    public function setCurrencyCode(string $currencyCode): CreateDeposit
    {
        $this->currencyCode = $currencyCode;
        return $this;
    }

    public function setCustom(string $custom): CreateDeposit
    {
        $this->custom = $custom;
        return $this;
    }

    public function setRedirectUrl(string $redirectUrl): CreateDeposit
    {
        $this->redirectUrl = $redirectUrl;
        return $this;
    }

    public function setTradeUrl(string $tradeUrl): CreateDeposit
    {
        $this->tradeUrl = $tradeUrl;
        return $this;
    }

    public function setSteamId(string $steamId): CreateDeposit
    {
        $this->steamId = $steamId;
        return $this;
    }

    public function make()
    {
        $payload = [
            'minValue' => sprintf('%.2f', $this->minValue),
        ];

        if (isset($this->currencyCode)) {
            $payload['currencyCode'] = $this->currencyCode;
        }

        if (isset($this->custom)) {
            $payload['custom'] = $this->custom;
        }

        if (isset($this->redirectUrl)) {
            $payload['redirectUrl'] = $this->redirectUrl;
        }

        if (isset($this->tradeUrl)) {
            $payload['tradeUrl'] = $this->tradeUrl;
        }

        if (isset($this->steamId)) {
            $payload['steamId'] = $this->steamId;
        }

        if (!$request = $this->guzzle->request('services/' . $this->serviceId . '/deposits', [
            'json' => $payload,
        ], 'POST')) {
            return false;
        }

        $json = json_decode($request->getBody());
        if ($request->getStatusCode() != 201) {
            throw new DepositException($json->message, $request->getStatusCode());
        }

        return new DepositCreatedResponse($json);
    }
}