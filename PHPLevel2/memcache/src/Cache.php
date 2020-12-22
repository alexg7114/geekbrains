<?php

namespace App;

use Psr\SimpleCache\CacheInterface;

class Cache implements CacheInterface
{
    private $memcache;

    public function __construct()
    {
        $this->memcache = new \Memcache();
        $this->memcache->connect('localhost', 11211);
    }

    public function check()
    {
        return $this->memcache->getVersion();
    }

    public function get($key, $default = null)
    {
        return $this->memcache->get($key) ?: $default;
    }

    public function set($key, $value, $ttl = null)
    {
        return $this->memcache->set($key, $value);
    }

    public function delete($key)
    {
        $this->memcache->delete($key);
    }

    public function clear()
    {
        $this->memcache->flush();
    }

    public function has($key)
    {
        return null !== $this->get($key);
    }

    public function getMultiple($keys, $default = null)
    {}

    public function setMultiple($values, $ttl = null)
    {}

    public function deleteMultiple($keys)
    {}
}
