<?php

class Logger
{
    private static $instance;
    private $handle;

    private function __wakeup()
    {
    }

    private function __clone()
    {
    }

    public static function createLogger()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
        $this->handle = fopen('log.txt', 'w');
    }

    public function log(string $text)
    {
        fwrite($this->handle, $text . "\n");
    }
}

$logger = Logger::createLogger();

$logger->log('Foo');
$logger->log('Bar');

function test()
{
    $logger = Logger::createLogger();
    $logger->log('test');
}

test();

echo 'now see log.txt';
