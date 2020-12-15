<?php

namespace MyApp;

class Router
{
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function route($url)
    {
        $url = self::filter($url);

        foreach ($this->config as $pattern => $route) {
            $matches = [];
            if (preg_match('/' . $pattern . '/u', $url, $matches)) {
                array_shift($matches);
                [$controller, $action] = explode('/', $route);
                if ($controller === '<controller>') {
                    $controller = array_shift($matches);
                }
                if ($action === '<action>') {
                    $action = array_shift($matches);
                }

                return [$controller, $action, $matches];
            }
        }

        return null;
    }

    private static function filter($url)
    {
        $parts = explode('/', $url);

        foreach ($parts as $k => $p) {
            if ('' === $p) unset($parts[$k]);
        }

        return implode('/', $parts);
    }
}
