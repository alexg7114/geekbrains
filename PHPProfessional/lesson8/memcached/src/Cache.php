<?php

namespace MyApp;

use Psr\SimpleCache\CacheInterface;

class Cache implements CacheInterface
{
    private $memcache;
    private static $instance;

    private function __construct()
    {
        $this->memcache = new \Memcache;
        $this->memcache->connect('localhost', 11211) or die ("Не могу подключиться");
    }

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function get($key, $default = null)
    {
        $val = $this->memcache->get($key);

        return $val === false ? $default : $val;
    }

    public function set($key, $value, $ttl = null)
    {
        $this->memcache->set($key, $value, null, $ttl);
    }

    public function delete($key)
    {
        $this->memcache->delete($key);
    }

    public function clear()
    {
        $this->memcache->flush();
    }

    public function getMultiple($keys, $default = null)
    {
        // TODO: Implement getMultiple() method.
    }

    public function setMultiple($values, $ttl = null)
    {
        // TODO: Implement setMultiple() method.
    }

    public function deleteMultiple($keys)
    {
        // TODO: Implement deleteMultiple() method.
    }

    public function has($key)
    {
        return $this->get($key) !== null;
    }
}
