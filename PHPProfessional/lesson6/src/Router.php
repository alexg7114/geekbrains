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
            if (!preg_match($pattern, $url, $matches)) {
                continue;
            }

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

        return false;
    }

    private static function filter(string $url): string
    {
        // '//catalog///234/245///' => ['','','catalog','','','234','245','','','']
        $parts = explode('/', $url);

        // => ['catalog','234','245']
        foreach ($parts as $k => $v) {
            if ('' === $v) {
                unset($parts[$k]);
            }
        }

        // => 'catalog/234/245'
        return implode('/', $parts);
    }
}
