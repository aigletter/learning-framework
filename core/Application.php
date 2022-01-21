<?php

namespace core;

use core\components\Routing\HttpException;
use core\exceptions\ContainerException;
use core\factory\FactoryAbstract;
use Psr\Container\ContainerInterface;

class Application implements ContainerInterface
{
    /**
     * Здесь храним инстанс обьекта текущего класса (singleton)
     * @var self
     */
    protected static $instance;

    /**
     * Массив конфигов
     * @var array
     */
    protected static $config;

    /**
     * Массив компонентов
     * Заранее не знаем, какой набор компонентов будет в момент запуска. Определяетс конфигом
     * @var array
     */
    protected $components = [];

    /**
     * Добавление конфигов
     * @param array $config
     */
    public static function setConfig(array $config)
    {
        self::$config = $config;
    }

    /**
     * Возвращает единственных экземпляр данного класса и доступен с любого места приложения (singleton)
     * @return static
     */
    public static function getApp(): self
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    /**
     * Защищенный конструктор, который нельзя вызывать с кода (singleton)
     * @throws \Exception
     */
    protected function __construct()
    {
        $components = self::$config['components'] ?? [];
        foreach ($components as $name => $component) {
            $arguments = $component['arguments'] ?? [];
            $factory = $this->getFactoryFromConfig($component);
            $instance = $factory->createComponent($arguments);
            $this->components[$name] = $instance;
        }
    }

    /**
     * Получает из конигурации компонента и создает фабрику, которая умеет создавать конкретный компонент
     * Обратите внимание, что возвращаемым значением указан абстрактный класс, то есть возвращаться будет его наследник
     * @param $config
     * @return FactoryAbstract
     * @throws \Exception
     */
    protected function getFactoryFromConfig($config): FactoryAbstract
    {
        $factoryClass = $config['factory'] ?? null;

        if (!$factoryClass) {
            throw new \Exception('Factory param is required');
        }

        if (!class_exists($factoryClass)) {
            throw new \Exception('Class ' . $factoryClass . ' not found');
        }

        $factory = new $factoryClass();

        if (!$factory instanceof FactoryAbstract) {
            throw new \Exception('Factory must extend ' . FactoryAbstract::class);
        }

        return $factory;
    }

    /**
     * Главная функция приложения
     * На данный момент здесь запускается роутинг, в котором определяется контролер и метод
     * Далее этот метод контроллера вызывается
     * Также добавлен перехват исключений
     */
    public function run()
    {
        try {
            $action = $this->get('router')->route();
            if (!$action) {
                throw new \Exception('Not found');
            }
            echo $action();
        } catch (HttpException $exception) {
            http_response_code($exception->getCode());
            echo $exception->getMessage();
        } catch (\Throwable $exception) {
            http_response_code(500);
            echo '<pre>';
            echo $exception->getMessage();
            echo $exception->getTraceAsString();
            echo '</pre>';
        }
    }

    /**
     * Реализация метода контейнера
     * @param string $id
     * @return mixed
     * @throws ContainerException
     */
    public function get(string $id)
    {
        if ($this->has($id)) {
            return $this->components[$id];
        }

        throw new ContainerException('Component with name ' . $id . ' not found in container');
    }

    /**
     * Реализация метода контейнера
     * @param string $id
     * @return bool
     */
    public function has(string $id): bool
    {
        return array_key_exists($id, $this->components);
    }
}