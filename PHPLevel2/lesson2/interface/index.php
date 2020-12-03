<?php

require 'FormatterInterface.php';
require 'Formatter.php';
require 'JSONFormatter.php';
require 'TextFormatter.php';
require 'HTMLFormatter.php';
require 'Factory.php';

$data = [
    'foo' => 'bar',
    'items' => [1, 2, 3],
];

$formatter = Factory::getFormatter(Formatter::TYPE_TEXT);
$formatter->sendHeaders();
$formatter->render($data);
