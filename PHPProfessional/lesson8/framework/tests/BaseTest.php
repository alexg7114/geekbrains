<?php

use MyApp\App;

abstract class BaseTest extends \PHPUnit\Framework\TestCase
{
    public static function setUpBeforeClass(): void
    {
        App::getInstance()
            ->setConfig(require __DIR__ . '/../config/main.php')
            ->init();
    }
}