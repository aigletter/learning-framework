<?php


namespace core\components\Cache;


use core\factory\FactoryAbstract;

class CacheFactory extends FactoryAbstract
{
    protected function createConcrete($params = [])
    {
        return new Cache();
    }
}