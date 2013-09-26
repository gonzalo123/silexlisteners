<?php
require __DIR__ . '/../vendor/autoload.php';

use React\EventLoop\Factory;
use React\Socket\Server;

$loop   = Factory::create();
$socket = new Server($loop);

$socket->on('connection', function (\React\Socket\Connection $conn){
    $unique = uniqid();
    $conn->on('data', function ($data) use ($unique) {
            list($message, $context, $level) = \unserialize($data);
            echo date("d/m/Y H:i:s")."::{$level}::{$unique}::{$message}" . PHP_EOL;
        });
});

echo "Socket server listening on port 4000." .PHP_EOL;
echo "You can connect to it by running: telnet localhost 4000" . PHP_EOL;

$socket->listen(4000);
$loop->run();