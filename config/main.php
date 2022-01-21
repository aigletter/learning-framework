<?php

//use core\components\Cache\Cache;
use app\components\Cache\Cache;
use app\components\Cache\CacheFactory;
use core\components\Routing\RouterFactory;
use core\components\View\ViewFactory;

return [
    'app_name' => 'Shop',
    'components' => [
        'router' => [
            //'class' => Router::class,
            'factory' => RouterFactory::class,
        ],
        'view' => [
            //'class' => View::class,
            'factory' => ViewFactory::class,
        ],
        'cache' => [
            //'class' => Cache::class,
            'factory' => CacheFactory::class,
            'arguments' => [
                'filename' => ROOT_PATH . '/storage/cache/cache',
                'format' => 'json',
            ]
            //'factory' => \core\components\Cache\CacheFactory::class
        ]
    ]
];