<?php

require __DIR__ . '/../vendor/autoload.php';

$skinsMoney = new \SkinsMoney\SkinsMoney('Bearer token');
$currencies = $skinsMoney->currencies()->get();
print_r($currencies);