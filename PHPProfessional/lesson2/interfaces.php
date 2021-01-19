<?php
/**
 * Пример реализации нескольких интерфейсов в одном классе
 */

interface GetStringable
{
    public function getStr(): string;
}

interface Debuggable
{
    public function debug(): void;
}

class A implements GetStringable
{
    public function getStr(): string
    {
        return 'Class A';
    }
}

class B implements Debuggable
{
    public function debug(): void
    {
        echo 'Debug B';
    }
}

class C implements GetStringable, Debuggable
{
    public function getStr(): string
    {
        return 'Class C';
    }

    public function debug(): void
    {
        echo 'Debug C';
    }
}

$objects = [
    new A(),
    new B(),
    new C(),
];

foreach ($objects as $object) {
    if ($object instanceof GetStringable) {
        echo $object->getStr(), PHP_EOL;
    }
    if ($object instanceof Debuggable) {
        $object->debug();
        echo PHP_EOL;
    }
}
