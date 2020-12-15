<?php

namespace MyApp;

use MyApp\Controllers\IndexController;

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
        $this->db = new DB($this->config['db']);

        // '/users/list/123/?foo=bar' => ['/users/list/123/', 'foo=bar']
        [$uri] = explode('?', $_SERVER['REQUEST_URI']);
        //'/users/list/123/' => 'users/list/123' => ['users', 'list', '123']
        [$controllerName, $actionName, $param] = explode('/', trim($uri, '/'));

        if (empty($controllerName)) {
            $controllerName = 'index';
        }
        if (empty($actionName)) {
            $actionName = 'index';
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
                $controller->$actionMethod($param);
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
