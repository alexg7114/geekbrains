<?php

namespace MyApp\Controllers;

use MyApp\App;
use MyApp\Auth;
use MyApp\Models\History;

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
        if ($user = Auth::getUser()) {
            History::store($user['id'], $_SERVER['REQUEST_URI']);
        }

        return true;
    }

    public function afterAction()
    {
    }

    protected function render($name, $data = [])
    {
        echo $this->twig->render($name, $data);
    }

    protected function redirect($url)
    {
        header('Location: ' . $url);
        exit;
    }
}
