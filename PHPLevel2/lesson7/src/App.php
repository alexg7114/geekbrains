<?php

namespace MyApp;

use MyApp\Controllers\IndexController;
use MyApp\Models\History;

class App
{
    private static $instance;
    private $config;

    private $db;

    public static function instance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getDb(): DB
    {
        return $this->db;
    }

    public function run()
    {
        session_start();

        $this->db = new DB($this->config['db']);

        if ($user = Auth::getUser()) {
            History::add($user['id'], Router::getURI());
        }

        // '/users/list/123/?foo=bar' => ['/users/list/123/', 'foo=bar']
        //[$uri] = explode('?', $_SERVER['REQUEST_URI']);
        //'/users/list/123/' => 'users/list/123' => ['users', 'list', '123']
        //[$controllerName, $actionName, $param] = explode('/', trim($uri, '/'));
        $uri = Router::getURI();

        $router = new Router(App::instance()->getConfig()['routing']);
        if (false === $rout = $router->parse($uri)) {
            $controllerName = 'index';
            $actionName = 'error';
            $params = [];
        } else {
            [$controllerName, $actionName, $params] = $rout;
        }

        // 'example' => MyApp\Controllers\ExampleController
        $controllerClass = 'MyApp\Controllers\\' . ucfirst($controllerName) . 'Controller';
        // 'example' => 'actionExample'
        $actionMethod = 'action' . ucfirst($actionName);

        // Проверяем - существует ли такой класс => создам объект контроллера
        if (class_exists($controllerClass)) {
            $controller = new $controllerClass;
            // Проверяем - существует ли в контроллере такой action-метод => вызываем его
            if (method_exists($controller, $actionMethod)) {
                if ($controller->beforeAction()) {
                    $controller->$actionMethod($params);
                }
                $controller->afterAction();
                return;
            }
        }

        // Если не нашли контроллер или action - отображаем ошибку
        (new IndexController())->actionError();
    }

    public function setConfig($config): void
    {
        $this->config = $config;
    }

    public function getConfig()
    {
        return $this->config;
    }
}
