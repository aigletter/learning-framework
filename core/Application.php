<?php

namespace core;

use core\interfaces\RouterInterface;
use core\interfaces\ViewInterface;

class Application
{
    protected static $instance;

    protected static $components;

    protected $router;

    protected $view;

    public static function setComponents(array $components)
    {
        static::$components = $components;
    }

    public static function getApp()
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    protected function __construct()
    {
        $components = static::$components;
        foreach ($components as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    public function run()
    {
        try {
            $action = $this->router->route();
            if (!$action) {
                throw new \Exception('Not found');
            }
            echo $action();
        } catch (\Throwable $exception) {
            http_response_code(404);
            echo 'Not found';
        }
    }

    public function getView()
    {
        return $this->view;
    }

    public function getRouter()
    {
        return $this->router;
    }
}