<?php


namespace app\components\Cache;


use core\Application;
use core\factory\FactoryAbstract;

class CacheFactory extends FactoryAbstract
{
    protected function createConcrete($params = [])
    {
        return new Cache($params['filename'], $params['format']);
    }
}