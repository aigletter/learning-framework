<?php

namespace core\components\Routing;

use core\interfaces\RouterInterface;

class Router implements RouterInterface
{
    public function route(): callable
    {
        $current = $_SERVER['REQUEST_URI'];
        $path = parse_url($current, PHP_URL_PATH);
        $segments = explode('/', trim($path, '/'));
        $controllerClass = 'app\\controllers\\' . ucfirst($segments[0]);
        if (class_exists($controllerClass)) {
            $controller = new $controllerClass();
            $actionName = $segments[1];
            if (method_exists($controller, $actionName)) {
                return [$controller, $actionName];
            }
        }

        throw new \Exception('Not found');
    }
}