<?php

require __DIR__ . '/../vendor/autoload.php';

$skinsMoney = new \SkinsMoney\SkinsMoney('bearerToken');

try {
    $service = $skinsMoney->service('serviceId');
    $items = $service->getItemsForSale();
    print_r($items);
} catch (\SkinsMoney\Exceptions\ValidationException $exception) {
    print_r($exception->getErrors());
}