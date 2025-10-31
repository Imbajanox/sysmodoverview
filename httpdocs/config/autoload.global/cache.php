<?php
use WirklichDigital\Cache\Module as CacheModule;
return  [
    'wirklich-digital' => [

        CacheModule::CONFIG_KEY => [
            'config' => [
                'default' => [
                    'name' => 'namespaced',
                    'title' => gettext_noop('Default cache pool'),
                    'description' => gettext_noop('Base cache for all cache adapters'),
                    'admin-clearable' => true,
                    'options' => [
                        'namespace' => 'wirklichDigital',
                        'cachePool' => 'defaultRedis',
                    ],
                ],
                'defaultRedis' => [
                    'name' => 'redis',
                    'title' => gettext_noop('Redis connection'),
                    'description' => gettext_noop('Connection to redis cache. Should not be cleared.'),
                    'admin-clearable' => false,
                ],
            ],
        ],
    ],
];
