<?php


require __DIR__ . '/../vendor/autoload.php';

$skinsMoney = new \SkinsMoney\SkinsMoney('bearerToken');

try {
    $service = $skinsMoney->service('serviceId');
    $item = $service->buyItem()
        ->setItemId(123321)
        ->setMaxPrice(0.15)
        ->setTradeUrl('https://steamcommunity.com/tradeoffer/new/?partner=...&token=...')
        ->make();
    print_r($item);
} catch (\SkinsMoney\Exceptions\ValidationException $exception) {
    print_r($exception->getErrors());
}