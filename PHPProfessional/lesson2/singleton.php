<?php
/**
 * Пример реализации синглтона
 */

final class Logger
{
    private static $instance;
    private $handle;

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct()
    {
        $this->handle = fopen('log.txt', 'w');
    }

    public function log(string $text): void
    {
        fwrite($this->handle, $text . PHP_EOL);
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}

//Наследование мы запретили (класс final)
/*class Logger2 extends Logger {
    public function __construct()
    {
    }
}

//Создание через new мы запретили
$l = new Logger2();*/

$logger = Logger::getInstance();

$logger->log('foo');
$logger->log('Bar');

function test()
{
    Logger::getInstance()->log('from function2');
}

test();

echo 'ok';
