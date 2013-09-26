<?php

namespace G\Silex;

use G\Silex\Application\DispatcherTrait;
use G\Silex\Application\LoggerTrait;

class Application extends \Silex\Application
{
    use DispatcherTrait;
    use LoggerTrait;
}