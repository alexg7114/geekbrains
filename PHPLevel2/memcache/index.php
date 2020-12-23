<?php

require 'vendor/autoload.php';

$cache = new \App\Cache();

$data = new stdClass();
$data->foo = 'bar';
$data->baz = 'xyz';

//$cache->set('mykey3', $data);

print_r($cache->get('mykey3'));