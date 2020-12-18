<?php

namespace MyApp\Controllers;

use MyApp\App;
use MyApp\Auth;

abstract class Controller
{
    private $twig;

    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader(App::instance()->getConfig()['templates']);
        $this->twig = new \Twig\Environment($loader);
    }

    public function beforeAction()
    {
        return true;
    }

    public function afterAction()
    {
    }

    protected function render($name, $data = [])
    {
        $data['_user'] = Auth::getUser();
        $data['_basket'] = Auth::getBasket();

        echo $this->twig->render($name, $data);
    }

    protected function redirect($url)
    {
        header('Location: ' . $url);
        exit;
    }
}
