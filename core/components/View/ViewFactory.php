<?php


namespace core\components\View;


use core\factory\FactoryAbstract;

class ViewFactory extends FactoryAbstract
{
    protected function createConcrete($params = [])
    {
        return new View();
    }
}