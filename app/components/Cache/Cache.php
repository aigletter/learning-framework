<?php

namespace app\components\Cache;

use Psr\SimpleCache\CacheInterface;

class Cache implements CacheInterface
{
    protected $filename;

    protected $format;

    public function __construct($filename, $format)
    {
        //$this->filename = ROOT_PATH . '/storage/cache/cache';
        $this->filename = $filename;
        $this->format = $format;
    }

    public function set($key, $value, $ttl = null)
    {
        $data = $this->readFile();
        $data[$key] = $value;
        file_put_contents($this->filename, json_encode($data));
    }

    public function get($key, $default = null)
    {
        $data = $this->readFile();
        return $data[$key] ?? null;
    }

    protected function readFile(): array
    {
        $content = file_get_contents($this->filename) ?: '';
        return $content ? json_decode($content, true) : [];
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
        // TODO: Implement has() method.
    }
}