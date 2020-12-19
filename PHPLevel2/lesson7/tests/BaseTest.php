<?php

abstract class BaseTest extends \PHPUnit\Framework\TestCase
{
    public static function setUpBeforeClass(): void
    {
        $config = require __DIR__ . '/../config/main.php';

        \MyApp\App::instance()->setConfig($config);
        \MyApp\App::instance()->init();
    }
}
