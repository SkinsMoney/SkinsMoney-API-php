<?php

/**
 * Created with love by: Patryk Vizauer (wizjoner.dev)
 * Date: 28.03.2023 15:59
 */

require __DIR__ . '/../vendor/autoload.php';

$skinsMoney = new \SkinsMoney\SkinsMoney();

try {
    $deposit = $skinsMoney->service('SERVICE_ID', 'HASH');
    $createDeposit = $deposit->getDepositInfo('DEPOSIT_ID');
    print_r($createDeposit);
} catch (\SkinsMoney\Exceptions\ValidationException $exception) {
    print_r($exception->getErrors());
}