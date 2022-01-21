<?php


namespace core\components\Routing;


use core\factory\FactoryAbstract;

class RouterFactory extends FactoryAbstract
{
    protected function createConcrete($params = [])
    {
        return new Router();
    }
}