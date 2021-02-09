<?php

require 'vendor/autoload.php';

$mem = \MyApp\Cache::getInstance();

$key = 'foobar3';

print_r($mem->get($key, 'it is default'));

$val = new \stdClass();
$val->foo = 'aaa';
$val->bar = 'bbb';

$mem->set($key, $val);
$mem->delete($key);
