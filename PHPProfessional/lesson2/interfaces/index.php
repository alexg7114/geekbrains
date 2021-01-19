<?php

require 'FormatterInterface.php';
require 'Factory.php';
require 'Formatter.php';
require 'HTMLFormatter.php';
require 'JSONFormatter.php';
require 'TextFormatter.php';

$data = [
    'foo' => 'bar',
    'array' => [1, 2, 3],
];

if (true) {
    $fmt = Factory::getFormatter(Factory::TYPE_TEXT);
} else {
    $fmt = Factory::getFormatter(Factory::TYPE_JSON);
}

$fmt->sendHeaders();
$fmt->render($data);
