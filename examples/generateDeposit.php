<?php

/**
 * Created with love by: Patryk Vizauer (wizjoner.dev)
 * Date: 28.03.2023 15:59
 */

require __DIR__ . '/../vendor/autoload.php';

$skinsMoney = new \SkinsMoney\SkinsMoney();

try {
    $deposit = $skinsMoney->service('SERVICE_ID', 'HASH');
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