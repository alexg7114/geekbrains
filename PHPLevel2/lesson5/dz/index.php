<?php

require 'vendor/autoload.php';
require 'DB.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

//По сколько товаров загружать за раз
$loadSize = 7;

//Если передали get-праметр from - загружаем и рендерим один блок
if (isset($_GET['from'])) {
    $goods = DB::getInstance()->getTableDataPart(DB::TABLE_GOODS, $_GET['from'], $loadSize);
    $count = DB::getInstance()->getTableDataCount(DB::TABLE_GOODS);
    $last = end($goods);

    $hide = false;
    //Если id последнего полученного товара >= количеству -> hide=true
    if ($last['id'] >= $count) {
        $hide = true;
    }

    echo $twig->render('goods.twig', [
        'items' => $goods,
        'hide' => $hide,
    ]);
    exit;
}

echo $twig->render('index.twig', [
    'loadSize' => $loadSize,
]);