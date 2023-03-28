<?php

/**
 * Created with love by: Patryk Vizauer (wizjoner.dev)
 * Date: 28.03.2023 16:21
 */

namespace SkinsMoney\Responses;

class DepositCreatedResponse
{
    private ?string $transactionId = null;
    private ?string $redirectUrl = null;

    public function __construct(object $payload)
    {
        $this->transactionId = $payload->data->id;
        $this->redirectUrl = $payload->data->url;
    }

    public function getTransactionId(): ?string
    {
        return $this->transactionId;
    }

    public function getRedirectUrl(): ?string
    {
        return $this->redirectUrl;
    }
}