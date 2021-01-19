<?php
/**
 * Магические методы
 */

class Storage
{
    public $feature = 123123;
    private $data = [];

    public function getFeature()
    {
        return $this->feature;
    }

    public function __set($name, $value)
    {
        echo 'Set ' . $name . ' = ' . $value, PHP_EOL;
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        echo 'Accessed ' . $name, PHP_EOL;
        return $this->data[$name];
    }

    public function __isset($name)
    {
        echo 'Isset ' . $name, PHP_EOL;
        return isset($this->data[$name]);
    }

    public function __toString()
    {
        return $this->debug();
    }

    private function debug()
    {
        return print_r($this->data, true);
    }

    private function __clone()
    {
        echo 'Cloned!';
    }

    private function __wakeup()
    {
        echo 'wakeup';
    }
}

$storage = new Storage();

//Клонирование мы запретили
//$st2 = clone $storage;

//Десериализацию мы запретили
$ser = serialize($storage);
//$st2 = unserialize($ser);
//print_r($st2);

$storage->feature = 'sadfsdfs';
$storage->foo = '123';
$storage->bar = 'xyz';

print_r([
    isset($storage->feature),
    isset($storage->foo),
    isset($storage->qwe),
]);

echo $storage->feature, PHP_EOL;
echo $storage->foo, PHP_EOL;
echo $storage->bar, PHP_EOL;

echo $storage;
