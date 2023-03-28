<?php

/**
 * Created with love by: Patryk Vizauer (wizjoner.dev)
 * Date: 28.03.2023 15:59
 */

require __DIR__ . '/../vendor/autoload.php';

$skinsMoney = new \SkinsMoney\SkinsMoney();

$deposit = $skinsMoney->service('SERVICE_ID', 'HASH');
$value = $deposit->getWithdrawValue();
print_r($value);
