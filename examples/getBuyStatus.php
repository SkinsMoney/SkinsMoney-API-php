<?php

require __DIR__ . '/../vendor/autoload.php';

$skinsMoney = new \SkinsMoney\SkinsMoney('bearerToken');

try {
    $service = $skinsMoney->service('serviceId');
    $item = $service->getBuyStatus('buyId');
    print_r($item);
} catch (\SkinsMoney\Exceptions\ValidationException $exception) {
    print_r($exception->getErrors());
}