<?php

class Storage
{
    private $data = [];

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        return $this->data[$name];
    }

    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    public function getProperties()
    {
        return $this->data;
    }

    public function __toString()
    {
        return print_r($this->data, true);
    }
}

$st = new Storage();
$st->id = 'bar';
$st->name = 123123;
$st->cout = 'y';

print_r($st->getProperties());
echo $st;
