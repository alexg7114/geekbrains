<?php

namespace MyApp;

class Router
{
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function parse($url)
    {
        $url = self::filter($url);

        foreach ($this->config as $pt => $route) {
            $pattern = '/' . $pt . '/u';
            if (!preg_match($pattern, $url, $matched)) {
                continue;
            }

            [$controller, $action] = explode('/', $route);
            array_shift($matched);
            if ($controller === '<controller>') {
                $controller = array_shift($matched);
            }
            if ($action === '<action>') {
                $action = array_shift($matched);
            }

            return [$controller, $action, $matched];
        }

        return false;
    }

    public static function getURI()
    {
        $url = $_GET['path'] ?? $_SERVER['REQUEST_URI'];
        [$uri] = explode('?', $url);
        return $uri;
    }

    public static function filter($url)
    {
        // /sdfg///dfgdf/
        $parts = explode('/', $url);
        // '', 'sdfg', '', '', '', 'dfgdf', ''
        foreach ($parts as $k => $v) {
            if ('' === $v) {
                unset($parts[$k]);
            }
        }
        // 'sdfg', 'dfgdf'
        return implode('/', $parts); // => 'sdfg/dfgdf
    }
}
