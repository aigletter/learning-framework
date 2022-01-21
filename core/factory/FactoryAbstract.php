<?php


namespace core\factory;

/**
 * Реализация паттерна factory method
 * @package core\factory
 */
abstract class FactoryAbstract
{
    /**
     * Публичный метод, с помощью которого будет происходить взаимодействия извне
     * @param array $params
     * @return mixed
     */
    public function createComponent($params = [])
    {
        return $this->createConcrete($params);
    }

    /**
     * Абстрактный метод, который обязаны реализоавать все наследники и в котором будут создаваться конкретные компоненты
     * Заранее неизвестно какие будут наследники и какие будут компоненты
     * @param array $params
     * @return mixed
     */
    abstract protected function createConcrete($params = []);
}