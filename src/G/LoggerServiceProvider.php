<?php

namespace G;

use Silex\Application;
use Silex\ServiceProviderInterface;

class LoggerServiceProvider implements ServiceProviderInterface
{
    private $socket;

    public function __construct($socket)
    {
        $this->socket = $socket;
    }

    public function register(Application $app)
    {
        $app['remoteLogger'] = $app->share(
            function () use ($app) {
                return new Logger($this->socket);
            }
        );
    }

    public function boot(Application $app)
    {
    }
}