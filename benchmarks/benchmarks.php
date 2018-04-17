<?php
require './vendor/autoload.php';

use Symfony\Component\Stopwatch\Stopwatch;
use NoProtocol\Encryption\MySQL\AES\Crypter;

set_time_limit(0);

$crypter = new Crypter('mySuperDuperSecretKey');
$stopwatch = new Stopwatch();

$amount = 10000;
if (isset($argv[1]) && is_numeric($argv[1])) {
    $amount = $argv[1];
}

echo sprintf('Running benchmark with %s items...', $amount) . PHP_EOL;

$stopwatch->start('encrypt');

for ($i = 0; $i < $amount; $i++ ) {
    $encrypted = $crypter->encrypt(uniqid('', true));
    $decrypted = $crypter->decrypt($encrypted);
}

$event = $stopwatch->stop('encrypt');

echo sprintf('%s items in %s seconds (%s ms), max. memory usage %sKB (%sB)', $amount, $event->getDuration()/1000, $event->getDuration(), $event->getMemory()/1024, $event->getMemory()) . PHP_EOL;