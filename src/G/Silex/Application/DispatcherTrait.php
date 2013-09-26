<?php

namespace G\Silex\Application;

trait DispatcherTrait
{
    public function addListener($eventName, $listener, $priority = 0)
    {
        $this['dispatcher']->addListener($eventName, $listener, $priority);
    }
}
