<?php

include __DIR__ . '/../vendor/autoload.php';

use G\LoggerServiceProvider;
use G\Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel;
use Symfony\Component\HttpKernel\Event;

$app = new Application();
$app->register(new LoggerServiceProvider(stream_socket_client('tcp://localhost:4000')));

$app->on(HttpKernel\KernelEvents::REQUEST, function (Event\GetResponseEvent $event) use ($app) {
        $app->getLogger()->info($event->getName());
    }
);

$app->on(HttpKernel\KernelEvents::CONTROLLER, function (Event\FilterControllerEvent $event) use ($app) {
        $app->getLogger()->info($event->getName());
    }
);

$app->on(HttpKernel\KernelEvents::TERMINATE, function (Event\PostResponseEvent $event) use ($app) {
        $app->getLogger()->info($event->getName());
    }
);

$app->on(HttpKernel\KernelEvents::EXCEPTION, function (Event\GetResponseForExceptionEvent $event) use ($app) {
        $app->getLogger()->critical($event->getException()->getMessage());
    }
);

$app->get('/', function () {
    return 'Hello';
});

$app->run();