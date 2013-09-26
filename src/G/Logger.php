<?php

namespace G;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class Logger implements LoggerInterface
{
    private $socket;

    public function __construct($socket)
    {
        $this->socket = $socket;
    }

    function __destruct()
    {
        @fclose($this->socket);
    }

    public function emergency($message, array $context = array())
    {
        $this->sendLog($message, $context, LogLevel::EMERGENCY);
    }

    public function alert($message, array $context = array())
    {
        $this->sendLog($message, $context, LogLevel::ALERT);
    }

    public function critical($message, array $context = array())
    {
        $this->sendLog($message, $context, LogLevel::CRITICAL);
    }

    public function error($message, array $context = array())
    {
        $this->sendLog($message, $context, LogLevel::ERROR);
    }

    public function warning($message, array $context = array())
    {
        $this->sendLog($message, $context, LogLevel::WARNING);
    }

    public function notice($message, array $context = array())
    {
        $this->sendLog($message, $context, LogLevel::NOTICE);
    }

    public function info($message, array $context = array())
    {
        $this->sendLog($message, $context, LogLevel::INFO);
    }

    public function debug($message, array $context = array())
    {
        $this->sendLog($message, $context, LogLevel::DEBUG);
    }

    public function log($level, $message, array $context = array())
    {
        $this->sendLog($message, $context, $level);
    }

    private function sendLog($message, array $context = array(), $level = LogLevel::INFO)
    {
        $data = serialize([$message, $context, $level]);
        @fwrite($this->socket, "{$data}\n");
    }
}