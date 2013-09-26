<?php

namespace G\Silex\Application;

trait LoggerTrait
{
    /**  @return \G\Logger */
    public function getLogger()
    {
        return $this['remoteLogger'];
    }
}