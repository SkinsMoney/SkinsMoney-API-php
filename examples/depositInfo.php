<?php

require __DIR__ . '/../vendor/autoload.php';

$skinsMoney = new \SkinsMoney\SkinsMoney('bearerToken');

try {
    $deposit = $skinsMoney->service('serviceId');
    $createDeposit = $deposit->getDepositInfo('depositId');
    print_r($createDeposit);
} catch (\SkinsMoney\Exceptions\ValidationException $exception) {
    print_r($exception->getErrors());
}