<?php
use MyApp\App\Config\Formatter;
use OtherLib\Application as OtherApp;
use MyApp\Application as MyApp;

require 'lib/Application.php';
require 'src/Application.php';
require 'src/App/Config/Formatter.php';
require 'src/Helpers/Reader.php';
require 'SimpleClass.php';

$libApp = new OtherApp();
$myApp = new MyApp();

$formatter = new Formatter();
$reader = new \MyApp\Helpers\Reader();

echo \SimpleClass::generatePwd();
