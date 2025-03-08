<?php

require __DIR__ . '/../vendor/autoload.php';

$skinsMoney = new \SkinsMoney\SkinsMoney('Bearer token');

try {
    $deposit = $skinsMoney->service('SERVICE_ID');
    $createDeposit = $deposit->createDeposit();
    $payment = $createDeposit->setMinValue(12.34) //required
    //optionals
    ->setCurrencyCode('PHP')
        ->setCustom('Custom')
        ->setRedirectUrl('https://google.com')
        ->setTradeUrl('https://steamcommunity.com/...')
        ->setSteamId('STEAMID64')
        ->make();

    echo $payment->getTransactionId() . PHP_EOL;
    echo $payment->getRedirectUrl() . PHP_EOL;
} catch (\SkinsMoney\Exceptions\ValidationException $exception) {
    print_r($exception->getErrors());
}