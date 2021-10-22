<?php

use App\Bootstrap;

if ( ! file_exists(__DIR__ . '/vendor/autoload.php'))
    throw new Exception("Autoload file not found.");

require __DIR__ . '/vendor/autoload.php';

$config = require_once __DIR__ . '/config/ioc.php';

foreach ((array)$config['bindings'] as $contract => $abstract) {
    $iocContainer->bind($contract, $abstract);
}

$json = file_get_contents('./request-data.json');
$data = json_decode($json, 1);

$jsonIterator = new RecursiveIteratorIterator(
    new RecursiveArrayIterator(json_decode($json, TRUE)),
    RecursiveIteratorIterator::SELF_FIRST);

echo $iocContainer->make(Bootstrap::class)->boot($data);