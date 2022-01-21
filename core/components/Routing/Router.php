<?php

namespace core\components\Routing;

use core\interfaces\RouterInterface;

class Router implements RouterInterface
{
    /**
     * Определяем путь запроса, контролер и действие (метод контроллера)
     * Возвращает замыкание, которое кто-то где-то когда-то потом может вызвать
     * @return callable
     * @throws BadRequestException
     * @throws NotFoundException
     */
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
                $params = $this->resolveParameters($controller, $actionName);
                return function () use ($controller, $actionName, $params) {
                    return call_user_func_array([$controller, $actionName], $params);
                };
            }
        }

        throw new NotFoundException();
    }

    /**
     * Определяет какие GET параметры из запроса нужно пробросит методу контроллера
     * Это не самое лучшее место для данного метода, позже перенесем в другой класс
     * @param object $controller
     * @param string $method
     * @return array
     * @throws BadRequestException
     * @throws \ReflectionException
     */
    protected function resolveParameters(object $controller, string $method)
    {
        $reflectionMethod = new \ReflectionMethod($controller, $method);
        $data = $this->getParameters();
        $results = [];
        foreach ($reflectionMethod->getParameters() as $parameter) {
            $name = $parameter->getName();
            $value = $data[$name] ?? null;
            if (is_null($value) && !$parameter->allowsNull()) {
                throw new BadRequestException();
            }

            if ($parameter->hasType()) {
                $type = $parameter->getType()->getName();
                settype($value, $type);
            }
            $results[$name] = $value;
        }

        return $results;
    }

    /**
     * Не очень умный метод ))
     * @return array
     */
    protected function getParameters()
    {
        return $_GET;
    }
}