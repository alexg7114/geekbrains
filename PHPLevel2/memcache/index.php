<?php

require 'vendor/autoload.php';

$cache = new \App\Cache();

echo $cache->check(), PHP_EOL;

$data = new stdClass();
$data->foo = 'bar';
$data->baz = 'xyz';

//$cache->set('data_key', $data);

var_dump($cache->get('data_key'));