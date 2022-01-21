<?php

namespace core\components\Cache;

use Psr\SimpleCache\CacheInterface;

class Cache implements CacheInterface
{
    protected $data = [];

    public function get($key, $default = null)
    {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }

        return null;
    }

    public function set($key, $value, $ttl = null)
    {
        $this->data[$key] = $value;
    }

    public function delete($key)
    {
        // TODO: Implement delete() method.
    }

    public function clear()
    {
        // TODO: Implement clear() method.
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
        return array_key_exists($key, $this->data);
    }
}