<?php

require 'vendor/autoload.php';

try {
    $loader = new \Twig\Loader\FilesystemLoader('templates');
} catch (Exception $e) {
    echo "Couldn't load templates";
    exit;
}
$twig = new \Twig\Environment($loader);

$number = random_int(0, 20);
$users = [
    [
        'name' => 'Sergey',
        'balance' => 500,
    ],
    [
        'name' => 'Olga',
        'balance' => 1500,
    ],
    [
        'name' => 'Dima',
        'balance' => 123,
    ],
];

try {
    echo $twig->render('index.twig', [
        'username' => 'Admin',
        'password' => 'qwe123',
        'number' => $number,
        'divResult' => $number % 2,
        'month' => date('n'),
        'items' => [
            'Съешь же еше',
            'этих французских булок',
            'да выпей чаю',
        ],
        'book' => [
            'title' => 'Преступление и наказание',
            'author' => 'Достоевский',
            'pages' => 500,
        ],
        'users' => $users,
        'html' => '<b>Bold text</b>'
    ]);
} catch (\Twig\Error\LoaderError $e) {
    echo get_class($e) . ': ' . $e->getMessage();
}
