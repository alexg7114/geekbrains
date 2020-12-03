<?php
//Привер имплементации нескольких интерфейсов

interface Stringable
{
    public function getString();
}

interface Debuggable
{
    public function debug();
}

class A implements Stringable
{
    public function getString()
    {
        return 'getString from A';
    }
}

class B implements Debuggable
{
    public function debug()
    {
        return 'debug from B';
    }
}

class C implements Stringable, Debuggable
{
    public function getString()
    {
        return 'getString from C';
    }

    public function debug()
    {
        return 'debug from C';
    }
}

$objects = [
    new A(),
    new B(),
    new C(),
];

foreach ($objects as $obj) {
    if ($obj instanceof Stringable) {
        echo $obj->getString(), "\n";
    }
    if ($obj instanceof Debuggable) {
        echo $obj->debug(), "\n";
    }
}
