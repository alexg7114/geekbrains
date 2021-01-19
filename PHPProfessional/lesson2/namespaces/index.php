<?php

use MyApp\App\Config\Formatter;
//Использование алиасов
use Application as libApplication;
use GeekBrains\Application as gbApplication;

require 'lib\Application.php';
require 'Application.php';
require 'src\App.php';
require 'src\App\Config\Formatter.php';
require 'src\App\Config\Generator.php';
require 'src\Helpers\Formatter.php';
require 'src\Helpers\Reader.php';

//Обращение по алиасам
$libApp = new libApplication();
$gbApp = new gbApplication();

//Обращение по полному пути
$libApp = new Application(); //Application папке lib - класс без namespace
$gbApp = new \GeekBrains\Application();

//Обращение к MyApp\App\Config\Formatter (описано в первом use вверху файла)
$formatter = new Formatter();
//Или по полному пути
$formatter = new \MyApp\App\Config\Formatter();
